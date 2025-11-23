---
title: Array
documentation:
    fields:
        array:
            type: array
description: 'A list of items. Great for things like links, metadata, or simple repeatable content.'
screenshot: array.png
---
The **array** field allows users to define a list (indexed or associative) of key–value pairs.
Each entry can be reordered, added, or removed in the Panel.

## Field value
The value of an **array** field is an <code><span class="type-keyword">array</span></code>. If the `associative` option is set to `true`, the array will be associative (key–value pairs).
If `associative` is set to `false`, the array will be indexed (a simple list of values).

## Field options

|Option|Type|Description|Default|
|--|--|--|--|
|`type`|<code><span class="type-string">string</span></code>|Must be set to `array` to use this field type.|`'array'`|
|`label`|<code><span class="type-string">string</span></code>|The label displayed above the field.|`''`|
|`description`|<code><span class="type-string">string</span></code>|Optional longer text displayed below the field in smaller size.|`''`|
|`default`|<code><span class="type-keyword">array</span></code>|Default value for the field. Can be an associative or indexed array depending on `associative`.|`[]`|
|`required`|<code><span class="type-bool">bool</span></code>|If `true`, the field must have a value.|`false`|
|`disabled`|<code><span class="type-bool">bool</span></code>|If `true`, the field will be shown as disabled in the Panel.|`false`|
|`associative`|<code><span class="type-bool">bool</span></code>|If `true`, enables key–value pairs; if `false`, a simple list of values is shown.|`false`|
|`placeholderKey`|<code><span class="type-string">string</span></code>|Placeholder text for the key input (only visible if `associative` is `true`).|`''`|
|`placeholderValue`|<code><span class="type-string">string</span></code>|Placeholder text for the value input.|`''`|
|`items`|<code><span class="type-keyword">array</span></code>|<span class="badge badge-yellow">Since 2.2.0</span> Defines the field used for each item in the array. Must be a valid field definition.|`['type' => 'text']`|
|`allowEmptyValues`|<code><span class="type-bool">bool</span></code>|<span class="badge badge-yellow">Since 2.2.0</span> Only for associative array fields. If `true`, allows empty values in the array.|`false`|