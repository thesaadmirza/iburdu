@extends('layouts.articles')

@section('title')
Article list - @parent
@stop

@section('site-heading')
    <div class="site-heading">
        <h1>label [{{ $tag->name }}] All articles under</h1>
    </div>
@stop

@section('container')

    @include('articles._preview')

@stop