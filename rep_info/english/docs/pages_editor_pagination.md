# Pagination block

1. Place the block before or after its target list. In settings, choose **Select block on canvas** and click the Smarty block or item container. Cancel or Esc ends selection. Pagination must sit outside the target.
2. For Smarty, enter the full-list variable, for example `$auction_sites` or `$registered_domains`; `$` is optional. Keep the normal `{foreach}` in the template. Do not add a second `array_slice`.
3. Choose the page size and the number of buttons at the start, end and sides of the current page, separately for desktop and mobile.
4. Optionally duplicate the controls to the opposite side of the same list.

## Links and multiple lists

Each block chooses the module default (`ZM_PB_PRETTY_URLS`), `/page/2/`, or `?page=2`. Path-style links need working rewrite rules. Direct PHP routes use query parameters to avoid nonexistent routes such as `clientarea.php/page/2/`. Links preserve filters, sorting, the installation path and language prefix. Switching styles removes the old page number.

The first list uses `page`, `count` and `sort`; later lists use parameters suffixed with their target block ID. With `/page/N/`, `pager` identifies which extra list owns the number. A duplicate control does not create a new list. Auction sorting supports `domain_name`, `base_price`, `highest_bid`, `expiry_date` and `domain_rank`; prefix `-` for descending order. Unknown fields do not reach SQL.

## Data sources

Archive, fixed-price, all-domain and registered-domain lists use a separate SQL count and fetch only the current page. Independent blocks using the same variable each get their own slice. Bid and homepage participation lists apply existing status filters before slicing but still load their source collection. Other known Smarty arrays are sliced in the target block's isolated context.

Without a variable, pagination divides HTML items in the selected container. You may specify a repeated-item class or tag such as `tr`; otherwise direct children are used, with single wrappers traversed. `thead` and `tfoot` remain intact. For large dynamic lists, use a variable to avoid rendering the entire list first.

The associated Smarty block receives `$zm_pagination` with `total`, `page`, `pages`, `count` and `offset`. For example: `{$zm_pagination.offset + $v@iteration}`. Controls disappear on the public page when the list is empty or fits on one page. The editor preview shows sample pages only.

## Page size, SEO and filters

An optional selector offers 10, 25, 50, 100 and 250 items. Changing it preserves filters and returns that list to page one. A nonstandard default is also shown. The control has small, standard and large sizes. Its selector can be moved before or after the buttons, or into another container, while keeping the same pagination link. Automatically duplicated controls do not duplicate a selector moved elsewhere.

The backend clamps block settings and `count`/`count_<id>` query values to 10–250 before calculating the page window and links. Pages after the first add the page number to title, existing description and last breadcrumb; their canonical points to that result page. **Do not index pages after the first** adds `noindex` only to later pages. The optional “Page … / …” text does not affect metadata.

The old Search block is converted to Filters when opened. Text filters can search several comma-separated fields. Layout options include Flex/Grid, direction, wrapping, alignment, spacing, button position and per-field width or column span, including device-specific columns. Date-range filters send `YYYY-MM-DD`; the selected last day includes records with times through its end. Fields can apply on change or by button.

For isolated checks in a WHMCS project with PHP DOM and dependencies, run `tests/pagination.php`, `tests/pagination.php query` and `tests/smarty_blocks.php` from the module directory. These tests do not change WHMCS settings or connect to the production database.

## YYYY-MM-DD

Filters work on the same list as pagination. Text search can inspect several comma-separated fields; a date range uses `YYYY-MM-DD` and includes the entire final day. Applying or clearing filters returns that list to its first page.

## Flex / Grid

Choose Flex or Grid, then set field widths and columns for each device size. The page-size selector can be dragged without losing its link to the pagination block. A duplicated pagination panel controls the same list, including its active filters and page size.

## Instructions

- Click the list block. Esc cancels. Place pagination outside the target block.
- For Smarty, enter the full list variable. Without a variable, container HTML items are paginated; optionally specify a row class or tr tag. Links preserve count, sort and filters. Multiple independent lists are supported.
- Per-page selector: 10, 25, 50, 100, 250
- Drag the page size selector inside the pagination or into other page blocks. It stays linked to this pagination.
- Noindex page 2 and later
- Choose the Smarty list block. Search and pagination must target the same block.
- Set the full list variable. Search matches any chosen field; filters are combined. Conditions apply before page counting; applying or resetting returns to page one. An existing pagination binding supplies the variable.
- Link format
- Default items per page
