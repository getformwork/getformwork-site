---
title: Slug
documentation:
    fields:
        slug:
            type: slug
description: "URL-friendly identifier. It can use a reference field to get the value."
screenshot: slug.png
---

The **slug** field allows users to create a URL-friendly string, often used for page or content identifiers.  
It can automatically generate a slug from a source field, and supports manual editing if not readonly.

## Field value

The value of a **slug** field is a `string`{.type-string} containing the URL-friendly slug.

## Field options

| Option        | Type                   | Description                                                           | Default  |
| ------------- | ---------------------- | --------------------------------------------------------------------- | -------- |
| `type`        | `string`{.type-string} | Must be set to `slug` to use this field type.                         | `'slug'` |
| `label`       | `string`{.type-string} | The label displayed above the field.                                  | `''`     |
| `description` | `string`{.type-string} | Optional longer text displayed below the field in smaller size.       | `''`     |
| `default`     | `string`{.type-string} | Default slug value.                                                   | `''`     |
| `placeholder` | `string`{.type-string} | Placeholder text displayed inside the input.                          | `''`     |
| `icon`        | `string`{.type-string} | Optional icon displayed inside the input.                             | `''`     |
| `min`         | `number`{.type-number} | Minimum allowed length of the slug.                                   | `null`   |
| `max`         | `number`{.type-number} | Maximum allowed length of the slug.                                   | `null`   |
| `pattern`     | `string`{.type-string} | Regular expression pattern for validation.                            | `''`     |
| `readonly`    | `bool`{.type-bool}     | If `true`, the field cannot be edited manually.                       | `false`  |
| `source`      | `string`{.type-string} | Name of the field used to automatically generate the slug.            | `null`   |
| `autoUpdate`  | `bool`{.type-bool}     | If `true`, the slug is automatically updated when the source changes. | `true`   |
| `required`    | `bool`{.type-bool}     | If `true`, the field must have a slug before submitting the form.     | `false`  |
| `disabled`    | `bool`{.type-bool}     | If `true`, the field will be shown as disabled in the Panel.          | `false`  |
