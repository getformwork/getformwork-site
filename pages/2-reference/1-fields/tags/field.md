---
title: Tags
documentation:
    fields:
        tags:
            type: tags
description: "List of short text labels."
screenshot: tags.png
---

The **tags** field allows users to enter multiple tags as a comma-separated list.  
Tags can be selected from predefined options, limited in number, and optionally reordered.

## Field value

The value of a **tags** field is a `array`{.type-keyword} containing the entered or selected tags.

## Field options

| Option        | Type                   | Description                                                                                            | Default  |
| ------------- | ---------------------- | ------------------------------------------------------------------------------------------------------ | -------- |
| `type`        | `string`{.type-string} | Must be set to `tags` to use this field type.                                                          | `'tags'` |
| `label`       | `string`{.type-string} | The label displayed above the field.                                                                   | `''`     |
| `description` | `string`{.type-string} | Optional longer text displayed below the field in smaller size.                                        | `''`     |
| `default`     | `array`{.type-keyword} | Default tags for the field.                                                                            | `[]`     |
| `icon`        | `string`{.type-string} | Icon displayed inside the input.                                                                       | `'tag'`  |
| `placeholder` | `string`{.type-string} | Placeholder text displayed when no tags are present.                                                   | `''`     |
| `limit`       | `number`{.type-number} | Maximum number of tags allowed. `0` or `null` for unlimited.                                           | `0`      |
| `options`     | `array`{.type-keyword} | Optional predefined tags that can be selected.                                                         | `[]`     |
| `accept`      | `string`{.type-string} | Defines which values are accepted (`options` to restrict to predefined tags, or other values allowed). | `'all'`  |
| `orderable`   | `bool`{.type-bool}     | If `true`, users can reorder entered tags.                                                             | `false`  |
| `required`    | `bool`{.type-bool}     | If `true`, the field must have at least one tag before submitting the form.                            | `false`  |
| `disabled`    | `bool`{.type-bool}     | If `true`, the field will be shown as disabled in the Panel.                                           | `false`  |
