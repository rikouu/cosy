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
            {{--            @include('partials.navigation')--}}
        </div>
    </main>
    {{--    @include('components.recommended.articles')--}}
@endsection
