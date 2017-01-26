@extends('layouts.admin')

@section('content')
    <div class="container">

        <h1>Create New Cleaner</h1>
        <hr/>

        {!! Form::open(['route' => 'admin.cleaner.store', 'class' => 'form-horizontal', 'files' => true]) !!}

        <div class="form-group {{ $errors->has('first_name') ? 'has-error' : ''}}">
            {!! Form::label('first_name', 'First Name', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
                {!! $errors->first('first_name', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('last_name') ? 'has-error' : ''}}">
            {!! Form::label('last_name', 'Last Name', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
                {!! $errors->first('last_name', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
            {!! Form::label('email', 'email', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('email', null, ['class' => 'form-control']) !!}
                {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('quality_score') ? 'has-error' : ''}}">
            {!! Form::label('quality_score', 'Quality Score', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::number('quality_score', null, ['class' => 'form-control']) !!}
                {!! $errors->first('quality_score', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('cities', 'Cities', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                <div class="row">
                    @foreach($cities as $item)
                        <div class="col-sm-3">
                            {!! Form::checkbox('cities[]', $item->id, false) !!} {!! $item->name !!}
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        {!! $errors->first('cities', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            </div>
        </div>


        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-3">
                {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
            </div>
        </div>
        {!! Form::close() !!}

    </div>
@endsection