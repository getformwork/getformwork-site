---
title: Upload
documentation:
    fields:
        upload:
            type: upload
description: 'File uploader from a local device. Can display the uploaded files.'
screenshot: upload.png
---
The **upload** field allows users to upload one or multiple files directly through the Panel.  
It supports drag-and-drop, multiple file selection, automatic upload, and optional file type restrictions.

## Field value
The value of an **upload** field is a <code><span class="type-keyword">array</span></code> containing the uploaded file paths or names.

## Field options

|Option|Type|Description|Default|
|--|--|--|--|
|`type`|<code><span class="type-string">string</span></code>|Must be set to `upload` to use this field type.|`'upload'`|
|`label`|<code><span class="type-string">string</span></code>|The label displayed above the field.|`''`|
|`description`|<code><span class="type-string">string</span></code>|Optional longer text displayed below the field in smaller size.|`''`|
|`default`|<code><span class="type-keyword">array</span></code>|Default uploaded files for the field.|`[]`|
|`accept`|<code><span class="type-string">string</span></code>|Comma-separated list of allowed file extensions.|Configured with the option `system.files.allowedExtensions`|
|`multiple`|<code><span class="type-bool">bool</span></code>|If `true`, allows multiple file uploads.|`false`|
|`autoUpload`|<code><span class="type-bool">bool</span></code>|If `true`, files are automatically uploaded after selection.|`true`|
|`required`|<code><span class="type-bool">bool</span></code>|If `true`, at least one file must be uploaded before submitting the form.|`false`|
|`disabled`|<code><span class="type-bool">bool</span></code>|If `true`, the field will be shown as disabled in the Panel.|`false`|
