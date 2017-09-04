
@extends('main')

@section('title', '| Create New Answer')

@section('stylesheets')
    {!! Html::style('css/parsley.css') !!}
@endsection

@section('content')
    
    <div class='row'>
        <div class='col-md-8 col-md-offset-2'>
            <div class="card">
                <h1>Create New Answer</h1>
                <hr>
                
                {!! Form::open(['route' => 'wikis.store', 'data-parsley-validate' => '', 'files' => true]) !!}
                    {{ Form::label('year', 'Year:') }}
                    {{ Form::number('year', \Carbon\Carbon::now()->year, array('class' => 'form-control', 'required' => '', 'data-parsley-type'=>'integer')) }}

                    {{ Form::label('paper', 'Upload past paper:') }}
                    {{ Form::file('paper') }}

                    {{ Form::label('subject_id', 'Choose the subject:') }}
                    <select class="form-control" name="subject_id">
                        @foreach($subjects as $subject)
                            <option value='{{ $subject->id }}'>{{ $subject->name }}</option>
                        @endforeach
                    </select>

                    {{ Form::label('questions', 'Number of questions:') }}
                    {{ Form::number('questions', 1, array('class' => 'form-control', 'required' => '', 'data-parsley-type'=>'integer')) }}


                    {{ Form::submit('Upload', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top:20px'))}}
                {!! Form::close() !!}
            </div>
        </div>
    </div> 

@endsection

@section('javascript')
    {!! Html::script('js/parsley.min.js') !!}
@endsection