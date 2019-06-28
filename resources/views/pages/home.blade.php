@extends('layouts.app', ['fixed' => $slides->isNotEmpty() ])

@section('content')
    @include('commons.slide')
    <main class="py-3 py-md-5">
        <div class="container">
            {{--            @include('partials.notice')--}}
            {{--            @include('partials.pushes')--}}
            <section class="row-md list-grouped list-tb-padding" id="articles">
                @include('components.articles.small')
            </section>
            <ajax-loader class="posts-ajax-load pagination-ajax justify-content-md-center row-sm mt-4 mt-md-5 mb-2 mb-md-0">

            </ajax-loader>
        </div>
    </main>
    {{--    @include('components.recommended.articles')--}}
@endsection
