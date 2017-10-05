@extends('back.categories.template')

@section('form-open')
    <form method="post" action="{{ route('categories.update', [$category->id]) }}">
        {{ method_field('PUT') }}
@endsection
