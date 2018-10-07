@extends('admin.layout')

@section('page-header')
Comments Lists
<span class="pull-right page-opt">
    <form action="" method="get" class="pull-right">
        <div class="form-inline">
            <input type="text" name="body" id="body" class="form-control" placeholder="body" value="{{ $body }}">
            <button class="btn btn-danger" type="submit"><i class="fa fa-search"></i></button>
        </div>
    </form>

    <div class="btn-group mr10" role="group">
        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#delAllComments">Delete COmments</button>
    </div>
</span>
@stop

@section('content')
    <div class="col-lg-12">
    @if(count($comments))
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th><span class="fa fa-check-square-o pointer" onclick="checkAll('delCommentId')"></span> / <span class="fa fa-square-o  pointer" onclick="unCheckAll('delCommentId')"></span></th>
                    <th>ID</th>
                    <th>content</th>
                    <th>Article</th>
                    <th>username</th>
                    <th>Created At</th>
                    <th>Operations</th>
                </tr>
            </thead>
            <tbody>
                @foreach($comments as $comment)
                    <tr id="comment-{{$comment->id}}">
                        <td><input type="checkbox" name="delCommentId[]" value="{{ $comment->id }}"></td>
                        <td>{{ $comment->id }}</td>
                        <td class="comment-body text-left">{!! $comment->body !!}</td>
                        <td>@if($comment->article)<a href="/article/{{$comment->article_id}}" target="_blank">{{ $comment->article->title }}</a> @else <a href="/articles/view/{{$comment->article_id}}" target="_blank">Article has been deleted</a> @endif</td>
                        <td><a href="/user/{{$comment->user->id}}" target="_blank">{{ $comment->user->name }}</a></td>
                        <td>{{ $comment->created_at }}</td>
                        <td>
                            <div class="btn-group btn-group-xs" role="group">
                                <a href="/article/{{$comment->article_id}}#comment-{{ $comment->id }}" target="_blank" class="btn btn-info" title="View"><i class="fa fa-eye"></i></a>
                                <a href="/comment/{{$comment->id}}/edit" target="_blank" class="btn btn-primary" title="Edit"><i class="fa fa-edit"></i></a>
                                <button type="button" target="_blank" class="btn btn-danger" data-toggle="modal" data-target="#delCommentAdmin" data-id="{{ $comment->id }}"><i class="fa fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pull-right" id="page">
            {!! $comments->render() !!}
        </div>
        <div class="modal fade" id="delCommentAdmin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Delete comment</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" value="">
                        <p class="text-danger text-center">Are you sure you want to delete this comment?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" onclick="delComment()" data-dismiss="modal">Yes</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="delAllComments" tabindex="-1" role="dialog" aria-labelledby="ddelAllCommentsLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="ddelAllCommentsLabel">Delete tag</h4>
                    </div>
                    <div class="modal-body">
                        <p class="text-danger text-center delMsg">Confirm that the selected tag is deleted?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" onclick="delCheckedComments()" data-dismiss="modal">Yes</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-danger text-center">
            NO Comments Yet
        </div>
    @endif
    </div>
@stop

@section('footer')
@stop