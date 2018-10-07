@extends('layouts.users')

@section('title'){{$user->name}}Collection of all articles - @parent @stop

@section('container')
    @include('users._rightnav')
    <div class="panel-body remove-pd-h">
        @if(count($articles))
            @if($currentUser && $currentUser->id == $user->id)
                <div class="alert alert-info text-center clearfix">
                You can click on the bookmark symbol in the list (<i class="fa fa-bookmark"></i> )can cancel the collection
                </div>
            @endif
            <ul class="list-group">
                @foreach($articles as $article)
                    <li class="list-group-item clearfix article todel" data-id="{{ $article->id }}">
                        <a href="/article/{{ $article->id }}">{{ $article->title }}</a>
                        <span class="user-articles-meta">
                            <span class="pull-right">
                                <i class="fa fa-calendar"></i> {{ $article->created_at->diffForHumans() }}
                                @if($currentUser && $currentUser->id == $user->id)
                                    <label class="js-action js-delete" data-action="Collect"><i class="fa fa-bookmark"></i> <span>{{ $article->collect_count }}</span></label>
                                @endif
                            </span>
                        </span>
                    </li>
                @endforeach
                {!! $articles->render() !!}
            </ul>
        @else
            <div class="alert alert-warning text-center">
            No collection yet
            </div>
        @endif
    </div>
@stop

@section('footer')
    <script type="text/javascript">

    </script>
@stop