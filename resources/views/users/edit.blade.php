@extends('layouts.users')

@section('title')Edit profile - @parent @stop

@section('container')
    @include('users._rightnav')
    {{-- <div class="panel panel-default"> --}}
        <div class="panel-body ">
            @include('flash::message')
            @include('errors.errlist')
            <div class="alert alert-warning text-center">This site avatar use <a href="http://en.gravatar.com/" target="_blank">Gravatar </a></div>

            {!! Form::model($user, ['method' => 'PATCH', 'action' => ['UserController@update', $user->id]]) !!}

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-globe"></i></div>
                        {!! Form::text('website', $user->website, ['class' => 'form-control', 'placeholder' => 'website']) !!}
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-qq"></i></div>
                        {!! Form::text('qq', $user->qq, ['class' => 'form-control', 'placeholder' => 'QQ']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::textarea('description', $user->description, ['class' => 'form-control', 'rows' => 3, 'placeholder' => 'Description']) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('save', ['class' => 'btn btn-primary form-control']) !!}
                </div>
            {!! Form::close() !!}
        </div>
    {{-- </div> --}}
@stop