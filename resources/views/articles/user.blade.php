@extends('layouts.articles')

@section('title')
Article list - @parent
@stop

@section('site-heading')
    <div class="site-heading">
        <h1>by {{ $user->name }} Published article</h1>
    </div>
@stop

@section('container')

    @include('articles._preview')

@stop