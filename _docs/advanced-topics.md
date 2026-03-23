---
title: 'Advanced topics'
navigation:
  priority: 20
---

# Advanced topics

## Validation using schema on disk
Validation of a JSON document can be done using a schema located on disk.

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

## Validation using inline schema
Validation of a JSON document can be done using a inline schema. This requires some additional setup of the schema storage
```php
<?php

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
$schemaStorage = new JsonSchema\SchemaStorage();
$schemaStorage->addSchema('internal://mySchema', $jsonSchema);
$validator = new JsonSchema\Validator(
    new JsonSchema\Constraints\Factory($schemaStorage)
);
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

## Validation using online schema
Validation of a JSON document can be done using a schema hosted online. The validator will automatically fetch the schema from the provided URL using its built-in `UriRetriever`.

```php
<?php

$data = json_decode(file_get_contents('data.json'), false);

// Validate against an online schema by passing the URL as a $ref
$validator = new JsonSchema\Validator();
$validator->validate($data, (object)['$ref' => 'https://example.com/your/schema.json']);

if ($validator->isValid()) {
    echo "The supplied JSON validates against the schema.\n";
} else {
    echo "JSON does not validate. Violations:\n";
    foreach ($validator->getErrors() as $error) {
        printf("[%s] %s\n", $error['property'], $error['message']);
    }
}
```

If you need more control over how the remote schema is retrieved (e.g. to cache it or pre-load it), you can use `UriRetriever` and `SchemaStorage` explicitly:

```php
<?php

use JsonSchema\SchemaStorage;
use JsonSchema\Validator;
use JsonSchema\Constraints\Factory;
use JsonSchema\Uri\UriRetriever;

$schemaUrl = 'https://example.com/your/schema.json';

// Fetch the remote schema
$retriever = new UriRetriever();
$schema = $retriever->retrieve($schemaUrl);

// Register the fetched schema so that any $ref inside it resolves correctly
$schemaStorage = new SchemaStorage($retriever);
$schemaStorage->addSchema($schemaUrl, $schema);

$validator = new Validator(new Factory($schemaStorage));

$data = json_decode(file_get_contents('data.json'), false);
$validator->validate($data, $schema);

if ($validator->isValid()) {
    echo "The supplied JSON validates against the schema.\n";
} else {
    echo "JSON does not validate. Violations:\n";
    foreach ($validator->getErrors() as $error) {
        printf("[%s] %s\n", $error['property'], $error['message']);
    }
}
```

## Using custom error messages
This paragraph needs to be written, want to help out? Checkout GitHub repo!

# Validating using strict mode (Draft 6 only)
```php
<?php

$data = json_decode(file_get_contents('data.json'));
$jsonSchemaAsString = <<<'JSON'
{
  "$schema": "http://json-schema.org/draft-06/schema#",
  "$id": "https://example.com/schemas/user.json",
  "type": "object",
  "properties": {
    "name": { "type": "string" },
    "email": { "type": "string" }
  },
  "required": ["name", "email"]
}
JSON;

$jsonSchema = json_decode($jsonSchemaAsString);
$schemaStorage = new JsonSchema\SchemaStorage();
$schemaStorage->addSchema($jsonSchema->$id, $jsonSchema);
$validator = new JsonSchema\Validator(
    new JsonSchema\Constraints\Factory($schemaStorage)
);
$checkMode = Constraint::CHECK_MODE_NORMAL | Constraint::CHECK_MODE_STRICT;
$validator->validate($data, $jsonSchemaObject, $checkMode);

if ($validator->isValid()) {
    echo "The supplied JSON validates against the schema.\n";
} else {
    echo "JSON does not validate. Violations:\n";
    foreach ($validator->getErrors() as $error) {
        printf("[%s] %s\n", $error['property'], $error['message']);
    }
}
```