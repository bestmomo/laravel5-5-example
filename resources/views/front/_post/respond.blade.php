<!-- respond -->
<div class="respond">
    <h3>@lang('Leave a Comment')</h3>
    @if (Auth::check())
        <form method="post" action="{{ route('posts.comments.store', [$post->id]) }}">
            {{ csrf_field() }}
            <div class="message form-field">
                @if ($errors->has('message'))
                    @component('front.components.error')
                        {{ $errors->first('message') }}
                    @endcomponent
                @endif
                <textarea name="message" id="message" class="full-width" placeholder="@lang('Your message')" value="{{ old('message') }}" required></textarea>
            </div>
            <button type="submit" class="submit button-primary">@lang('Submit')</button>
        </form>
    @else
        <em>@lang('You must be logged to add a comment !')</em>
    @endif

</div>
<!-- Respond End -->