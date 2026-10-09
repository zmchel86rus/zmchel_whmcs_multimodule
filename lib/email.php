<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

/** Keep internal notifications clear of the customer email header and footer. */
class ZM_PB_SystemMailMessage extends \WHMCS\Mail\Message
{
    public function applyGlobalWrapper(string $blob): string { return $blob; }
    public function appendGlobalHeader(string $blob): string { return $blob; }
    public function appendGlobalFooter(string $blob): string { return $blob; }
}

/** Use the configured WHMCS provider for PHP Mail, SMTP and provider modules. */
class ZM_PB_Email
{
    private static function checkPhpMail()
    {
        if (!function_exists('mail')) throw new RuntimeException('PHP Mail selected, but mail() is unavailable or disabled. Configure SMTP or another mail provider in WHMCS.');
        if (PHP_OS_FAMILY === 'Windows') {
            if (trim((string) ini_get('SMTP')) === '') throw new RuntimeException('PHP Mail selected, but PHP SMTP is not configured.');
            return;
        }

        // On Unix PHP mail() needs a local sendmail-compatible executable.
        $command = trim((string) ini_get('sendmail_path'));
        if (!preg_match('/^(?:"([^"]+)"|\'([^\']+)\'|([^\s]+))/', $command, $match)) {
            throw new RuntimeException('PHP Mail selected, but sendmail_path is empty.');
        }
        $binary = $match[1] ?: ($match[2] ?: ($match[3] ?? ''));
        if (strpos($binary, '/') !== false) {
            if (is_file($binary) && is_executable($binary)) return;
        } else {
            foreach (explode(PATH_SEPARATOR, (string) getenv('PATH')) as $directory) {
                if ($directory !== '' && is_file($directory . '/' . $binary) && is_executable($directory . '/' . $binary)) return;
            }
        }
        throw new RuntimeException('PHP Mail selected, but its sendmail executable is unavailable. Configure SMTP or install a local mail transport.');
    }

    public static function send($recipient, $subject, $html, $replyEmail = '', $replyName = '', $systemMessage = true, $plainText = '')
    {
        $providerName = 'WHMCS';
        try {
            $config = $GLOBALS['CONFIG'] ?? [];
            if (!empty($config['DisableEmailSending'])) throw new RuntimeException('Email sending is disabled in WHMCS.');
            if (!filter_var($recipient, FILTER_VALIDATE_EMAIL)) throw new RuntimeException('Invalid email recipient.');

            $provider = \WHMCS\Module\Mail::factory();
            $providerName = (string) $provider->getLoadedModule();
            if (strcasecmp($providerName, 'PhpMail') === 0) self::checkPhpMail();

            $from = $systemMessage
                ? ZM_PB_SYSTEM_MAIL_FROM
                : (($config['SystemEmailsFromEmail'] ?? '') ?: ($config['Email'] ?? ''));
            if (!filter_var($from, FILTER_VALIDATE_EMAIL)) throw new RuntimeException('The sender email is missing or invalid.');
            $mail = $systemMessage ? new ZM_PB_SystemMailMessage() : new \WHMCS\Mail\Message();
            $mail->setFromEmail($from);
            $mail->setFromName(($config['SystemEmailsFromName'] ?? '') ?: ($config['CompanyName'] ?? ''));
            $mail->addRecipient('to', $recipient);
            if ($replyEmail !== '' && filter_var($replyEmail, FILTER_VALIDATE_EMAIL)) {
                $mail->setReplyTo($replyEmail, preg_replace('/[\r\n]+/', ' ', $replyName));
            }
            $mail->setSubject(preg_replace('/[\r\n]+/', ' ', $subject));
            if ($systemMessage) {
                $mail->setBody('<!doctype html><html><head><meta charset="UTF-8"></head><body>' . $html . '</body></html>');
            } else {
                // The form body is already escaped HTML. Keep submitted braces out of Smarty,
                // while allowing WHMCS to resolve variables in its global email wrapper.
                $safeHtml = str_replace(['{', '}'], ['&#123;', '&#125;'], $html);
                $mail->setBodyFromSmarty($mail->applyGlobalWrapper($safeHtml));
            }
            $mail->setPlainText($plainText !== '' ? $plainText : html_entity_decode(strip_tags($html), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
            if ($provider->send($mail) === false) throw new RuntimeException('The WHMCS provider rejected the message.');
            return ['result' => 'success'];
        } catch (Throwable $error) {
            // Caller logs diagnostics; visitors receive the translated generic error.
            return ['result' => 'error', 'message' => 'Email (' . $providerName . '): ' . $error->getMessage()];
        }
    }
}
