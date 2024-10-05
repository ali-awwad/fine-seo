@extends('statamic::layout')

@section('content')
    <div class="flex items-center justify-between mb-3">
        <h1 class="flex-1">Statamic Fine SEO</hjson>
    </div>

    <div class="card">
        <h2 class="mb-2">Setup SEO</h2>
        <p>
            This addon will help you to setup SEO for your website. You can add SEO fields to collections of your choice.
        </p>
        <p>
            Also this will setup Global Brand for you.
        </p>
        <p class="mt-4 text-red-500">
            * You can use the SEO alone without the Global Brand. but you need to copy the antlers code and update it to use your custom globals.
        </p>
        <div class="mt-4 flex gap-2">
            <form method="POST" action="{{ cp_route('fine-seo.setup') }}">
                @csrf
                <button class="btn-primary">Setup SEO</button>
            </form>
            <form method="POST" action="{{ cp_route('fine-seo.brand') }}">
                @csrf
                <button class="btn-default">Setup Global Brand</button>
            </form>

        </div>
    </div>
@endsection
