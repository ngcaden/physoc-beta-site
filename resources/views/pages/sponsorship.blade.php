@extends('main')

@section('title', '| Sponsors')

@section('content')
    <div class="card">
        
        <div class='row'>
            <div class='col-md-12'>
                <h1>Sponsorship</h1>
                <hr>
                <p>PhySoc offers a lot to our students but this wouldn't be possible without the support we receive from industry. In return, companies gain access to over 1000 active physics students through a variety of events, sessions, emails, job advertisements and more.</p>

                <p>We only hold events for speakers or companies who support us directly and we always welcome new partnerships and opportunities.</p>

                &nbsp
                <p class="text-center"><strong>We are currently looking for 2017/18 sponsors of all tiers.</strong></p>
                
                <p class="text-center"><strong>Email us at <a href="mailto:physics.society@imperial.ac.uk">physics.society@imperial.ac.uk</a> if you are interested.</strong></p>
                
                &nbsp
                &nbsp
                <h4>Current Sponsors</h4>
                <hr>
                @foreach($sponsors as $sponsor)
                            
                            <div>
                                <h3>{{ $sponsor->name }}</h3>
                                
                                <img src="{{ asset('logos' . $sponsor->logo) }}" height = "40" width = "80">
                                <p>{{ $sponsor->description  }}</p>
                                <a class="btn btn-primary" href="{{ url($sponsor->url) }}" role="button">Find Out More</a>
                            </div>

                @endforeach


            </div>
        </div>
    </div>
@endsection