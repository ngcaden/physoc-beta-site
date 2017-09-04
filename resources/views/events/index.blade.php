@extends('main')

@section('title', '| Events')

@section('content')
    <a name="linktotop"></a>
    <div class="row">
        <div class="col-sm-3">
            <div class="well text-center">    
                <h3><i class="fa fa-calendar" aria-hidden="true"></i> Events</h3>
                &nbsp
                <p class="btn btn-primary btn-block active">September</p>
                <p class="btn btn-primary btn-block">October</p>

                <hr>

                @foreach ($categories as $category)
                    <p class="btn btn-success btn-block">{{ $category->name }}</p>
                @endforeach
            </div>
        </div>
    

        <div class="col-sm-9">
            <div class="card">
                @foreach ($posts as $post)
                    
                            <h4><a href="{{ url('events/'.$post->slug) }}">{{ $post->title }}</a></h4>
                            <h5>{{ date('M j, Y G:i', strtotime($post->time)) }}</h5>
                            <p>{{ substr(strip_tags($post->body), 0, 255) }}{{ strlen(strip_tags($post->body)) > 250 ? '...': ""}}</p>
                    &nbsp  
                @endforeach
            </div>
        </div>
    </div>

    <a href="#linktotop">Back To Top</a>

@endsection