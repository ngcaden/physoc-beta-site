@extends('main')

@section('title', '| View Post')

@section('content')
    <div class='row'>
        <div class='col-md-8'>
            <div class="card">
                <h1>{{ $post->title }}</h1>
                <h4>{{ $post->location }}, {{ \Carbon\Carbon::parse($post->time)->format('d M Y H:m') }}</h4>
                <h5>Duration: {{ $post->duration }}</h5>
                <hr>
                <img src="{{ asset('images/' . $post->image) }}" width = "100%">
                
                &nbsp
                
                <p>{!! $post->body !!}</p>
                <hr>
                <p>Posted In:  <span class="badge">{{ $post->category->name }}</span></p>
            </div>

            &nbsp
        </div>

        <div class='col-md-4'>
            <div class='well'>
                <dl>
                    <dt>URL:</dt>
                    <dd><a href="{{ url('events/'.$post->slug) }}">{{ url('events/'.$post->slug) }}</a></dd>
                </dl>

                <dl>
                    <dt>Created At:</dt>
                    <dd>{{ date('M j, Y H:i', strtotime($post->created_at)) }}</dd>
                </dl>

            <hr>

            <div class='row'>
                <div class='col-sm-6'>
                    {!! Html::linkRoute('posts.edit', 'Edit', array($post->id), array('class' => 'btn btn-primary btn-block')) !!}
                </div>
                <div class='col-sm-6'>
                    {!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'DELETE']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block']) !!}
                    {!! Form::close() !!}
                </div>
            </div>

            </div>
        </div>
    </div>
@endsection