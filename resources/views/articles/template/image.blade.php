@extends('layouts.app')

@section('content')
    <main class="py-4 py-md-5">
        <div class="container">
            @if (!empty($content->image))
                <div class="post-cover">
                    <div class="d-flex flex-fill bg-img bg-dark text-center h-v-33" style="background-image: url('{{ $content->image }}');">
                        <div class="d-flex flex-fill flex-column align-items-center bg-dark-overlay py-5">
                            <div class="m-auto p-4">
                                <h1 class="h3 text-white">{{ $article->title }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row justify-content-lg-center">
                <div class="col-12 col-lg-10 px-lg-5">
                    <div class="post">
                        @include('articles.partials._meta')
                        <div class="content-style content">
                            {!! $content->content() !!}
                        </div>
                        <div class="post-tags mt-3 mt-md-4">
                            @foreach($article->tags as $tag)
                                <a href="{{ $tag->getLink() }}" rel="tag">{{ $tag->name }}</a>
                            @endforeach
                        </div>
                        @include('articles.partials._copyright')
                        @include('articles.partials._footer')
                        @include('articles.partials._nav-link')
                    </div>
                    @include('commons.comments')
                </div>
            </div>
        </div>
    </main>
    @include('articles.partials._related')
@endsection
