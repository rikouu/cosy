@foreach($articles as $article)
    <div class="list-item custom-hover">
        <div class="media media-3x2 col-5 col-md-4">
            <a class="media-content" href="{{ $article->getLink() }}" >
                <img src="{{ $article->image }}" alt="{{ $article->title }}">
                <span class="overlay"></span>
            </a>
            @include('components.card.media-icon', ['type' => $article->type])
        </div>
        <div class="list-content py-lg-2">
            <div class="list-body">
                <a href="{{ $article->getLink() }}" class="list-title text-lg h-2x">{{ $article->title }}</a>
                <div class="list-subtitle text-sm text-muted d-none d-lg-block mt-lg-3">
                    <span class="h-2x">{{ $article->excerpt }}</span>
                </div>
            </div>
            <div class="list-footer d-flex align-items-center text-muted text-xs m-0">
                <div>{{ $article->getPublishedDate() }}</div>
                <div class="flex-fill"></div>
                <div class="text-nowrap">
                    <span class="d-none d-lg-inline-block pr-2 px-md-3">
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
@endforeach
