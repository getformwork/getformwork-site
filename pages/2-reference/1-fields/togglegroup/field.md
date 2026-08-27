---
title: Togglegroup
documentation:
    fields:
        togglegroup:
            type: togglegroup
description: "Group of toggleable options."
screenshot: togglegroup.png
---

The **togglegroup** field allows users to select a single option from a group of radio buttons displayed as toggle buttons.  
It supports optional disabling of the entire group.

## Field value

The value of a **togglegroup** field is a `string`{.type-string} representing the selected option key.

## Field options

| Option        | Type                   | Description                                                     | Default         |
| ------------- | ---------------------- | --------------------------------------------------------------- | --------------- |
| `type`        | `string`{.type-string} | Must be set to `togglegroup` to use this field type.            | `'togglegroup'` |
| `label`       | `string`{.type-string} | The label displayed above the field.                            | `''`            |
| `description` | `string`{.type-string} | Optional longer text displayed below the field in smaller size. | `''`            |
| `default`     | `string`{.type-string} | Default selected option key.                                    | `''`            |
| `options`     | `array`{.type-keyword} | List of available options in the format `key => label`.         | `[]`            |
| `disabled`    | `bool`{.type-bool}     | If `true`, the entire togglegroup will be disabled.             | `false`         |
