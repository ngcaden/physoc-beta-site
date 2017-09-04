@extends('main')

@section('title', '| Create New Post')

@section('stylesheets')
    {!! Html::style('css/parsley.css') !!}
    {!! Html::style('css/jquery.datetimepicker.css') !!} 
@endsection

@section('content')
    
    <div class='row'>
        <div class='col-md-8 col-md-offset-2'>
            <div class="card">
                <h1>Create New Post</h1>
                <hr>
                
                {!! Form::open(['route' => 'posts.store', 'data-parsley-validate' => '', 'files' => true]) !!}
                    {{ Form::label('title', 'Title:') }}
                    {{ Form::text('title', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}

                    {{ Form::label('slug', 'Slug:') }}
                    {{ Form::text('slug', null, array('class' => 'form-control', 'required' => '', 'minlength' => '5', 'maxlength' => '255', 'data-parsley-type'=>'alphanum')) }}


                    <div class="row">
                        <div class="col-sm-6">
                            {{ Form::label('time', 'Timing:') }}
                            {{ Form::date('time', null, ['class' => 'form-control', 'required' => '', 'id' => "datetimepicker"]) }}
                        </div>
                        <div class="col-sm-6">
                            {{ Form::label('duration', 'Duration:') }}
                            {{ Form::text('duration', null, array('class' => 'form-control', 'maxlength' => '255')) }}
                        </div>
                    </div>
                    
                    
                    {{ Form::label('category_id', 'Category:') }}
                    <select class="form-control" name="category_id">
                        @foreach($categories as $category)
                            <option value='{{ $category->id }}'>{{ $category->name }}</option>
                        @endforeach
                    </select>

                    {{ Form::label('featured_image', 'Upload Feature Image:') }}
                    {{ Form::file('featured_image') }}

                    {{ Form::label('location', 'Location:') }}
                    {{ Form::text('location', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}

                    {{ Form::label('body', 'Event Description:') }}
                    {{ Form::textarea('body', null, array('class' => 'form-control')) }}

                    {{ Form::submit('Create Post', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top:20px'))}}
                {!! Form::close() !!}
            </div>
        </div>
    </div> 

@endsection

@section('javascript')
    {!! Html::script('js/jquery.datetimepicker.full.min.js') !!}
    {!! Html::script('js/parsley.min.js') !!}
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=92qz8qgirvx72144i74jutlsacu4frab9qlsmza44ziaszyy"></script>
    {!! Html::script('js/tinymce.post.js') !!}

    <script>
        jQuery.datetimepicker.setLocale('en');
        jQuery('#datetimepicker').datetimepicker();
    </script>
@endsection