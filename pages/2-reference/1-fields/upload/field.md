---
title: Upload
documentation:
    fields:
        upload:
            type: upload
description: "File uploader from a local device. Can display the uploaded files."
screenshot: upload.png
---

The **upload** field allows users to upload one or multiple files directly through the Panel.  
It supports drag-and-drop, multiple file selection, automatic upload, and optional file type restrictions.

## Field value

The value of an **upload** field is a `array`{.type-keyword} containing the uploaded file paths or names.

## Field options

| Option        | Type                   | Description                                                               | Default                                                     |
| ------------- | ---------------------- | ------------------------------------------------------------------------- | ----------------------------------------------------------- |
| `type`        | `string`{.type-string} | Must be set to `upload` to use this field type.                           | `'upload'`                                                  |
| `label`       | `string`{.type-string} | The label displayed above the field.                                      | `''`                                                        |
| `description` | `string`{.type-string} | Optional longer text displayed below the field in smaller size.           | `''`                                                        |
| `default`     | `array`{.type-keyword} | Default uploaded files for the field.                                     | `[]`                                                        |
| `accept`      | `string`{.type-string} | Comma-separated list of allowed file extensions.                          | Configured with the option `system.files.allowedExtensions` |
| `multiple`    | `bool`{.type-bool}     | If `true`, allows multiple file uploads.                                  | `false`                                                     |
| `autoUpload`  | `bool`{.type-bool}     | If `true`, files are automatically uploaded after selection.              | `true`                                                      |
| `required`    | `bool`{.type-bool}     | If `true`, at least one file must be uploaded before submitting the form. | `false`                                                     |
| `disabled`    | `bool`{.type-bool}     | If `true`, the field will be shown as disabled in the Panel.              | `false`                                                     |
