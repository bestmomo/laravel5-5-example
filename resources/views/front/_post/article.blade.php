<article class="format-standard">

    <div class="content-media">
        <div class="post-thumb">
            <img src="{{ $post->image }}">
        </div>
    </div>

    <div class="primary-content">

        <h1 class="page-title">{{ $post->title }}</h1>

        <ul class="entry-meta">
            <li class="date">{{ $post->created_at->formatLocalized('%A %d %B %Y') }}</li>
            <li class="cat">
                @foreach ($post->categories as $category)
                    <a href="{{ route('category', [$category->slug]) }}">{{ $category->title }}</a>
                @endforeach
            </li>
        </ul>

    {!! $post->body !!}

    <!-- Tags -->
        @if ($post->tags->count())
            <p class="tags">
                <span>@lang('Tagged in') :</span>
                @foreach($post->tags as $tag)
                    <a href="{{ route('posts.tag', [$tag->id]) }}">{{ $tag->tag }}</a>
                @endforeach
            </p>
        @endif

        <div class="author-profile">
            <img src="{{ Gravatar::get($post->user->email) }}" alt="">
            <div class="about">
                <h4>{{ $post->user->name }}</h4>
            </div>
        </div> <!-- end author-profile -->

    </div> <!-- end entry-primary -->

    <div class="pagenav group">
        @if ($post->previous)
            <div class="prev-nav">
                <a href="{{ url('posts/' . $post->previous->slug) }}" rel="prev">
                    <span>@lang('Previous')</span>
                    {{ $post->previous->title }}
                </a>
            </div>
        @endif
        @if ($post->next)
            <div class="next-nav">
                <a href="{{ url('posts/' . $post->next->slug) }}" rel="next">
                    <span>@lang('Next')</span>
                    {{ $post->next->title }}
                </a>
            </div>
        @endif
    </div>

</article>