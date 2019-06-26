@php
    $grid_class = 'row-md list-archive list-grouped list-tb-padding';
@endphp

@extends('layouts.app')

@section('content')
<main class="py-4 py-md-5 h-v-75">
    <div class="container">
        <h1 class="h2 mb-4">专题</h1>
        <div class="row list-grouped">
            @foreach($topics as $topic)
                <div class="col-md-6">
                    <div class="list-item block">
                        <div class="media media-21x9">
                            <a class="media-content" href="{{ $topic->getLink() }}" target="_blank" style="background-image:url(@image($topic->image))">
                                <div class="media-overlay overlay-top p-3">
                                    <small><i class="text-xl iconfont icon-file-text-line"></i></small><span class="h1 text-white font-theme">{{ $topic->articles_count ?? 0 }}</span>
                                </div>
                            </a>
                        </div>
                        <div class="list-content">
                            <div class="list-body ">
                                <a href="{{ $topic->getLink() }}" target="_blank" class="list-title text-md">{{ $topic->getName() }}</a>
                                <div class="list-desc text-xs text-muted h-2x mt-2">{{ $topic->description }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- <main class="py-4 py-md-5">
        <div class="container">
            @if($style === 'plain')
                <div class="row justify-content-md-center">
                    <div class="col-md-9">
                        @endif
                        <div class="list-header p-0 mb-3">
                            <div class="h4">
                                <span>{{ $topic->name }}</span>
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
        </div> --}}
    </main>
@endsection
