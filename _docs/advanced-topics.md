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
This paragraph needs to be written, want to help out? Checkout GitHub repo!

## Using custom error messages
This paragraph needs to be written, want to help out? Checkout GitHub repo!
