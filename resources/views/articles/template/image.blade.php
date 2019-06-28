@extends('layouts.app')

@php
    $showSideBar = false
@endphp

@section('content')
    <main class="py-4 py-md-5">
        <div class="container">
            @includeWhen($showSideBar, 'articles.partials._breadcrumbs')

            @if (!empty($content->image))
            <div class="post-cover list-rounded overlay-hover mb-2 mb-md-5">
                <div class="d-flex flex-fill bg-img bg-dark text-center h-v-33" style="background-image: url('{{ $content->image }}');">
                    <div class="d-flex flex-fill flex-column align-items-center bg-dark-overlay py-12">
                        <div class="m-auto p-4">
                            <h1 class="h3 text-white">{{ $article->title }}</h1>
                        </div>
                    </div>
                </div>
            </div>

                {{-- <div class="post-cover list-rounded overlay-hover mb-2 mb-md-5">
                    <div class="media media-21x9">
                        <div class="media-content" style="background-image:url('{{ $content->image }}')"><span class="overlay"></span></div>
                        <div class="media-overlay overlay-bottom flex-column p-3 p-md-4">
                            <div class="d-block text-sm mt-md-1 mb-2 mb-md-3">
                                <a href="https://demo.nicetheme.xyz/panda-pro-style-one/category/shenghuo" target="_blank"><span class="badge badge-primary">生活</span></a>
                            </div>
                            <h1 class="h3 text-white">{{ $article->title }}</h1>

                            <div class="meta text-xs text-muted">
                                <time class="d-inline-block">2019-06-20 1:22:38</time>
                                <span class="mx-1"><i class="text-md iconfont icon-eye-line mx-1"></i><small>345</small></span>
                                <a class="mx-1" href="#comments"><i class="text-md iconfont icon-chat--line mx-1"></i><small>0</small></a>
                                <a class="btn-like btn-link-like  mx-1" href="javascript:;" data-action="like" data-id="4615"><i class="text-md iconfont icon-thumb-up-line mx-1"></i><small class="like-count">3</small></a>
                            </div>
                        </div>
                    </div>
                </div> --}}
            @endif

            @if ($showSideBar)
                <div class="row no-gutters">
                    <div class="col-12 col-lg-9 pr-lg-5">
            @else
                <div class="row justify-content-lg-center">
                    <div class="col-12 col-lg-10 px-lg-5">
            @endif
                        <div class="post" id="post">
                            @include('articles.partials._meta')
                            <article-content class="content-style content">
                                {!! $content->content() !!}
                            </article-content>
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
                @if($showSideBar)
                    <div class="sidebar col-lg-3 d-none d-lg-block">
                        @include('commons.sidebar')
                    </div>
                @endif
            </div>
        </div>
    </main>
    @include('articles.partials._related')
@endsection
