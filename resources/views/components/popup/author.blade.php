<modal :show.sync="showAuthorModal" size="no-padding">
    <div class="author-popup-cover">
        <div class="media media-16x9 bg-dark-gradient">
            <div class="bg-effect bg-dark-gradient bg-author"></div>
            <div class="bg-effect bg-cover" style="background-image: url({{ $author->avatar }})"></div>
        </div>
        <div class="author-popup-meta mt-n5">
            <div class="px-4">
                <div class="d-flex align-items-center justify-content-center">
                    <a href="{{ $author->getLink() }}" class="avatar mx-2 w-96" target="_blank">
                        <img alt="{{ $author->display_name }}" src="{{ $author->avatar }}" class="avatar w-96" height="96" width="96"/>
                    </a>
                </div>
                <div class="text-center mt-3">
                    <a href="{{ $author->getLink() }}" class="h5"
                       target="_blank">{{ $author->display_name }}</a>
                    <div class="d-block text-sm text-muted mt-2">
                        <span class="h-2x">{{ $author->description }}</span>
                    </div>
                </div>
            </div>
            <div class="row no-gutters text-center">
                <a href="{{ $author->getLink() }}" class="col py-3"
                   target="_blank">
                    <span class="font-theme text-lg d-block">{{ $author->articles_count ?? 0 }}</span>
                    <small class="text-xs text-muted">{{ __('Articles') }}</small>
                </a>
                <div class="col py-3">
                    <span class="font-theme text-lg d-block">{{ $author->comments_count ?? 0 }}</span>
                    <small class="text-xs text-muted">{{ __('Comments') }}</small>
                </div>
                <div class="col py-3">
                    <span class="font-theme text-lg d-block">{{ $author->likes_count ?? 0  }}</span>
                    <small class="text-xs text-muted">{{ __('Likes') }}</small>
                </div>
            </div>
        </div>
    </div>
</modal>
