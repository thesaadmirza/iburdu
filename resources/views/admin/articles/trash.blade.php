@extends('admin.layout')

@section('page-header')
Recycle bin
<span class="pull-right page-opt">
    <div class="btn-group" role="group">
        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#delAllArticles" data-all="0" data-msg="Are you sure you want to delete the selected article?">Delete selected</button>
        <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#delAllArticles" data-all="1" data-msg="Are you sure you want to empty all the articles in the trash?">Empty recycle bin</button>
    </div>
</span>
@stop

@section('content')
    <div class="col-lg-12" id="trashArticles">
    @if(count($articles))
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th><span class="fa fa-check-square-o pointer" onclick="checkAll('delArticleId')"></span> / <span class="fa fa-square-o  pointer" onclick="unCheckAll('delArticleId')"></span></th>
                    <th>title</th>
                    <th>Release date</th>
                    <th>Release date</th>
                    <th>Delete date</th>
                    <th>Pageviews</th>
                    <th>Like</th>
                    <th>Number of comments</th>
                    <th>Number of favorites</th>
                    <th>Operations</th>
                </tr>
            </thead>
            <tbody>
                @foreach($articles as $article)
                    <tr id="article-{{$article->id}}" class="article">
                        <td><input type="checkbox" name="delArticleId[]" value="{{ $article->id }}"></td>
                        <td><a href="/articles/view/{{$article->id}}" target="_blank">{{ $article->title }}</a></td>
                        <td><a href="/user/{{$article->user->id}}" target="_blank">{{ $article->user->name }}</a></td>
                        <td>{{ $article->created_at }}</td>
                        <td>{{ $article->deleted_at }}</td>
                        <td>{{ $article->view_count }}</td>
                        <td>{{ $article->like_count }}</td>
                        <td>{{ $article->comment_count }}</td>
                        <td>{{ $article->collect_count }}</td>
                        <td>
                            <div class="btn-group btn-group-xs" role="group" aria-label="...">
                                <a href="/articles/view/{{$article->id}}" target="_blank" class="btn btn-info" title="View"><i class="fa fa-eye"></i></a>
                                <button type="button" class="btn btn-primary" title="Restore" data-toggle="modal" data-target="#restoreArticle" data-title="{{ $article->title }}" data-id="{{ $article->id }}"><i class="fa fa-recycle"></i></button>
                                <button type="button" class="btn btn-danger" title="Delete" data-toggle="modal" data-target="#delArticleAdmin" data-title="{{ $article->title }}" data-id="{{ $article->id }}"><i class="fa fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pull-right" id="page">
            {!! $articles->render() !!}
        </div>
        <div class="modal fade" id="delArticleAdmin" tabindex="-1" role="dialog" aria-labelledby="delArticleLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="delArticleLabel">Delete article</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" value="">
                        <p class="text-danger text-center">Confirm to be completely removed《<span class="deleteTitle"></span>》？</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" onclick="delArticle()" data-dismiss="modal">Yes</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="delAllArticles" tabindex="-1" role="dialog" aria-labelledby="delAllArticleLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="delAllArticleLabel">Delete article</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="all" value="0">
                        <p class="text-danger text-center delMsg">Confirm that you want to delete it completely?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" onclick="delCheckedArticles()" data-dismiss="modal">Yes</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="restoreArticle" tabindex="-1" role="dialog" aria-labelledby="restoreArticleLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="restoreArticleLabel">Restore article</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" value="">
                        <p class="text-danger text-center">Confirm that you want to restore the article《<span class="deleteTitle"></span>》？</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" onclick="restoreArticle()" data-dismiss="modal">Yes</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-danger text-center">
        No article yet
        </div>
    @endif
    </div>
@stop