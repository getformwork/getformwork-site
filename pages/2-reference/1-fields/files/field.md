---
title: Files
documentation:
    fields:
        files:
            type: files
description: 'Multiple file references.'
---
The **files** field allows users to select multiple files from a predefined list of options.  
Selected files are displayed as tags, and the order can be optionally rearranged.

## Field value
The value of a **files** field is a <code><span class="type-keyword">array</span></code> containing the selected file keys from the available options.

## Field options

|Option|Type|Description|Default|
|--|--|--|--|
|`type`|<code><span class="type-string">string</span></code>|Must be set to `files` to use this field type.|`'files'`|
|`label`|<code><span class="type-string">string</span></code>|The label displayed above the field.|`''`|
|`description`|<code><span class="type-string">string</span></code>|Optional longer text displayed below the field in smaller size.|`''`|
|`default`|<code><span class="type-keyword">array</span></code>|Default selected file keys.|`[]`|
|`icon`|<code><span class="type-string">string</span></code>|Icon displayed inside the input.|`'file'`|
|`placeholder`|<code><span class="type-string">string</span></code>|Placeholder text displayed when no files are selected.|`''`|
|`options`|<code><span class="type-keyword">array</span></code>|List of available files that can be selected.|`[]`|
|`limit`|<code><span class="type-number">number</span></code>|Maximum number of files that can be selected. `0` or `null` for unlimited.|`0`|
|`orderable`|<code><span class="type-bool">bool</span></code>|If `true`, users can reorder selected files.|`false`|
|`required`|<code><span class="type-bool">bool</span></code>|If `true`, at least one file must be selected before submitting the form.|`false`|
|`disabled`|<code><span class="type-bool">bool</span></code>|If `true`, the field will be shown as disabled in the Panel.|`false`|
