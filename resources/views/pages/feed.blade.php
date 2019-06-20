<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
    <channel>
        <title>{{ Cosy::name() }}</title>
        <description>{{ $description ?? '' }}</description>
        <link>{{ url('/') }}</link>
        <atom:link href="{{ route('feed') }}" rel="self" type="application/rss+xml"/>
        @php
        $date = !empty($articles) ? $articles[0]->published_at->format('D, d M Y H:i:s O') : date("D, d M Y H:i:s O", time())
        @endphp
        <pubDate>{{ $date }}</pubDate>
        <lastBuildDate>{{ $date }}</lastBuildDate>
        <generator>{{ Cosy::name() }}</generator>
        @foreach ($articles as $article)
            <item>
                <title>{{ $article->title }}</title>
                <link>{{ $article->getLink() }}</link>
                <description>{{ $article->description }}</description>
                <pubDate>{{ $article->published_at }}</pubDate>
                <author>{{ $article->user->email }} ({{$article->user->display_name}})</author>
                <guid>{{ $article->slug }}</guid>
                <category>{{ $article->category->name ?? '' }}</category>
            </item>
        @endforeach
    </channel>
</rss>
