{{-- The Markdown Page Layout --}}
@extends('hyde::layouts.app')
@section('content')
<div class="bg-gradient-to-b from-slate-400 to-slate-50 dark:bg-gradient-to-t dark:from-slate-800 dark:to-slate-400">
    <main id="content" class="mx-auto max-w-7xl py-16 px-8">
        <article @class(['mx-auto', config('markdown.prose_classes', 'prose dark:prose-invert'), 'torchlight-enabled' => Features::hasTorchlight()])>
            {{ $content }}
        </article>
    </main>
</div>
@endsection