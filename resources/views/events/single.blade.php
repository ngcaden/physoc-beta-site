@extends('main')

@section('title', "| $post->title")

@section('content')


    <div class='row'>
        <div class='col-md-8 col-md-offset-2'>
            <div class="card">
                
                <h1>{{ $post->title }}</h1>
                <h4>{{ $post->location }}  -  <mark>{{ \Carbon\Carbon::parse($post->time)->format('d M Y H:m') }}</mark></h4>
                <h5>Duration: {{ $post->duration }}</h5>
                <hr>

                <img src="{{ asset('images/' . $post->image) }}" width = "100%">
                
                &nbsp
                
                <p>{!! $post->body !!}</p>
                <hr>
                <p>Posted In:  <span class="badge">{{ $post->category->name }}</span></p>
            </div>
        </div>
    </div>

@endsection