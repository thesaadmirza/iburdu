@extends('admin.layout')

@section('page-header')
Notifications Create
@stop

@section('content')
    <div class="col-lg-8 col-lg-offset-2">
        @include('errors.errlist')
        @include('flash::message')

        <form action="{{ url('/admin/notifications') }}" method="POST" class="form-horizontal">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                {!! Form::label('user_id', 'User ID', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('user_id', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('body', 'Message content', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    {!! Form::textarea('body', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('type', 'Message type', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    <div class="radio col-sm-3">
                        <label>
                            {!! Form::radio('type', 'info', null) !!} Info
                        </label>
                    </div>
                    <div class="radio col-sm-3">
                        <label>
                            {!! Form::radio('type', 'warning', null) !!} Warning
                        </label>
                    </div>
                    <div class="radio col-sm-3">
                        <label>
                            {!! Form::radio('type', 'danger', null) !!} Danger
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">

                {!! Form::label('to_all', 'For all users', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    {!! Form::select('to_all', [1 => '是', 0 => '否'], null, ['class' => 'form-control']) !!}
                    {{-- {!! Form::text('value', null, ['class' => 'form-control']) !!} --}}
                </div>
            </div>
            <div class="form-group">
                {!! Form::submit('Addto', ['class' => 'btn btn-primary form-control']) !!}
            </div>
        </form>

    </div>
@stop