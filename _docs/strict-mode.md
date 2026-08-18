---
title: 'Strict mode'
navigation:
  priority: 18
---

# Strict mode

By default, JSON Schema for PHP validates your document with a single, draft-agnostic set of constraints. That is
forgiving, but it means keywords that only exist in a newer draft are not evaluated the way that draft's
specification describes them.

Strict mode changes this. When `Constraint::CHECK_MODE_STRICT` is enabled, the validator picks the constraint set
belonging to one specific JSON Schema draft — the *dialect* — and validates your document with that. The result is
behaviour and error messages that follow the chosen specification.

## Enabling strict mode

Strict mode is a check mode flag, so it can be set as the default for the whole factory, or per `validate()` call.

```php
<?php

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\Validator;

$checkMode = Constraint::CHECK_MODE_NORMAL | Constraint::CHECK_MODE_STRICT;

$validator = new Validator(
    new Factory(
        null,
        null,
        $checkMode  // Strict mode for all validate calls on this validator.
    )
);

// -- OR --

$validator->validate(
    $data,
    $schema,
    $checkMode  // Strict mode for this validation call only.
);
```

## Choosing the draft

The dialect is taken from the `$schema` keyword of the schema you validate against. Declare it, and your document is
validated against exactly that draft.

```php
<?php

use JsonSchema\Constraints\Constraint;
use JsonSchema\Validator;

$data = json_decode('{"creditCard": "1234-5678-9012-3456"}');

$schemaAsString = <<<'JSON'
{
  "$schema": "https://json-schema.org/draft/2019-09/schema",
  "type": "object",
  "properties": {
    "creditCard": { "type": "string" },
    "billingAddress": { "type": "string" }
  },
  "dependentRequired": {
    "creditCard": ["billingAddress"]
  }
}
JSON;

$schema = json_decode($schemaAsString);

$validator = new Validator();
$validator->validate($data, $schema, Constraint::CHECK_MODE_NORMAL | Constraint::CHECK_MODE_STRICT);

if ($validator->isValid()) {
    echo "The supplied JSON validates against the schema.\n";
} else {
    echo "JSON does not validate. Violations:\n";
    foreach ($validator->getErrors() as $error) {
        printf("[%s] %s\n", $error['property'], $error['message']);
    }
}
```

Because the schema declares Draft 2019-09, the `dependentRequired` keyword is evaluated and the missing
`billingAddress` is reported. Without strict mode, `dependentRequired` is not a keyword the default constraint set
knows about, and the document is considered valid.

## Supported drafts

Strict mode is available for a subset of the drafts the library supports.

| Draft         | `$schema` identifier                            | Strict mode                |
|---------------|-------------------------------------------------|----------------------------|
| Draft 3       | `http://json-schema.org/draft-03/schema#`       | Not supported              |
| Draft 4       | `http://json-schema.org/draft-04/schema#`       | Not supported              |
| Draft 6       | `http://json-schema.org/draft-06/schema#`       | Supported (default)        |
| Draft 7       | `http://json-schema.org/draft-07/schema#`       | Supported                  |
| Draft 2019-09 | `https://json-schema.org/draft/2019-09/schema`  | Supported as of 6.10.0     |
| Draft 2020-12 | `https://json-schema.org/draft/2020-12/schema`  | Not supported yet          |

This table describes strict mode only. Draft 3 and Draft 4 schemas remain fully usable in normal validation — they
simply have no dedicated strict mode constraint set.

## Schemas without a $schema keyword

When the schema does not declare `$schema`, the validator falls back to the factory's default dialect, which is
**Draft 6**. A Draft 2019-09 schema that omits `$schema` is therefore validated as Draft 6, and its newer keywords
are ignored without warning.

Use `Factory::setDefaultDialect()` to change that fallback:

```php
<?php

use JsonSchema\Constraints\Constraint;
use JsonSchema\Constraints\Factory;
use JsonSchema\DraftIdentifiers;
use JsonSchema\Validator;

$factory = new Factory(null, null, Constraint::CHECK_MODE_NORMAL | Constraint::CHECK_MODE_STRICT);
$factory->setDefaultDialect(DraftIdentifiers::DRAFT_2019_09);

$validator = new Validator($factory);
$validator->validate($data, $schema);
```

The `JsonSchema\DraftIdentifiers` class holds a constant for every draft identifier, so you do not have to repeat the
URIs yourself: `DRAFT_3`, `DRAFT_4`, `DRAFT_6`, `DRAFT_7`, `DRAFT_2019_09` and `DRAFT_2020_12`.

A `$schema` keyword in the schema always wins over the default dialect. The default only applies when the keyword is
absent.

## Related

Strict mode is one of several check mode flags, and can be combined with the others. See
[Check mode](check-mode.html) for the complete list.
