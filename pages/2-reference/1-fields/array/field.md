---
title: Array
documentation:
    fields:
        array:
            type: array
description: "A list of items. Great for things like links, metadata, or simple repeatable content."
screenshot: array.png
---

The **array** field allows users to define a list (indexed or associative) of key–value pairs.
Each entry can be reordered, added, or removed in the Panel.

## Field value

The value of an **array** field is an `array`{.type-keyword}. If the `associative` option is set to `true`, the array will be associative (key–value pairs).
If `associative` is set to `false`, the array will be indexed (a simple list of values).

## Field options

| Option             | Type                   | Description                                                                                                                | Default              |
| ------------------ | ---------------------- | -------------------------------------------------------------------------------------------------------------------------- | -------------------- |
| `type`             | `string`{.type-string} | Must be set to `array` to use this field type.                                                                             | `'array'`            |
| `label`            | `string`{.type-string} | The label displayed above the field.                                                                                       | `''`                 |
| `description`      | `string`{.type-string} | Optional longer text displayed below the field in smaller size.                                                            | `''`                 |
| `default`          | `array`{.type-keyword} | Default value for the field. Can be an associative or indexed array depending on `associative`.                            | `[]`                 |
| `required`         | `bool`{.type-bool}     | If `true`, the field must have a value.                                                                                    | `false`              |
| `disabled`         | `bool`{.type-bool}     | If `true`, the field will be shown as disabled in the Panel.                                                               | `false`              |
| `associative`      | `bool`{.type-bool}     | If `true`, enables key–value pairs; if `false`, a simple list of values is shown.                                          | `false`              |
| `placeholderKey`   | `string`{.type-string} | Placeholder text for the key input (only visible if `associative` is `true`).                                              | `''`                 |
| `placeholderValue` | `string`{.type-string} | Placeholder text for the value input.                                                                                      | `''`                 |
| `items`            | `array`{.type-keyword} | **Since 2.2.0**{.badge .badge-yellow} Defines the field used for each item in the array. Must be a valid field definition. | `['type' => 'text']` |
| `allowEmptyValues` | `bool`{.type-bool}     | **Since 2.2.0**{.badge .badge-yellow} Only for associative array fields. If `true`, allows empty values in the array.      | `false`              |
