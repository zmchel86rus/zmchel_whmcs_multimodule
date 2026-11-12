# Rewrite Manager

## WHMCS

Rewrite Manager checks and installs the module's Apache rules in the site's main `.htaccess`. It also holds custom rewrite rules. These are server rewrite rules; URL-to-URL redirects are managed separately in [Redirect Manager](redirects_manager.md).

## Check and apply rules

Open **Rewrite Manager** and check the status for the supported language routes. **Add or update rules** writes the module block to `.htaccess`. Recheck the status and test a published page in the default language and one additional language. **Remove all rules** removes the module block when it is present.

For a custom rule, enter its URL pattern, destination, and flags, then save it and apply the rules again. Review the pattern before applying: a broad match can affect unrelated pages. Apache reads `.htaccess`; Nginx needs corresponding server configuration rather than these Apache directives.
