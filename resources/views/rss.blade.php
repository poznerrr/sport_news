<?=
'<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL
?>
<rss version="2.0">
    <channel>
        <title>BigSportNews</title>
        <link>
        <![CDATA[ {{\Illuminate\Support\Facades\URL::to("/rss/")}} ]]></link>
        <description><![CDATA[ Лучшие спортивные новости тут ]]></description>
        <language>ru</language>
        <pubdate>{{ now() }}</pubdate>

        @foreach($posts as $post)
            <item>
                <title><![CDATA[ {{ $post->title }}]]></title>
                <link>{{ \Illuminate\Support\Facades\URL::to("/news")}}/{{$post->slug }}</link>
                <description><![CDATA[ {!! strip_tags($post->content)  !!}]]></description>
                <category><![CDATA[ {{ $post->category->name }} ]]></category>
                <author><![CDATA[ {{ $post->user->name }} ]]></author>
                <guid>{{ $post->id }}</guid>
                <pubDate>{{ $post->created_at->toRssString() }}</pubDate>
            </item>
        @endforeach
    </channel>
</rss>

