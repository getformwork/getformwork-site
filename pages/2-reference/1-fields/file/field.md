---
title: File
documentation:
    fields:
        file:
            type: file
description: "Single file reference."
screenshot: file.png
---

The **file** field allows users to select a file from a predefined list of options.  
Each option can include an icon or thumbnail to provide a visual preview.

## Field value

The value of a **file** field is a `string`{.type-string} representing the selected file key from the list of options.

## Field options

| Option        | Type                   | Description                                                                         | Default  |
| ------------- | ---------------------- | ----------------------------------------------------------------------------------- | -------- |
| `type`        | `string`{.type-string} | Must be set to `file` to use this field type.                                       | `'file'` |
| `label`       | `string`{.type-string} | The label displayed above the field.                                                | `''`     |
| `description` | `string`{.type-string} | Optional longer text displayed below the field in smaller size.                     | `''`     |
| `default`     | `string`{.type-string} | Default selected file key.                                                          | `''`     |
| `icon`        | `string`{.type-string} | Icon displayed inside the select input.                                             | `'file'` |
| `options`     | `array`{.type-keyword} | List of available files. Each option can include `value`, `icon`, and `thumb` keys. | `[]`     |
| `required`    | `bool`{.type-bool}     | If `true`, the field must have a value before submitting the form.                  | `false`  |
| `disabled`    | `bool`{.type-bool}     | If `true`, the field will be shown as disabled in the Panel.                        | `false`  |
