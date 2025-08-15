@extends('hyde::layouts.app')

@section('content')
    <div class="bg-gradient-to-b from-gray-50 to-white py-20">
        <div class="max-w-5xl mx-auto text-center px-4">
            <!-- Logos -->
            <div class="flex items-center justify-center gap-6 mb-6">
                <img src="media/json-schema-logo-blue.svg" alt="JSON Schema Logo" class="h-60 w-60 object-contain">
                <span class="text-5xl font-bold text-gray-500">+</span>
                <img src="media/php-logo.svg" alt="PHP Logo" class="h-60 w-60 object-contain">
            </div>

            <!-- Title & Description -->
            <h1 class="text-5xl font-bold text-gray-800">JSON Schema for PHP</h1>
            <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">
                Validate, interpret, and work with JSON Schemas in PHP — fully compatible with the specifications.
            </p>

            <!-- CTA -->
            <div class="mt-8">
                <a href="{{ url('getting-started') }}"
                   class="inline-block px-8 py-3 bg-blue-600 text-white text-lg font-semibold rounded-lg shadow hover:bg-blue-700">
                    Get Started →
                </a>
            </div>
        </div>
    </div>

    <!-- Features -->
    <div class="max-w-6xl mx-auto grid md:grid-cols-3 gap-8 py-16 px-4">
        <div class="p-6 bg-white rounded-2xl shadow">
            <h2 class="text-xl font-semibold text-gray-800 mb-2">Standards Compliant</h2>
            <p class="text-gray-600">
                Implements the official <a href="https://json-schema.org/specification" class="text-blue-600">JSON Schema specification</a>
                (Draft 3 and 4), ensuring predictable and reliable validation.
            </p>
        </div>
        <div class="p-6 bg-white rounded-2xl shadow">
            <h2 class="text-xl font-semibold text-gray-800 mb-2">Developer Friendly</h2>
            <p class="text-gray-600">
                Simple, expressive API designed for modern PHP projects. Integrates easily into frameworks like Laravel, Symfony, and more.
            </p>
        </div>
        <div class="p-6 bg-white rounded-2xl shadow">
            <h2 class="text-xl font-semibold text-gray-800 mb-2">Extensible</h2>
            <p class="text-gray-600">
                Built with extensibility in mind — customize validation rules, add formats, or adapt to domain-specific requirements.
            </p>
        </div>
    </div>

    <!-- Example -->
    <div class="bg-gray-50 py-16">
        <div class="max-w-4xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Example</h2>
            <pre class="bg-white rounded-lg shadow p-4 overflow-x-auto text-sm">
<code class="language-php">

$schema = json_decode(file_get_contents('person.schema.json'));
$data = json_decode('{"name": "Alice", "age": 30}');

$validator = new \JsonSchema\Validator();
$validator->validate($data, $schema);

if ($validator->isValid()) {
    echo "✅ The supplied JSON validates against the schema.\n";
} else {
    echo "❌ JSON does not validate. Violations:\n";
    foreach ($validator->getErrors() as $error) {
        printf("[%s] %s\n", $error['property'], $error['message']);
    }
}
</code>
            </pre>
        </div>
    </div>
@endsection
