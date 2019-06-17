@php
    $showCat = isset($showCat) ? $showCat : true;
@endphp

@foreach($articles as $article)
    <div class="col-6 col-md-3 d-flex">
        <div class="list-item block custom-hover">
            <div class="media media-3x2">
                <a class="media-content" href="{{ $article->getLink() }}" >
                    <img src="{{ $article->image }}" alt="{{ $article->title }}">
                    <span class="overlay"></span>
                </a>
                @if ('image' === $article->type)
                    <div class="media-action"><i class="far fa-image"></i></div>
                @elseif ('video' === $article->type)
                    <div class="media-action"><i class="far fa-video"></i></div>
                @elseif ('audio' === $article->type)
                    <div class="media-action"><i class="far fa-music"></i></div>
                @endif
            </div>
            <div class="list-content">
                <div class="list-body">
                    @if ($showCat)
                        <div class="d-none d-lg-block text-xs mb-1 list-cat-style list-cat-dot-circle">
                            <i class="cat-dot" style="{{ 'border-color: #5d86dc;' }}"></i>
                            <a href="{{ $article->category->getLink() }}"
                               class="text-muted">{{ $article->category->name }}</a>
                        </div>
                    @endif
                    <a href="{{ $article->getLink() }}" class="list-title text-md h-2x">{{ $article->title }}</a>
                </div>
                <div class="list-footer d-flex align-items-center text-muted text-xs mt-2">
                    <div>{{ $article->getPublishedDate() }}</div>
                    <div class="flex-fill"></div>
                    <div class="text-nowrap">
                        <span class="d-none d-lg-inline-block pr-2">
                            <i class="text-sm fal fa-comment"></i>
                            {{ $article->comments_count }}
                        </span>
                        <span class="d-none d-lg-inline-block">
                            <i class="fal fa-heart"></i>
                            {{ $article->likes_count }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
