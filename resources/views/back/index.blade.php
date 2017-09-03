@extends('back.layout')

@section('main')
    @admin
        <div class="row">
            @each('back/partials/pannel', $pannels, 'pannel')
        </div>
    @endadmin
@endsection
