@extends('admin.layout')

@section('page-header')
Tags Lists
<span class="pull-right page-opt">
    <form action="" method="get" class="pull-right">
        <div class="form-inline">
            <select name="orderby" class="form-control">
                <option value="created_at" @if($orderby == 'created_at') selected @endif>Creation time</option>
                <option value="count" @if($orderby == 'count') selected @endif>Number of articles</option>
            </select>
            <input type="text" name="name" id="name" class="form-control" placeholder="标签" value="{{ $name }}">
            <button class="btn btn-danger" type="submit"><i class="fa fa-search"></i></button>
        </div>
    </form>

    <div class="btn-group mr10" role="group">
        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#delAllTags">Delete Tags</button>
    </div>
</span>
@stop

@section('content')
    <div class="col-lg-12">
    @if(count($tags))
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th><span class="fa fa-check-square-o pointer" onclick="checkAll('delTagId')"></span> / <span class="fa fa-square-o  pointer" onclick="unCheckAll('delTagId')"></span></th>
                    <th>ID</th>
                    <th>name</th>
                    <th>Slug</th>
                    <th>Initials</th>
                    <th>Number of articles</th>
                    <th>Creation date</th>
                    <th>Operation</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tags as $tag)
                    <tr id="tag-{{$tag->id}}">
                        <td><input type="checkbox" name="delTagId[]" value="{{ $tag->id }}"></td>
                        <td>{{ $tag->id }}</td>
                        <td><a href="/tag/{{$tag->slug}}" target="_blank" title="View">{!! $tag->name !!}</a></td>
                        <td><a href="/tag/{{$tag->slug}}" target="_blank" title="slug">{!! $tag->slug !!}</a></td>
                        <td>{{ $tag->letter }}</td>
                        <td>{{ $tag->count }}</td>
                        <td>{{ $tag->created_at }}</td>
                        <td>
                            <div class="btn-group btn-group-xs" role="group">
                                <a href="/tag/{{$tag->slug}}" target="_blank" class="btn btn-info" title="view"><i class="fa fa-eye"></i></a>
                                <button type="button" target="_blank" class="btn btn-danger" data-toggle="modal" data-target="#delTagAdmin" data-name="{{ $tag->name }}" data-id="{{ $tag->id }}"><i class="fa fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pull-right" id="page">
            {!! $tags->render() !!}
        </div>
        <div class="modal fade" id="delTagAdmin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Delete tag</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" value="">
                        <p class="text-danger text-center">Make sure you want to delete the label《<span class="name"></span>》？</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" onclick="delTag()" data-dismiss="modal">Yes</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="delAllTags" tabindex="-1" role="dialog" aria-labelledby="delAllTagsLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="delAllTagsLabel">Delete tag</h4>
                    </div>
                    <div class="modal-body">
                        <p class="text-danger text-center delMsg">Confirm that you want to delete the selected label?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" onclick="delCheckedTags()" data-dismiss="modal">Yes</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-danger text-center">
        No label
        </div>
    @endif
    </div>
@stop
