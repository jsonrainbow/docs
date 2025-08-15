---
title: 'Getting started'
navigation:
    priority: 10
---

# Getting started

## Installing JSON Schema Using Composer
The recommended method of installing JSON Schema is using Composer, which installs the required dependencies on
a per-project basis.

```bash
composer require justinrainbow/json-schema
```

## Validating using a schema on disk

```php
<?php

$data = json_decode(file_get_contents('data.json'));

// Validate
$validator = new JsonSchema\Validator;
$validator->validate($data, (object)['$ref' => 'file://' . realpath('schema.json')]);

if ($validator->isValid()) {
    echo "The supplied JSON validates against the schema.\n";
} else {
    echo "JSON does not validate. Violations:\n";
    foreach ($validator->getErrors() as $error) {
        printf("[%s] %s\n", $error['property'], $error['message']);
    }
}
```

## Validating using an inline schema

```php
<?php

use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

require_once './vendor/autoload.php';

$data = json_decode(file_get_contents('data.json'));
$jsonSchemaAsString = <<<'JSON'
{
  "type": "object",
  "properties": {
    "name": { "type": "string"},
    "email": {"type": "string"}
  },
  "required": ["name","email"]
}
JSON;

$jsonSchema = json_decode($jsonSchemaAsString);
$schemaStorage = new SchemaStorage();
$schemaStorage->addSchema('internal://mySchema', $jsonSchema);
$validator = new Validator(new Factory($schemaStorage));

$validator->validate($data, $jsonSchemaObject);
if ($validator->isValid()) {
    echo "The supplied JSON validates against the schema.\n";
} else {
    echo "JSON does not validate. Violations:\n";
    foreach ($validator->getErrors() as $error) {
        printf("[%s] %s\n", $error['property'], $error['message']);
    }
}
```