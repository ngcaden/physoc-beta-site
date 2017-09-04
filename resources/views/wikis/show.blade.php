@extends('main')

@section('title', "| $wiki->paper")

@section('content')

    <div class='row'>
        <div class='col-md-8 col-md-offset-2'>
            <div class="card">
                
                <h1>{{ $wiki->subject->name }} {{ $wiki->year }}</h1>

                <hr>

                <h4>Download the original paper <a href="{{ asset('past_papers/' . $wiki->paper) }}" target=blank>here</a>.</h4>
                
                &nbsp
                <div class="text-center">
                    <button class='btn btn-primary' href='#'>Contribute Answers</button>
                    {{--  {!! Html::linkRoute('posts.edit', 'Edit', array($post->id), array('class' => 'btn btn-primary btn-block')) !!}  --}}
                </div>
            </div>
        </div>
    </div>

@endsection