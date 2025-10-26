---
title: Range
documentation:
    fields:
        range:
            type: range
description: 'Slider for numeric values within a defined range.'
screenshot: range.png
---
The **range** field allows users to select a numeric value within a defined range using a slider.  
It supports minimum, maximum, step values, and optional ticks for visual guidance.

## Field value
The value of a **range** field is a <code><span class="type-number">number</span></code> representing the selected value on the slider.

## Field options

|Option|Type|Description|Default|
|--|--|--|--|
|`type`|<code><span class="type-string">string</span></code>|Must be set to `range` to use this field type.|`'range'`|
|`label`|<code><span class="type-string">string</span></code>|The label displayed above the field.|`''`|
|`description`|<code><span class="type-string">string</span></code>|Optional longer text displayed below the field in smaller size.|`''`|
|`default`|<code><span class="type-number">number</span></code>|Default numeric value for the slider.|`0`|
|`min`|<code><span class="type-number">number</span></code>|Minimum allowed value.|`0`|
|`max`|<code><span class="type-number">number</span></code>|Maximum allowed value.|`100`|
|`step`|<code><span class="type-number">number</span></code>|Increment step for the value.|`1`|
|`ticks`|<code><span class="type-keyword">array</span></code>|Optional array of tick values displayed on the slider.|`[]`|
|`required`|<code><span class="type-bool">bool</span></code>|If `true`, the field must have a value before submitting the form.|`false`|
|`disabled`|<code><span class="type-bool">bool</span></code>|If `true`, the field will be shown as disabled in the Panel.|`false`|
