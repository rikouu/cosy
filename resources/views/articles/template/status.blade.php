@extends('layouts.app')

@section('content')
    @include('partials.header')
    <main class="py-4 py-md-5">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-12 col-lg-10 p-lg-5">
                    <div class="post">
                        @if (!empty($content->image))
                            <div class="post-cover mb-3 mb-md-5">
                                <div class="media media-2x1">
                                    <div class="media-content" style="background-image:url('{{ $content->image }}')"></div>
                                </div>
                            </div>
                        @endif
                        <h1 class="post-title h3">{{ $article->title }}</h1>
                        @include('articles.partials.meta')
                        <div class="content-style content">
                            {!! $content->content() !!}
                        </div>
                        @include('components.ad.article')
                        <div class="post-tags mt-3 mt-md-4">
                            @foreach($article->tags as $tag)
                                <a href="{{ $tag->permLink }}" rel="tag">{{ $tag->name }}</a>
                            @endforeach
                        </div>
                        @include('articles.partials.copyright')
                        @include('articles.partials.footer')
                        @include('articles.partials.nav-link')
                    </div>
                    @include('partials.comments')
                </div>
            </div>
        </div>
    </main>
    @include('articles.partials.related')
@endsection
