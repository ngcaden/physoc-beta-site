@extends('main')

@section('title', '| Subjects')

@section('stylesheets')
    {!! Html::style('css/parsley.css') !!}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                <h1>Edit Subjects</h1>
                <hr>    
                
                {!! Form::open(['route' => 'subjects.store', 'method' => 'POST', 'data-parsley-validate' => '']) !!}
                
                {{ Form::label('name', 'Subject Name:') }}
                {{ Form::text('name', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}
                    
                {{ Form::label('year', 'Year (0 for Options):') }}
                {{ Form::text('year', null, ['class' => 'form-control', 'required' => '', 'data-parsley-type'=>'integer']) }}
               
                &nbsp
                <div class="text-center">
                    {{ Form::submit('Add Subject', ['class' => 'btn btn-primary ßbtn-default']) }}
                </div>
                {!! Form::close() !!}

                &nbsp
                
                <table class="table">
                    <thead>
                        <tr>
                            <th>Subject Name</th>
                            <th>Year</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($subjects as $subject)
                        <tr>
                            <td>{{ $subject->name }}</td>
                            <td>{{ $subject->year }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            &nbsp
        </div>
    </div>
@endsection

@section('javascript')
    {!! Html::script('js/parsley.min.js') !!}
@endsection