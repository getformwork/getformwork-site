---
title: Number
documentation:
    fields:
        number:
            type: number
description: 'Integer or decimal value.'
---
The **number** field allows users to enter a numeric value.  
It supports minimum, maximum, and step constraints for precise input control.

## Field value
The value of a **number** field is a <code><span class="type-number">number</span></code> representing the numeric value entered by the user.

## Field options

|Option|Type|Description|Default|
|--|--|--|--|
|`type`|<code><span class="type-string">string</span></code>|Must be set to `number` to use this field type.|`'number'`|
|`label`|<code><span class="type-string">string</span></code>|The label displayed above the field.|`''`|
|`description`|<code><span class="type-string">string</span></code>|Optional longer text displayed below the field in smaller size.|`''`|
|`default`|<code><span class="type-number">number</span></code>|Default numeric value of the field.|`0`|
|`placeholder`|<code><span class="type-string">string</span></code>|Placeholder text displayed inside the input.|`''`|
|`icon`|<code><span class="type-string">string</span></code>|Optional icon displayed inside the input.|`''`|
|`min`|<code><span class="type-number">number</span></code>|Minimum allowed value.|`null`|
|`max`|<code><span class="type-number">number</span></code>|Maximum allowed value.|`null`|
|`step`|<code><span class="type-number">number</span></code>|Increment step for the value.|`1`|
|`required`|<code><span class="type-bool">bool</span></code>|If `true`, the field must have a value before submitting the form.|`false`|
|`disabled`|<code><span class="type-bool">bool</span></code>|If `true`, the field will be shown as disabled in the Panel.|`false`|
