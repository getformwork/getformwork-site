---
title: Image
documentation:
    fields:
        image:
            type: image
description: "Single image selector with preview."
screenshot: image.png
---

The **image** field allows users to select a single image from a predefined list of options.  
Each option can include an icon or a thumbnail to provide a visual preview.

## Field value

The value of an **image** field is a `string`{.type-string} representing the selected image key from the list of options.

## Field options

| Option        | Type                   | Description                                                                          | Default   |
| ------------- | ---------------------- | ------------------------------------------------------------------------------------ | --------- |
| `type`        | `string`{.type-string} | Must be set to `image` to use this field type.                                       | `'image'` |
| `label`       | `string`{.type-string} | The label displayed above the field.                                                 | `''`      |
| `description` | `string`{.type-string} | Optional longer text displayed below the field in smaller size.                      | `''`      |
| `default`     | `string`{.type-string} | Default selected image key.                                                          | `''`      |
| `icon`        | `string`{.type-string} | Icon displayed inside the select input.                                              | `'image'` |
| `options`     | `array`{.type-keyword} | List of available images. Each option can include `value`, `icon`, and `thumb` keys. | `[]`      |
| `required`    | `bool`{.type-bool}     | If `true`, the field must have a value before submitting the form.                   | `false`   |
| `disabled`    | `bool`{.type-bool}     | If `true`, the field will be shown as disabled in the Panel.                         | `false`   |
