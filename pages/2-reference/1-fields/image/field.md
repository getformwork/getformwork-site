---
title: Image
documentation:
    fields:
        image:
            type: image
description: 'Single image selector with preview.'
screenshot: image.png
---
The **image** field allows users to select a single image from a predefined list of options.  
Each option can include an icon or a thumbnail to provide a visual preview.

## Field value
The value of an **image** field is a <code><span class="type-string">string</span></code> representing the selected image key from the list of options.

## Field options

|Option|Type|Description|Default|
|--|--|--|--|
|`type`|<code><span class="type-string">string</span></code>|Must be set to `image` to use this field type.|`'image'`|
|`label`|<code><span class="type-string">string</span></code>|The label displayed above the field.|`''`|
|`description`|<code><span class="type-string">string</span></code>|Optional longer text displayed below the field in smaller size.|`''`|
|`default`|<code><span class="type-string">string</span></code>|Default selected image key.|`''`|
|`icon`|<code><span class="type-string">string</span></code>|Icon displayed inside the select input.|`'image'`|
|`options`|<code><span class="type-keyword">array</span></code>|List of available images. Each option can include `value`, `icon`, and `thumb` keys.|`[]`|
|`required`|<code><span class="type-bool">bool</span></code>|If `true`, the field must have a value before submitting the form.|`false`|
|`disabled`|<code><span class="type-bool">bool</span></code>|If `true`, the field will be shown as disabled in the Panel.|`false`|
