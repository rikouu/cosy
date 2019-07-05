<div class="post-action pt-5">
    <div class="post-like text-center">
        <a href="javascript:;" v-like="{{ $article->id }}" class="btn btn-lg btn-primary post-like{{ $isLiked ? ' current' : '' }}">
            <i class="iconfont icon-like3"></i> {{ __('Like') }}
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
                <i class="text-lg iconfont icon-icon-test7"></i> 海报
            </a>
        </div>
        @include('articles.partials._share', compact('article'))
    </div>
</div>

@include('components.popup.author', ['author' => $article->user])
