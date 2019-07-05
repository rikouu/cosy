@php
    $showCat = isset($showCat) ? $showCat : true;
@endphp

@foreach($articles as $article)
    <div class="list-item custom-hover">
        <div class="media media-3x2 col-5 col-md-4">
            <a class="media-content" href="{{ $article->getLink() }}" >
                <img src="@image($article->image)" alt="{{ $article->title }}">
                <span class="overlay"></span>
            </a>
            @if ('image' === $article->type)
                <div class="media-action"><i class="iconfont icon-image"></i></div>
            @elseif ('video' === $article->type)
                <div class="media-action"><i class="iconfont icon-video"></i></div>
            @elseif ('audio' === $article->type)
                <div class="media-action"><i class="iconfont icon-music"></i></div>
            @endif
        </div>
        <div class="list-content py-lg-2">
            <div class="list-body">
                @if ($showCat)
                    <div class="d-none d-lg-block text-xs mb-1 list-cat-style list-cat-dot-circle">
                        <i class="cat-dot" style="{{ 'border-color: #5d86dc;' }}"></i>
                        <a href="{{ $article->category->getLink() }}"
                           class="text-muted">{{ $article->category->name }}</a>
                    </div>
                @endif
                <a href="{{ $article->getLink() }}" class="list-title text-lg h-2x">{{ $article->title }}</a>
                <div class="list-subtitle text-sm text-muted d-none d-lg-block mt-lg-3">
                    <span class="h-2x">{{ $article->excerpt }}</span>
                </div>
            </div>
            <div class="list-footer d-flex align-items-center text-muted text-xs m-0">
                <div>{{ $article->getPublishedDate() }}</div>
                <div class="flex-fill"></div>
                <div class="text-nowrap">
                    <span class="d-none d-lg-inline-block pr-2 px-md-2">
                        <i class="iconfont icon-comment"></i>
                        {{ $article->comments_count }}
                    </span>
                    <span class="d-none d-lg-inline-block">
                        <i class="iconfont icon-like"></i>
                        {{ $article->likes_count }}
                    </span>
                </div>
            </div>
        </div>
    </div>
@endforeach
