@if(config('hyde.footer') !== false)
    <footer aria-label="Page footer" class="flex py-4 px-6 w-full text-center mt-auto bg-slate-50 dark:bg-gray-800">
        <div class="prose dark:prose-invert text-center mx-auto ">
            <p>Site proudly built with <a class="text-blue-600 hover:text-blue-700 dark:text-sky-400 hover:underline dark:hover:text-sky-300" href="https://github.com/hydephp/hyde">HydePHP</a> 🎩</p>
        </div>
        <a href="#app" aria-label="Go to top of page" class="float-right">
            <button title="Scroll to top">
                <svg width="1.5rem" height="1.5rem" role="presentation" class="fill-current text-gray-500 h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M7.41 15.41L12 10.83l4.59 4.58L18 14l-6-6-6 6z" />
                </svg>
            </button>
        </a>
    </footer>
@endif