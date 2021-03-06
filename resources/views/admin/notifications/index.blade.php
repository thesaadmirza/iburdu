@extends('admin.layout')

@section('page-header')
Notifications Lists
@stop

@section('content')
    <div class="col-lg-12">
    @include('flash::message')
    @if(count($notifications))
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Body</th>
                    <th>Type</th>
                    <th>Created</th>
                    <th>UPdated</th>
                    <th>Operations</th>
                </tr>
            </thead>
            <tbody>
                @foreach($notifications as $notification)
                    <tr id="notification-{{$notification->id}}">
                        <td>{{ $notification->id }}</td>
                        <td>@if($notification->to_all) All @else {{$notification->user->name }} @endif</td>
                        <td>{!! $notification->body !!}</td>
                        <td>{{ $notification->type }}</td>
                        <td>{{ $notification->created_at->diffForHumans() }}</td>
                        <td>{{ $notification->updated_at->diffForHumans() }}</td>
                        <td>
                            <div class="btn-group btn-group-xs" role="group">
                                <a href="/notification/{{$notification->id}}/edit" target="_blank" class="btn btn-primary" title="Edit"><i class="fa fa-edit"></i></a>
                                <button type="button" target="_blank" class="btn btn-danger" data-toggle="modal" data-target="#delNotificationAdmin" data-body="{{ $notification->body }}" data-id="{{ $notification->id }}"><i class="fa fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pull-right" id="page">
            {!! $notifications->render() !!}
        </div>
        <div class="modal fade" id="delNotificationAdmin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" value="">
                        <p class="text-danger text-center">Body<span class="body"></span>”？</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" onclick="delNotification()" data-dismiss="modal">Yes</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-danger text-center">
            No NOtification yet
        </div>
    @endif
    </div>
@stop