---
title: Images
documentation:
    fields:
        images:
            type: images
description: "Multiple image selector with previews."
screenshot: images.png
---

The **images** field allows users to select multiple images from a predefined list of options.  
Selected images are displayed as tags, and their order can be optionally rearranged.

## Field value

The value of an **images** field is a `array`{.type-keyword} containing the selected image keys from the available options.

## Field options

| Option        | Type                   | Description                                                                 | Default    |
| ------------- | ---------------------- | --------------------------------------------------------------------------- | ---------- |
| `type`        | `string`{.type-string} | Must be set to `images` to use this field type.                             | `'images'` |
| `label`       | `string`{.type-string} | The label displayed above the field.                                        | `''`       |
| `description` | `string`{.type-string} | Optional longer text displayed below the field in smaller size.             | `''`       |
| `default`     | `array`{.type-keyword} | Default selected image keys.                                                | `[]`       |
| `icon`        | `string`{.type-string} | Icon displayed inside the input.                                            | `'image'`  |
| `placeholder` | `string`{.type-string} | Placeholder text displayed when no images are selected.                     | `''`       |
| `options`     | `array`{.type-keyword} | List of available images that can be selected.                              | `[]`       |
| `limit`       | `number`{.type-number} | Maximum number of images that can be selected. `0` or `null` for unlimited. | `0`        |
| `orderable`   | `bool`{.type-bool}     | If `true`, users can reorder selected images.                               | `false`    |
| `required`    | `bool`{.type-bool}     | If `true`, at least one image must be selected before submitting the form.  | `false`    |
| `disabled`    | `bool`{.type-bool}     | If `true`, the field will be shown as disabled in the Panel.                | `false`    |
