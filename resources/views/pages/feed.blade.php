<?php
print <<<EOT
<?xml version = "1.0" encoding = "UTF-8"?>
<rss version="2.0"
     xmlns:content="http://purl.org/rss/1.0/modules/content/"
     xmlns:wfw="http://wellformedweb.org/CommentAPI/"
     xmlns:dc="http://purl.org/dc/elements/1.1/"
     xmlns:atom="http://www.w3.org/2005/Atom"
     xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
     xmlns:slash="http://purl.org/rss/1.0/modules/slash/"
>
EOT;
$date = !empty($articles) ? $articles[0]->published_at->format('D, d M Y H:i:s O') : date("D, d M Y H:i:s O", time())
?>
<channel>
    <title>{{ Cosy::name() }}</title>
    <atom:link href="{{ route('feed') }}" rel="self" type="application/rss+xml"/>
    <link>{{ url('/') }}</link>
    <description>{{ config('cosy.description', '') }}</description>
    <pubDate>{{ $date }}</pubDate>
    <lastBuildDate>{{ $date }}</lastBuildDate>
    <language>{{ str_replace('_', '-', app()->getLocale()) }}</language>
    <sy:updatePeriod>hourly</sy:updatePeriod>
    <sy:updateFrequency>1</sy:updateFrequency>
    @foreach ($articles as $article)
        <item>
            <title>{{ $article->title }}</title>
            <link>{{ $article->getLink() }}</link>
            <description>{{ $article->description }}</description>
            <pubDate>{{ $article->published_at }}</pubDate>
            <author>{{ $article->user->email }} ({{$article->user->display_name}})</author>
            <dc:creator><![CDATA[{{ $article->user->display_name }}]]></dc:creator>
            <guid>{{ $article->slug }}</guid>
            <guid isPermaLink="false">{{ $article->getLink() }}</guid>
            <category>{{ $article->category->name ?? '' }}</category>
            <content:encoded><![CDATA[{{ $article->excerpt }}]]></content:encoded>
            <slash:comments>{{ $article->comments_count }}</slash:comments>
        </item>
    @endforeach
</channel>
<?php
print  <<<EOT
</rss>
EOT;
?>