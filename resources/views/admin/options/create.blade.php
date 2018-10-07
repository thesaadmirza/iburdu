@extends('admin.layout')

@section('page-header')
Options Create
@stop

@section('content')
    <div class="col-lg-8 col-lg-offset-2">
        @include('errors.errlist')
        @include('flash::message')

        <form action="{{ url('/admin/options') }}" method="POST" class="form-horizontal">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                {!! Form::label('label', 'Variable Label', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('label', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('name', 'Variable name', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Can only be letters']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('value', 'Variable value', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('value', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('type', 'Variable type', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    <div class="radio col-sm-5">
                        <label>
                            <input type="radio" name="type" value="text" checked="checked"> Text
                        </label>
                    </div>
                    <div class="radio col-sm-5">
                        <label>
                            <input type="radio" name="type" value="textarea"> Textarea
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                {!! Form::submit('Add to', ['class' => 'btn btn-primary form-control']) !!}
            </div>
        </form>

    </div>
@stop