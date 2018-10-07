@extends('layouts.users')

@section('title')change Password - @parent @stop

@section('container')
    @include('users._rightnav')
    {{-- <div class="panel panel-default"> --}}
        <div class="panel-body ">
            @include('flash::message')
            @include('errors.errlist')
            @if(isset($notmatch) && $notmatch)
                <div class="alert alert-danger">
                    <ul>
                        <li>{{ $notmatch }}</li>
                    </ul>
                </div>
            @endif
            <div class="alert alert-warning text-center">Password is at least 6 digits in length</a></div>

            {!! Form::open(['method' => 'PATCH', 'action' => ['UserController@updatepwd', $user->id], 'id' => 'resetPwdForm']) !!}

                <div class="form-group">
                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'original password', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::password('password_new', ['class' => 'form-control', 'placeholder' => 'new password', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::password('password_new_confirmation', ['class' => 'form-control', 'placeholder' => 'confirm password', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('save', ['id' => 'resetPwdBtn', 'class' => 'btn btn-primary form-control']) !!}
                </div>
            {!! Form::close() !!}
        </div>
    {{-- </div> --}}
@stop