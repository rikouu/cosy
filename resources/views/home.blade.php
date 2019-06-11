@extends('layouts.app')

@section('content')
    @include('partials.header', ['fixed' => $slides->isNotEmpty() ])
    @include('partials.slide')
    <main class="py-3 py-md-5">
        <div class="container">
            {{--            @include('partials.notice')--}}
            {{--            @include('partials.pushes')--}}
            <section class="row-md list-grouped list-tb-padding" id="articles">
                @include('components.articles.small')
            </section>
            {{--            @include('partials.navigation')--}}
        </div>
    </main>
    {{--    @include('components.recommended.articles')--}}
@endsection
