@extends('layouts.app')

@section('content')
    {{--    @include('partials.header', ['fixed' => $slides->isNotEmpty() ])--}}
    @include('partials.magazine')
    {{--    <main class="py-3 py-md-5">--}}
    {{--        <div class="container">--}}
    {{--            @include('partials.notice')--}}
    {{--            @include('partials.pushes')--}}
    {{--            <section class="row-md list-grouped list-tb-padding" id="articles">--}}
    {{--                @foreach($articles as $article)--}}
    {{--                    @include('components.card.article', compact('article'))--}}
    {{--                @endForeach--}}
    {{--            </section>--}}
    {{--            @include('partials.navigation')--}}
    {{--        </div>--}}
    {{--    </main>--}}
    {{--    @include('components.recommended.articles')--}}
    {{--    @include('partials.footer')--}}
@endsection
