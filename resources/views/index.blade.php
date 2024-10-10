@extends('statamic::layout')

@section('content')
    <div class="flex items-center justify-between mb-3">
        <h1 class="flex-1">@lang('fine-seo::messages.seo_title')</hjson>
    </div>

    <div class="card">
        <h2 class="mb-2">@lang('fine-seo::messages.setup_heading')</h2>
        <p>
            @lang('fine-seo::messages.about_paragraph_1')
        </p>
        <p class="mt-2">
            @lang('fine-seo::messages.about_paragraph_2')
            
        </p>
    </div>
    <div class="mt-4 card">
        <h3>@lang('fine-seo::messages.setup_collections')</h3>
        <form method="POST" class="flex justify-between items-end" action="{{ cp_route('fine-seo.setup') }}">
            <div class="flex flex-col space-y-2">
                @csrf
                <label for="collections">
                    @lang('fine-seo::messages.select_collections')
                </label>

                <div class="flex w-full gap-2">
                    @foreach ($collections as $collection)
                        {{-- Checked if $collection->hasFineSeo --}}
                        <input type="checkbox" name="collections[]" id="{{ $collection->handle }}"
                            value="{{ $collection->handle }}" {{ $collection->hasFineSeo ? 'checked' : '' }}>
                        <label for="{{ $collection->handle }}">{{ $collection->title }}</label>
                    @endforeach
                    {{-- error --}}
                    @error('collections')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div>
                <button class="btn-primary">
                    @lang('fine-seo::messages.setup_collections')
                </button>
            </div>
        </form>
    </div>
    <div class="mt-4 card">
        <h3>
            @lang('fine-seo::messages.setup_global_brand')
        </h3>
        <form method="POST" class="flex justify-between items-end" action="{{ cp_route('fine-seo.brand') }}">
            <div class="flex flex-col space-y-2">
                @csrf
                <p class="mt-4 text-red-500">
                    @lang('fine-seo::messages.setup_global_brand_warning')
                </p>
            </div>
            <div>
                <button class="btn-default">
                    @lang('fine-seo::messages.setup_global_brand')
                </button>
            </div>
        </form>
    </div>
@endsection
