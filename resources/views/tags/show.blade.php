@php
    $style = $tag->style;
    $grid_class = 'row-md list-archive list-grouped list-tb-padding';
@endphp

@extends('layouts.app')

@section('content')
    @include('components.top.article', compact('topArticles', 'style'))
    <main class="py-4 py-md-5">
        <div class="container">
            @if($style === 'plain')
                <div class="row justify-content-md-center">
                    <div class="col-md-9">
                        @endif
                        <div class="list-header p-0 mb-3">
                            <div class="h4">
                                <span>{{ $tag->name }}</span>
                            </div>
                        </div>
                        @if($articles->isNotEmpty())
                            <div class="{{ $grid_class }}" id="articles">
                                @include('components.articles.' . $style ?? 'small')
                            </div>

                            @if (config('prism.app.ajax.tag', true))
                                @include('partials.navigation')
                            @else
                                {!! $articles->links() !!}
                            @endif
                        @else
                            <div class="content-error h-v-66">
                                @include('components.not-found-svg')
                                <p class="text-lg text-muted mt-5">
                                    {{  __('It looks like nothing was found at this location. Maybe try one of the links below or a search?') }}
                                </p>
                            </div>
                        @endif
                        @if($style === 'plain')
                    </div>
                </div>
            @endif
        </div>
    </main>
@endsection
