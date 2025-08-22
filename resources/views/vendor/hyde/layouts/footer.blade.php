@if(config('hyde.footer') !== false)
    <footer class="w-full bg-gray-100 dark:bg-gray-800">
        <div class="max-w-5xl mx-auto py-4">
            <h2 class="text-lg mb-4">
                JSON Schema for PHP
            </h2>

            <div class="flex flex-wrap justify-between items-start gap-6 mb-4">
                <div class="text-stone-600 dark:text-stone-300 text-sm flex-1">
                    <p class="">
                        Validate, interpret, and work with JSON Schemas in PHP — fully compatible with the specifications.
                    </p>
                </div>

                <!-- Resources -->
                <div class="flex flex-col space-y-2 text-sm flex-1 ml-32">
                    <h4 class="text-l font-semibold">Developers</h4>
                    <a href="https://github.com/jsonrainbow" class="flex items-center space-x-2 text-gray-600 dark:text-gray-300 hover:text-indigo-600">
                        <span>GitHub Organization</span>
                    </a>
                    <a href="https://github.com/jsonrainbow/json-schema" class="flex items-center space-x-2 text-gray-600 dark:text-gray-300 hover:text-indigo-600">
                        <span>Source code</span>
                    </a>
                </div>

                <!-- Developers -->
                <div class="flex flex-col space-y-2 text-sm flex-1">
                    <h4 class="text-l font-semibold">Resources</h4>
                    <a href="{{ url('docs/getting-started') }}" class="flex items-center space-x-2 text-gray-600 dark:text-gray-300 hover:text-indigo-600">
                        <span>Documentation</span>
                    </a>
                </div>

                <!-- Extra -->
                <div class="flex flex-col space-y-2 text-sm flex-1">
                    <h4 class="text-l font-semibold">Extra</h4>
                    <a href="{{ Hyde::relativeLink('sitemap.html') }}" class="flex items-center space-x-2 text-gray-600 dark:text-gray-300 hover:text-indigo-600">
                        <span>Sitemap</span>
                    </a>
                    <a href="{{ Hyde::relativeLink('feed.xml') }}" class="flex items-center space-x-2 text-gray-600 dark:text-gray-300 hover:text-indigo-600">
                        <span>RSS Feed</span>
                    </a>
                </div>
            </div>

            <!-- Attribution -->
            <div class="text-gray-600 dark:text-gray-300 text-sm flex-1 text-center
">
                <p> This site was build using <a href="https://hydephp.com/" class="text-indigo-600">HydePHP</a>
                    and <a href="https://torchlight.dev/" class="text-indigo-600">Torchlight.dev</a></p>
            </div>
        </div>
    </footer>
@endif