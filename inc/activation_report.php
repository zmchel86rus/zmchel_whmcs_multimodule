<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

/** Send the configured WHMCS domain when the module is activated. */
function zm_pb_report_activation_usage(): void
{
    $endpoint = 'https://zmchel-activation.ackirkin.workers.dev/';
    $domain = strtolower((string) parse_url((string) ($GLOBALS['CONFIG']['SystemURL'] ?? ''), PHP_URL_HOST));
    if ($domain === '' || (!filter_var($domain, FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME)
        && !filter_var($domain, FILTER_VALIDATE_IP))) {
        throw new RuntimeException('The WHMCS SystemURL has no valid host.');
    }
    if (!function_exists('curl_init') || !function_exists('openssl_encrypt') || !function_exists('openssl_public_encrypt')) {
        throw new RuntimeException('The cURL and OpenSSL PHP extensions are required.');
    }

    $request = static function ($body = null) use ($endpoint) {
        $handle = curl_init($endpoint);
        if ($handle === false) throw new RuntimeException('Could not initialize the activation request.');
        $options = [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CONNECTTIMEOUT => 2,
            CURLOPT_TIMEOUT => 4,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_PROTOCOLS => CURLPROTO_HTTPS,
            CURLOPT_HTTPHEADER => ['Accept: application/json'],
        ];
        if ($body !== null) {
            $options[CURLOPT_POST] = true;
            $options[CURLOPT_POSTFIELDS] = $body;
            $options[CURLOPT_HTTPHEADER][] = 'Content-Type: application/json';
        }
        curl_setopt_array($handle, $options);
        $response = curl_exec($handle);
        $error = curl_error($handle);
        $status = (int) curl_getinfo($handle, CURLINFO_HTTP_CODE);
        if (PHP_VERSION_ID < 80000) curl_close($handle);
        if ($response === false) throw new RuntimeException('Activation report request failed: ' . $error);
        if ($body !== null) {
            if ($status < 200 || $status >= 300) {
                throw new RuntimeException('Activation server returned HTTP ' . $status . '.');
            }
            return;
        }
        if (strlen($response) > 8192) throw new RuntimeException('Activation server response is too large.');
        $decoded = json_decode($response, true);
        if (!is_array($decoded)) throw new RuntimeException('Activation server returned an invalid response.');
        if ($status !== 200) throw new RuntimeException('Activation server returned HTTP ' . $status . '.');
        return $decoded;
    };

    $keyResponse = $request();
    $publicKey = $keyResponse['public_key'] ?? null;
    if (!is_string($publicKey) || strlen($publicKey) > 4096 || openssl_pkey_get_public($publicKey) === false) {
        throw new RuntimeException('Activation server did not provide a valid public key.');
    }
    $plainText = json_encode(['domain' => $domain, 'module_start_using' => true], JSON_UNESCAPED_SLASHES);
    if ($plainText === false) throw new RuntimeException('Could not encode the activation report.');
    $sessionKey = random_bytes(32);
    $nonce = random_bytes(12);
    $cipherText = openssl_encrypt($plainText, 'aes-256-gcm', $sessionKey, OPENSSL_RAW_DATA, $nonce, $tag);
    if ($cipherText === false || !openssl_public_encrypt($sessionKey, $encryptedKey, $publicKey, OPENSSL_PKCS1_OAEP_PADDING)) {
        throw new RuntimeException('Could not encrypt the activation report.');
    }
    $payload = json_encode([
        'key' => base64_encode($encryptedKey),
        'nonce' => base64_encode($nonce),
        'tag' => base64_encode($tag),
        'data' => base64_encode($cipherText),
    ], JSON_UNESCAPED_SLASHES);
    if ($payload === false) throw new RuntimeException('Could not encode the encrypted report.');
    $request($payload);
}
