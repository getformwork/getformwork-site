---
title: Images
documentation:
    fields:
        images:
            type: images
description: 'Multiple image selector with previews.'
---
The **images** field allows users to select multiple images from a predefined list of options.  
Selected images are displayed as tags, and their order can be optionally rearranged.

## Field value
The value of an **images** field is a <code><span class="type-keyword">array</span></code> containing the selected image keys from the available options.

## Field options

|Option|Type|Description|Default|
|--|--|--|--|
|`type`|<code><span class="type-string">string</span></code>|Must be set to `images` to use this field type.|`'images'`|
|`label`|<code><span class="type-string">string</span></code>|The label displayed above the field.|`''`|
|`description`|<code><span class="type-string">string</span></code>|Optional longer text displayed below the field in smaller size.|`''`|
|`default`|<code><span class="type-keyword">array</span></code>|Default selected image keys.|`[]`|
|`icon`|<code><span class="type-string">string</span></code>|Icon displayed inside the input.|`'image'`|
|`placeholder`|<code><span class="type-string">string</span></code>|Placeholder text displayed when no images are selected.|`''`|
|`options`|<code><span class="type-keyword">array</span></code>|List of available images that can be selected.|`[]`|
|`limit`|<code><span class="type-number">number</span></code>|Maximum number of images that can be selected. `0` or `null` for unlimited.|`0`|
|`orderable`|<code><span class="type-bool">bool</span></code>|If `true`, users can reorder selected images.|`false`|
|`required`|<code><span class="type-bool">bool</span></code>|If `true`, at least one image must be selected before submitting the form.|`false`|
|`disabled`|<code><span class="type-bool">bool</span></code>|If `true`, the field will be shown as disabled in the Panel.|`false`|
