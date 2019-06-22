@foreach($comments as $comment)
    <li class="comment">
        <article class="d-flex flex-fill comment-body mt-4">
            <div class="d-flex flex-shrink-0 mr-3 comment-avatar-author vcard">
                <img alt="" src="{{ getAvatar($comment->email) }}" class="avatar avatar-50 photo"
                     height="50" width="50">
            </div>
            <div class="flex-fill flex-column comment-text">
                <div class="d-flex align-items-center comment-info mb-2">
                    <div class="comment-author text-sm">
                        <a target="_blank" href="https://www.iqiyi.com/v_19rqt3qx4c.html"
                           rel="external nofollow" class="url">{{ $comment->name }}</a></div>
                </div>
                <div class="comment-content d-inline-block text-sm bg-light">
                    {{ $comment->content }}
                </div>
                <div class="text-xs text-muted pt-2">
                    <time class="comment-date">2019-03-26</time>
                    <a class="comment-reply-link"
                       onclick="return addComment.moveForm( 'comment-4','4', 'respond','188' ) "
                       href="?replytocom=4#respond" rel="nofollow"><i class="fal fa-repeat"></i> 回复</a>
                </div>
            </div>
        </article>
        @php
            $children = $comment->comments;
        @endphp
        @if ($children->isNotEmpty())
            <ul class="children">
                @include('components.comments.items', ['comments' => $children, 'level' => $level + 1])
            </ul>
        @endif
    </li>
@endforeach
