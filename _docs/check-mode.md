---
title: Check mode
navigation:
  priority: 15
---

# Check mode

JSON Schema for PHP check mode can be configured using the flags from the Constraint class. These can be configured as default 
or provided for a single `validate()` call.

```php
$checkMode = Constraint::CHECK_MODE_NORMAL | Constraint::CHECK_MODE_VALIDATE_SCHEMA;

$validator = new Validator(
    new Factory(
        null,
        null,
        $checkMode  // Setting the default check mode for all validate calls.
    )
);

// -- OR -- 

$validator->validate(
    $data,
    $schema,
    $checkMode  // Or set the check mode for this validation call.
);
```



## Available flags
| Flag                                            |   | Value        | Description                                                   |
|-------------------------------------------------|:--|--------------|---------------------------------------------------------------|
| `Constraint::CHECK_MODE_NORMAL`                 |   | `0x00000001` | Validate in 'normal' mode - this is the default               |
| `Constraint::CHECK_MODE_TYPE_CAST`              |   | `0x00000002` | Enable fuzzy type checking for associative arrays and objects |
| `Constraint::CHECK_MODE_COERCE_TYPES`           |   | `0x00000004` | Convert data types to match the schema where possible         |
| `Constraint::CHECK_MODE_APPLY_DEFAULTS`         |   | `0x00000008` | Apply default values from the schema if not set               |
| `Constraint::CHECK_MODE_EXCEPTIONS`             |   | `0x00000010` | Throw an exception immediately if validation fails            |
| `Constraint::CHECK_MODE_DISABLE_FORMAT`         |   | `0x00000020` | Do not validate "format" constraints                          |
| `Constraint::CHECK_MODE_EARLY_COERCE`           |   | `0x00000040` | Apply type coercion as soon as possible                       |
| `Constraint::CHECK_MODE_ONLY_REQUIRED_DEFAULTS` |   | `0x00000080` | When applying defaults, only set values that are required     |
| `Constraint::CHECK_MODE_VALIDATE_SCHEMA`        |   | `0x00000100` | Validate the schema as well as the provided document          |
