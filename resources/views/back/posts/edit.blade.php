@extends('back.posts.template')

@section('form-open')
    <form method="post" action="{{ route('posts.update', [$post->id]) }}">
        {{ method_field('PUT') }}
@endsection
