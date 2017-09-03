@extends('back.layout')

@section('css')
    <style>
        .box-body hr+p {
            font-size: x-large;
        }
    </style>
@endsection


@section('main')

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <hr>
                    <p>ID</p>
                    {{ $post->id }}
                    <hr>
                    <p>@lang('Title')</p>
                    {{ $post->title }}
                    <hr>
                    <p>@lang('Author')</p>
                    {{ $post->user->name }}
                    <hr>
                    <p>@lang('Excerpt')</p>
                    {{ $post->excerpt }}
                    <hr>
                    <p>@lang('Body')</p>
                    {!! $post->body !!}
                    <hr>
                    <p>@lang('Image')</p>
                    <img src="{{ $post->image }}" alt="" width="200px">
                    <hr>
                    <p>@lang('Categories')</p>
                    @foreach($post->categories as $category)
                        {{ $category->title }}<br>
                    @endforeach
                    <hr>
                    <p>@lang('Slug')</p>
                    {{ $post->slug }}
                    <hr>
                    @if($post->tags->count())
                        <p>@lang('Tags')</p>
                        @foreach($post->tags as $tag)
                            <span class="badge">{{ $tag->tag }}</span>
                        @endforeach
                    @endif
                    <hr>
                    <p>@lang('SEO Title')</p>
                    {{ $post->seo_title }}
                    <hr>
                    <p>@lang('META Description')</p>
                    {{ $post->meta_description }}
                    <hr>
                    <p>@lang('META Keywords')</p>
                    {{ $post->meta_keywords }}
                    <hr>
                    <p>@lang('Status')</p>
                    {{ $post->active ? __('Active') : __('No Active')}}
                    <hr>
                    <p>@lang('Date Creation')</p>
                    {{ $post->created_at->formatLocalized('%c') }}
                    <hr>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

@endsection