@extends('layouts.app')

@section('content')
    @include('partials.header')
    <main class="py-4 py-md-5">
        <div class="container">
            @include('articles.partials.breadcrumbs')
            <div class="row no-gutters">
                <div class="col-12 col-lg-9 pr-lg-5">
                    <div class="post">
                        <h1 class="post-title h3">{{ $article->title }}</h1>
                        @include('articles.partials.meta')
                        <div class="content-style content">
                            {!! $content->content() !!}
                        </div>
                        <div class="post-tags mt-3 mt-md-4">
                            @foreach($article->tags as $tag)
                                <a href="{{ $tag->permLink }}" rel="tag">{{ $tag->name }}</a>
                            @endforeach
                        </div>
                        @include('articles.partials.copyright' )
                        @include('articles.partials.footer')
                        @include('articles.partials.nav-link')
                    </div>
                    @include('partials.comments')
                </div>
                <div class="sidebar col-lg-3 d-none d-lg-block">
                    @include('partials.sidebar')
                </div>
            </div>
        </div>
    </main>
    @include('articles.partials.related')
@endsection
