@extends('layouts.app')

@section('content')
    <main class="py-4 py-md-5">
        <div class="container">
            @include('articles.partials._breadcrumbs')
            <div class="row no-gutters">
                <div class="col-12 col-lg-9 pr-lg-5">
                    <div class="post" id="post">
                        <h1 class="post-title h3">{{ $article->title }}</h1>
                        <div class="my-4">
                            @include('articles.partials._meta')
                        </div>
                        <article-content class="content-style content">
                            {!! $content->content() !!}
                        </article-content>
                        <div class="post-tags mt-3 mt-md-4">
                            @foreach($article->tags as $tag)
                                <a href="{{ $tag->getLink() }}" rel="tag">{{ $tag->name }}</a>
                            @endforeach
                        </div>
                        @include('articles.partials._copyright' )
                        @include('articles.partials._footer')
                        @include('articles.partials._nav-link')
                    </div>
                    @include('commons.comments')
                </div>
                <div class="sidebar col-lg-3 d-none d-lg-block">
                    @include('commons.sidebar')
                </div>
            </div>
        </div>
    </main>
    @include('articles.partials._related')
@endsection
