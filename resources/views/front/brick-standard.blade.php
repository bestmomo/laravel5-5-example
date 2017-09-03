<article class="brick entry format-standard animate-this">

    <div class="entry-thumb">
        <a href="{{ url('posts/' . $post->slug) }}" class="thumb-link"><img src="{{ $post->image }}"></a>
    </div>

    <div class="entry-text">
        <div class="entry-header">
            <h1 class="entry-title"><a href="{{ url('posts/' . $post->slug) }}">{{ $post->title }}</a></h1>
        </div>
        <div class="entry-excerpt">
            {{ $post->excerpt }}
        </div>
    </div>

</article>