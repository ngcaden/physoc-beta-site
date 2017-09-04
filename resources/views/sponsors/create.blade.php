@extends('main')

@section('title', '| Create New Post')

@section('stylesheets')
    {!! Html::style('css/parsley.css') !!}
@endsection

@section('content')

    <div class='row'>
        <div class='col-md-8 col-md-offset-2'>
            <h1>Add New Sponsor</h1>
            <hr>
            
            {!! Form::open(['route' => 'sponsors.store', 'data-parsley-validate' => '', 'files' => true]) !!}
                {{ Form::label('name', 'Name:') }}
                {{ Form::text('name', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255', 'data-parsley-type'=>'alphanum')) }}

                {{ Form::label('url', 'URL:') }}
                {{ Form::text('url', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255', 'data-parsley-type'=>'url')) }}

                {{ Form::label('logo', 'Upload Company Logo:') }}
                {{ Form::file('logo') }}

                {{ Form::label('description', 'Company description:') }}
                {{ Form::textarea('description', null, array('class' => 'form-control')) }}

                {{ Form::submit('Add', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top:20px'))}}
            {!! Form::close() !!}
        </div>
    </div>

@endsection

@section('javascript')
@endsection