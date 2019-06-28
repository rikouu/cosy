@php
    $articles = Blog::convergence($article);
@endphp
<aside v-sticky id="sidebar" class="widget-area pt-5 pt-lg-0">
    <section id="search-2" class="widget widget_search">
        <form role="search" method="get" class="searchform" action="{{ route('search') }}">
            <div class="search-input form-group m-0">
                <label class="screen-reader-text" for="s">Search for:</label>
                <input type="text" placeholder="{{ __('cosy.search.placeholder') }}" class="form-control" name="q" required>
                <button class="btn" type="submit"><i class="iconfont icon-sousuo"></i></button>
            </div>
        </form>
    </section>
    <section id="recommended_posts-5" class="widget Recommended_Posts">
        <div class="widget-title">聚合文章</div>
        <div class="list-grid list-grid-padding p-0 my-n2">
            @foreach($articles as $convergenceArticle)
            <div class="list-item">
                <div class="media media-4x3 col-4">
                    <a href="{{ $convergenceArticle->getLink() }}" target="_blank" class="media-content"
                       style="background-image:url('{{ $convergenceArticle->image }}')"></a>
                    @if ('image' === $convergenceArticle->type)
                        <div class="media-action"><i class="iconfont icon-image"></i></div>
                    @elseif ('video' === $convergenceArticle->type)
                        <div class="media-action"><i class="iconfont icon-video"></i></div>
                    @elseif ('audio' === $convergenceArticle->type)
                        <div class="media-action"><i class="iconfont icon-music"></i></div>
                    @endif
                </div>
                <div class="list-content pl-3">
                    <div class="list-body">
                        <a href="{{ $convergenceArticle->getLink() }}" target="_blank" class="list-title text-sm h-2x">
                            {{ $convergenceArticle->title }}
                        </a>
                    </div>
                    <div class="list-footer text-muted text-xs m-0">
                        <div>{{ $convergenceArticle->published_at }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
</aside>
