---
title: Template
documentation:
    fields:
        template:
            type: template
description: "Page template selector."
screenshot: template.png
---

The **template** field allows users to select a single template from the available site templates.

## Field value

The value of a **template** field is a `string`{.type-string} representing the selected template name.

## Field options

| Option        | Type                   | Description                                                        | Default      |
| ------------- | ---------------------- | ------------------------------------------------------------------ | ------------ |
| `type`        | `string`{.type-string} | Must be set to `template` to use this field type.                  | `'template'` |
| `label`       | `string`{.type-string} | The label displayed above the field.                               | `''`         |
| `description` | `string`{.type-string} | Optional longer text displayed below the field in smaller size.    | `''`         |
| `default`     | `string`{.type-string} | Default selected template name.                                    | `''`         |
| `icon`        | `string`{.type-string} | Optional icon displayed inside the select input.                   | `'template'` |
| `required`    | `bool`{.type-bool}     | If `true`, a template must be selected before submitting the form. | `false`      |
| `disabled`    | `bool`{.type-bool}     | If `true`, the field will be shown as disabled in the Panel.       | `false`      |
