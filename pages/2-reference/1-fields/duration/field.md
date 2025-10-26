---
title: Duration
documentation:
    fields:
        duration:
            type: duration
description: 'Used for time durations like `1h 30m`. Allows to enter single time components.'
screenshot: duration.png
---
The **duration** field allows users to enter a numeric duration, optionally constrained by minimum, maximum, and step values.  
It can display the duration in different units such as seconds, minutes, or hours.

## Field value
The value of a **duration** field is a <code><span class="type-number">number</span></code> representing the duration in the specified unit (default is seconds).

## Field options

|Option|Type|Description|Default|
|--|--|--|--|
|`type`|<code><span class="type-string">string</span></code>|Must be set to `duration` to use this field type.|`'duration'`|
|`label`|<code><span class="type-string">string</span></code>|The label displayed above the field.|`''`|
|`description`|<code><span class="type-string">string</span></code>|Optional longer text displayed below the field in smaller size.|`''`|
|`default`|<code><span class="type-number">number</span></code>|Default numeric value of the duration.|`0`|
|`min`|<code><span class="type-number">number</span></code>|Minimum allowed value for the field.|`null`|
|`max`|<code><span class="type-number">number</span></code>|Maximum allowed value for the field.|`null`|
|`step`|<code><span class="type-number">number</span></code>|Increment step for the value.|`1`|
|`unit`|<code><span class="type-string">string</span></code>|Unit for the duration value (e.g., `'seconds'`, `'minutes'`, `'hours'`).|`'seconds'`|
|`intervals`|<code><span class="type-keyword">array</span></code>|Optional array of allowed duration values to restrict user input.|`[]`|
|`required`|<code><span class="type-bool">bool</span></code>|If `true`, the field must have a value before submitting the form.|`false`|
|`disabled`|<code><span class="type-bool">bool</span></code>|If `true`, the field will be shown as disabled in the Panel.|`false`|
