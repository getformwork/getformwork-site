---
title: Page
documentation:
    fields:
        page:
            type: page
description: 'Reference to a site page.'
---
The **page** field allows users to select a single page from the site’s page collection.  
It supports optional inclusion of the site root and can display page hierarchy with icons.

## Field value
The value of a **page** field is a <code><span class="type-string">string</span></code> representing the route of the selected page.

## Field options

|Option|Type|Description|Default|
|--|--|--|--|
|`type`|<code><span class="type-string">string</span></code>|Must be set to `page` to use this field type.|`'page'`|
|`label`|<code><span class="type-string">string</span></code>|The label displayed above the field.|`''`|
|`description`|<code><span class="type-string">string</span></code>|Optional longer text displayed below the field in smaller size.|`''`|
|`default`|<code><span class="type-string">string</span></code>|Default selected page route.|`''`|
|`icon`|<code><span class="type-string">string</span></code>|Icon displayed inside the select input.|`'page'`|
|`collection`|<code><span class="type-name">PageCollection</span></code>|Collection of available pages.||
|`allowSite`|<code><span class="type-bool">bool</span></code>|If `true`, allows selection of the site root (`/`).|`false`|
|`required`|<code><span class="type-bool">bool</span></code>|If `true`, the field must have a page selected before submitting the form.|`false`|
|`disabled`|<code><span class="type-bool">bool</span></code>|If `true`, the field will be shown as disabled in the Panel.|`false`|
