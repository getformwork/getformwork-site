---
title: Color
documentation:
    fields:
        color:
            type: color
description: 'A color picker. Lets you choose a color visually.'
screenshot: color.png
---
The **color** field allows users to select a color value using the native browser color picker.  
A preview of the selected color and its hexadecimal value is displayed next to the input.

## Field value
The value of a **color** field is a <code><span class="type-string">string</span></code> representing a color in hexadecimal format (e.g. `'#ff6600'`).

## Field options

|Option|Type|Description|Default|
|--|--|--|--|
|`type`|<code><span class="type-string">string</span></code>|Must be set to `color` to use this field type.|`'color'`|
|`label`|<code><span class="type-string">string</span></code>|The label displayed above the field.|`''`|
|`description`|<code><span class="type-string">string</span></code>|Optional longer text displayed below the field in smaller size.|`''`|
|`default`|<code><span class="type-string">string</span></code>|Default color value in hexadecimal format.|`'#000000'`|
|`placeholder`|<code><span class="type-string">string</span></code>|Placeholder text displayed when no color is selected.|`''`|
|`class`|<code><span class="type-string">string</span></code>|Additional CSS class names to apply to the input element.|`''`|
|`required`|<code><span class="type-bool">bool</span></code>|If `true`, the field must have a color value before submitting the form.|`false`|
|`disabled`|<code><span class="type-bool">bool</span></code>|If `true`, the field will be shown as disabled in the Panel.|`false`|
