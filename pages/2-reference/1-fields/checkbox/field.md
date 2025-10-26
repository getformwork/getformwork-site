---
title: Checkbox
documentation:
    fields:
        checkbox:
            type: checkbox
description: 'A single boolean toggle. Use it for yes/no options.'
screenshot: checkbox.png
---
The **checkbox** field allows users to toggle a boolean value on or off.

## Field value
The value of a **checkbox** field is a <code><span class="type-bool">bool</span></code>, which can be either `true` (checked) or `false` (unchecked).

## Field options

|Option|Type|Description|Default|
|--|--|--|--|
|`type`|<code><span class="type-string">string</span></code>|Must be set to `checkbox` to use this field type.|`'checkbox'`|
|`label`|<code><span class="type-string">string</span></code>|The label displayed next to the checkbox input.|`''`|
|`description`|<code><span class="type-string">string</span></code>|Optional longer text displayed below the field in smaller size.|`''`|
|`default`|<code><span class="type-bool">bool</span></code>|Default state of the checkbox (`true` for checked, `false` for unchecked).|`false`|
|`required`|<code><span class="type-bool">bool</span></code>|If `true`, the field must be checked before submitting the form.|`false`|
|`disabled`|<code><span class="type-bool">bool</span></code>|If `true`, the field will be shown as disabled in the Panel.|`false`|
