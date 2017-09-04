@extends('main')

@section('title', '| Edit Sponsor')

@section('stylesheets')
    {!! Html::style('css/parsley.css') !!}
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
@endsection

@section('content')
    <div class='row'>

        {!! Form::model($sponsor, ['route' => ['sponsors.update', $sponsor->id], 'method' => 'PUT', 'files' => true]) !!}

            <div class='col-md-8'>
                {{ Form::label('name', 'Name:') }}
                {{ Form::text('name'), null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255', 'data-parsley-type'=>'alphanum'] }}
       
                {{ Form::label('url', 'URL:') }}
                {{ Form::text('url', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255', 'data-parsley-type'=>'url')) }}

                {{ Form::label('logo', 'Upload Company Logo:') }}
                {{ Form::file('logo') }}

                {{ Form::label('description', 'Company description:') }}
                {{ Form::textarea('description', null, array('class' => 'form-control')) }}
                
            </div>

            <div class='col-md-4'>
                <div class='well'>

                    <div class='row'>
                        <div class='col-sm-6'>
                            {!! Html::linkRoute('sponsors.index', 'Cancel', array($sponsor->id), array('class' => 'btn btn-danger btn-block')) !!}
                        </div>
                        <div class='col-sm-6'>
                            {!! Form::submit('Save Changes', ['class' => 'btn btn-success btn-block']) !!}
                        </div>
                    </div>

                </div>
            </div>
        {!! Form::close() !!}
    </div>
@endsection

@section('javascript')
    {{--  {!! Html::script('js/parsley.min.js') !!}
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=92qz8qgirvx72144i74jutlsacu4frab9qlsmza44ziaszyy"></script>

    <script>
        tinymce.init({ 
            selector:'textarea',
            plugins: 'link code',
            menubar:false
        });
    </script>  --}}
@endsection