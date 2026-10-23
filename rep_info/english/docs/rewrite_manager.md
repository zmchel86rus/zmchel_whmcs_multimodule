# Rewrite Manager

## WHMCS

Rewrite Manager checks and installs the module's Apache rules in the site's main `.htaccess`. It also holds custom rewrite rules. These are server rewrite rules; URL-to-URL redirects are managed separately in [Redirect Manager](redirects_manager.md).

## Check and apply rules

Open **Rewrite Manager** and check the status for the supported language routes. **Add or update rules** writes the module block to `.htaccess`. Recheck the status and test a published page in the default language and one additional language. **Remove all rules** removes the module block when it is present.

For a custom rule, enter its URL pattern, destination, and flags, then save it and apply the rules again. Review the pattern before applying: a broad match can affect unrelated pages. Apache reads `.htaccess`; Nginx needs corresponding server configuration rather than these Apache directives.

## Instructions

- Rules for language URLs, including pages under /ru/, /en/ and other prefixes. Languages come from supported_langs.php; rules are inserted into .htaccess before WHMCS rules.
- Nginx does not read .htaccess, so these rules do not work there. Configure equivalent rules in nginx.
- An nginx → Apache setup was detected. These rules work only for requests forwarded to Apache; nginx does not read .htaccess.
- Check rules
- Add or update rules
- Remove all rules from .htaccess
- URL pattern
- Target
- Flags
- After adding or deleting a rule, click “Add or update rules” to apply changes to .htaccess.
