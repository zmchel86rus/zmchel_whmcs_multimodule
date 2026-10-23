# Module database

## WHMCS

- **Module database:** `MISSING` → Select → Fix Selected items.
- **Delete Selected items** — This action cannot be undone.

The **Module database** page shows the required module tables and columns and whether they exist. It is available to the configured Super Administrator. Use it when another module section reports that a required table or column is missing.

Review the status table first. Select only the missing items you intend to repair, then click **FIX selected items**. A row can indicate that a missing column has no automatic repair recipe; in that case the manager cannot add it for you. Reload the page and check the status after a repair.

The page also offers **DELETE selected items**. This removes selected module database objects and is irreversible; export module data and take a database backup before using it. Do not select unrelated rows merely to clear a warning.

## Instructions

- Access denied. Only the Super Administrator (ID …) can use the module Database page.
- Fix
- Selected items
- Delete
- This action cannot be undone.
- Menu tables have not been created yet. Add them in Module Database.
- First add the optimization_attempted column in the module table manager.
