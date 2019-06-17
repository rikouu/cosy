<div class="post-action pt-5">
    <div class="post-like text-center">
        <a href="javascript:;" class="btn btn-lg btn-primary post-like{{ $isLiked ? ' current' : '' }}" data-id="{{ $article->id }}">
            <i class="fal fa-heart"></i> {{ __('Like') }}
            <small class="like-count">{{ number_format($article->likes_count) }}</small>
        </a>
    </div>
    <div class="post-share justify-content-between mt-4">
        <div class="post-play">
            <!-- <a href="">
                <i class="text-lg iconfont icon-star-1"></i> 收藏 <small class="text-muted">(123)</small>
            </a>
            <span class="px-3 text-light"> &Iota;</span> -->
            <a class="btn-bigger-cover" id="btn-bigger-cover" href="javascript:">
                <i class="text-lg fal fa-share-square"></i> 海报
            </a>
        </div>
        @include('articles.partials._share', compact('article'))
    </div>
</div>
