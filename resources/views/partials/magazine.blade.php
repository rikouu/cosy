@php
    $index_menu_style = "immersed";
    $magazineClass = '';
    if ($index_menu_style === 'immersed' || $index_menu_style === 'dark' || $index_menu_style === 'image') {
        $magazineClass .= ' list-fixed';
    }

    if ($index_menu_style === 'plain') {
        $magazineClass .= ' bg-light ';
    }

    if ($index_menu_style === 'dark') {
        $magazineClass .= ' bg-dark';
    }
@endphp

@if ($slides->isNotEmpty())
    <section class="list-magazine {{ $magazineClass}}">
        @if ($index_menu_style === 'immersed')
            <div class="bg-effect bg-dark bg-image-color" style="background: linear-gradient(rgb(178, 145, 90) 0%, rgb(28, 90, 119) 100%, rgb(100, 46, 46) 100%);"></div>
            <div class="bg-effect bg-cover bg-magazine" style="background-image: url('{{ asset('/images/bg.jpg') }}');"></div>
        @elseif($index_menu_style === 'image')
            <div class="bg-effect bg-cover" style="background-image:url('{{ asset('/images/bg.jpg') }}')"></div>
        @endif
        <div class="container">
            <div class="row-sm">
                <div class="col-12 col-md-6 d-flex">
                    <div class="list-item list-prism-overlay custom-hover flex-fill">
                        @php
                            $firstArticle = $slides->first();
                        @endphp
                        <div class="media d-flex flex-fill">
                            <a href="{{ $firstArticle->getLink() }}" class="media-content"
                               style="background-image: url('{{ $firstArticle->image ?? asset('/images/bg.jpg') }}')">
                                <span class="overlay"></span>
                            </a>
                        </div>
                        <div class="list-content">
                            <div class="list-body">
                                <a href="{{ $firstArticle->getLink() }}" class="list-title text-lg h-2x"
                                   target="_blank">
                                    {{ $firstArticle->title }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 mt-2 mt-md-0">
                    <div class="list-scroll-2x">
                        <div class="row-sm row-scroll my-n1 my-md-n2">
                            @foreach($slides->slice(1,4)->all() as $article)
                                <div class="col-6 py-1 py-md-2">
                                    <div class="list-item list-prism-overlay custom-hover">
                                        <div class="media">
                                            <a href="{{ $article->getLink() }}" class="media-content"
                                               style="background-image: url('{{ $article->image ?? asset('/images/bg.jpg') }}')">
                                                <span class="overlay"></span>
                                            </a>
                                        </div>
                                        <div class="list-content">
                                            <div class="list-body">
                                                <div class="mt-auto">
                                                    <a href="{{ $article->getLink() }}"
                                                       class="list-title text-md h-2x ">
                                                        {{ $article->title }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
