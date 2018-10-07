@extends('admin.layout')

@section('page-header')
Users Lists
<span class="pull-right page-opt">
    <form action="" method="get" class="pull-right">
        <div class="form-inline">
            <input type="text" name="s" id="s" class="form-control" placeholder="User ID / Nickname / Mailbox / Introduction" value="{{ $s }}">
            <button class="btn btn-danger" type="submit"><i class="fa fa-search"></i></button>
        </div>
    </form>
</span>
@stop

@section('content')
    <div class="col-lg-12">
    @if(count($users))
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                  
                    
                    <th>website</th>
                  
                    <th>user group</th>
                    <th>Creation date</th>
                    <th>Operations</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr id="user-{{ $user->id }}" data-id="{{ $user->id }}">
                        <td>{{ $user->id }}</td>
                        <td class="name"><a href="/user/{{$user->id}}" target="_blank">{{ $user->name }}</a></td>
                        <td>{{ $user->email }}</td>
                       
                      
                        <td>{{ $user->website }}</td>
                
                        <td class="role">
                            @if($user->id == 1)
                                {{ $user->roles[0]->name }}
                            @else
                                <form>
                                    <select class="userRole" data-id="@if(isset($user->roles[0])) $user->roles[0]->id @endif" name="userRole" class="form-control">
                                        @foreach($roles as $role)
                                            <option id="role-{{ $role->id }}" value="{{ $role->id }}" @if(isset($user->roles[0]) && $user->roles[0]->id == $role->id) selected @endif>{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    <input type="reset" class="hidden">
                                    <i class="fa fa-spin fa-refresh hidden"></i>
                                </form>
                            @endif
                        </td>
                        <td>{{ $user->created_at }}</td>
                        <td>
                            <div class="btn-group btn-group-xs" role="group">
                                <a href="/user/{{$user->id}}" target="_blank" class="btn btn-info" title="View"><i class="fa fa-eye"></i></a>
                                <a href="/user/{{$user->id}}/edit" target="_blank" class="btn btn-primary" title="Edit"><i class="fa fa-edit"></i></a>
                                @if($user->id != 1)
                                    <button type="button" target="_blank" class="btn btn-danger" data-toggle="modal" data-target="#delUserAdmin" data-title="{{ $user->title }}" data-id="{{ $user->id }}" data-name="{{ $user->name }}"><i class="fa fa-trash"></i></button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pull-right" id="page">
            {!! $users->render() !!}
        </div>
        <div class="modal fade" id="updateRole" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Permission modification</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="user_id" value="">
                        <input type="hidden" name="role_id" value="">
                        <p class="text-danger text-center">Ok to put the user "<strong class="name"></strong>"The role is modified to【<span class="role"></span>】？</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" onclick="updateRole()" data-dismiss="modal">Yes</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="delUserAdmin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">delete users</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" value="">
                        <p class="text-danger text-center">Ok to delete the user"<strong class="deleteUser"></strong>”？</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" onclick="delUser()" data-dismiss="modal">Yes</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-danger text-center">
        No users
        </div>
    @endif
    </div>
@stop