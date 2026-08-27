---
title: Files
documentation:
    fields:
        files:
            type: files
description: "Multiple file references."
screenshot: files.png
---

The **files** field allows users to select multiple files from a predefined list of options.  
Selected files are displayed as tags, and the order can be optionally rearranged.

## Field value

The value of a **files** field is a `array`{.type-keyword} containing the selected file keys from the available options.

## Field options

| Option        | Type                   | Description                                                                | Default   |
| ------------- | ---------------------- | -------------------------------------------------------------------------- | --------- |
| `type`        | `string`{.type-string} | Must be set to `files` to use this field type.                             | `'files'` |
| `label`       | `string`{.type-string} | The label displayed above the field.                                       | `''`      |
| `description` | `string`{.type-string} | Optional longer text displayed below the field in smaller size.            | `''`      |
| `default`     | `array`{.type-keyword} | Default selected file keys.                                                | `[]`      |
| `icon`        | `string`{.type-string} | Icon displayed inside the input.                                           | `'file'`  |
| `placeholder` | `string`{.type-string} | Placeholder text displayed when no files are selected.                     | `''`      |
| `options`     | `array`{.type-keyword} | List of available files that can be selected.                              | `[]`      |
| `limit`       | `number`{.type-number} | Maximum number of files that can be selected. `0` or `null` for unlimited. | `0`       |
| `orderable`   | `bool`{.type-bool}     | If `true`, users can reorder selected files.                               | `false`   |
| `required`    | `bool`{.type-bool}     | If `true`, at least one file must be selected before submitting the form.  | `false`   |
| `disabled`    | `bool`{.type-bool}     | If `true`, the field will be shown as disabled in the Panel.               | `false`   |
