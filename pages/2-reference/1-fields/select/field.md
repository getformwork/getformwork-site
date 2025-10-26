---
title: Select
documentation:
    fields:
        select:
            type: select
description: 'Single option selector from a predefined list.'
screenshot: select.png
---
The **select** field allows users to choose a single value from a predefined list of options.  
It supports optional icons and can be marked as required or disabled.

## Field value
The value of a **select** field is a <code><span class="type-string">string</span></code> representing the selected option key.

## Field options

|Option|Type|Description|Default|
|--|--|--|--|
|`type`|<code><span class="type-string">string</span></code>|Must be set to `select` to use this field type.|`'select'`|
|`label`|<code><span class="type-string">string</span></code>|The label displayed above the field.|`''`|
|`description`|<code><span class="type-string">string</span></code>|Optional longer text displayed below the field in smaller size.|`''`|
|`default`|<code><span class="type-string">string</span></code>|Default selected option key.|`''`|
|`icon`|<code><span class="type-string">string</span></code>|Optional icon displayed inside the select input.|`''`|
|`options`|<code><span class="type-keyword">array</span></code>|List of available options in the format `'key' => 'label'`.|`[]`|
|`required`|<code><span class="type-bool">bool</span></code>|If `true`, the field must have a value before submitting the form.|`false`|
|`disabled`|<code><span class="type-bool">bool</span></code>|If `true`, the field will be shown as disabled in the Panel.|`false`|
