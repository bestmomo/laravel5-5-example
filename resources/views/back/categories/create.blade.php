@extends('back.categories.template')

@section('form-open')
    <form method="post" action="{{ route('categories.store') }}">
@endsection