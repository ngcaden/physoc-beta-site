@extends('main')

@section('title', '| Edit Event')

@section('stylesheets')
    {!! Html::style('css/parsley.css') !!}
    {!! Html::style('css/jquery.datetimepicker.css') !!} 
@endsection

@section('content')
     <div class='row'>
        <div class='col-md-8 col-md-offset-2'>
            <div class="card">
                <h1>Edit Event</h1>
                <hr>

                {!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'PUT', 'data-parsley-validate' => '', 'files' => true]) !!}

                    {{ Form::label('title', 'Title:') }}
                    {{ Form::text('title', null, ['class' => 'form-control', 'required' => '','maxlength' => '255']) }}

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
                    {{ Form::label('category_id', "Category:") }}
                    <select class="form-control" name="category_id">
                        @foreach($categories as $category)
                            <option value='{{ $category->id }}'>{{ $category->name }}</option>
                        @endforeach
                    </select>


                    {{ Form::label('featured_image', 'Update Featured Image') }}
                    {{ Form::file('featured_image') }}

                    @if ($post->image)
                        <p><img href="" src="{{ asset('images/' . $post->image) }}" height = "40" width = "80"></p>
                    @endif

                    {{ Form::label('location', 'Location:') }}
                    {{ Form::text('location', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}


                    {{ Form::label('body', 'Body:') }}
                    {{ Form::textarea('body', null, ['class' => 'form-control']) }}

                    &nbsp
                    
                    <div class='row'>
                        <div class='col-sm-6'>
                            {!! Html::linkRoute('posts.show', 'Cancel', array($post->id), array('class' => 'btn btn-danger btn-block')) !!}
                        </div>
                        <div class='col-sm-6'>
                            {!! Form::submit('Save Changes', ['class' => 'btn btn-success btn-block']) !!}
                        </div>
                    </div>

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