@php
    $style = $style ?? 'small';
    if ($style === 'plain') {
        $cardClass = 'col-6 col-md-4';
        $rowClass = 'row';
    } else if ($style === 'medium') {
        $cardClass = 'col-6 col-md-4';
        $rowClass = 'row-lg';
    } else if ($style === 'small') {
        $cardClass = 'col-6 col-md-3';
        $rowClass = 'row-md';
    }
    $topArticles = $topArticles->take(in_array($style, ['plain', 'medium']) ? 3 : 4);
@endphp
@if(!empty($topPosts))
    <div class="bg-light py-4 py-md-5">
        <div class="container">
            <div class="row {{ $style === 'plain' ? 'justify-content-md-center' : '' }}">
                <div class="{{ $style === 'plain' ? 'col-lg-9' : 'col-12' }}">
                    <div class="list-header h4 mb-3 mb-md-4">{{ __('Top Posts') }}</div>
                    <div class="list-grouped list-scroll-x">
                        <div class="{{ $rowClass }}">
                            @foreach($topArticles as $topArticle)
                                <div class="{{ $cardClass }}">
                                    <div class="list-item list-item-overlay custom-hover">
                                        <div class="media media-3x2">
                                            <a href="{{ $topArticle->getLink() }}" class="media-content custom-hover-img"
                                               style="background-image:url('{{ $topArticle->image }}')">
                                                <span class="overlay"></span>
                                            </a>
                                        </div>
                                        <div class="list-content ">
                                            <div class="list-body">
                                                <a href="{{ $topArticle->getLink() }}"
                                                   class="list-title h-2x">{{ $topArticle->title }}</a>
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
    </div>
@endif
