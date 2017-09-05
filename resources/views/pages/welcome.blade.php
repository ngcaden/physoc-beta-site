@extends('main')

@section('title', '| Home')

@section('content')
    
    <div class='row'>
        <div class='col-md-6'>
            <div class="card">   
                
                <div class="banner text-center">
                    <img src="{{ asset('images/banner_bahfest.png') }}"  style='width:100%;'>
                </div>
                
                &nbsp

                <h1 class='text-center'>
                    Welcome to Imperial College Physics Society! 
                </h1>
                 
                <hr>

                <p class="text-justify">We run multiple events throughout the year, including lab tours and an annual physics. We also hold physics conferences and invite notable researchers for cutting-edge research during Research Frontier sessions. Furthermore, we run a number of social events to bring together the community of students who are interested in Physics.</p>
                &nbsp
                <p class="text-center"><strong>We are currently looking for 2017/18 sponsors of all tiers.</strong></p>
                
                <p class="text-center"><strong>Email us at <a href="mailto:physics.society@imperial.ac.uk">physics.society@imperial.ac.uk</a> if you are interested.</strong></p>
 
            </div> <!-- .card -->
        &nbsp 
        </div> <!-- .col-md-6 -->

        <div class='col-md-6' ng-app='eventApp'>            
            <div class="card" ng-controller='ListCtrl as ctrl'>
                <h3>Upcoming Events</h3>
                <hr>
                
                <div class="panel panel-default" ng-repeat='item in ctrl.items'>
                    <div class="panel-heading">@{{item.title}} <strong>@{{item.time}}</strong></div>
                    <div class="panel-body">
                        @{{item.location}}
                    </div>
                </div> 
                    
                <div class="text-center">
                    <a href="/events"><button class="btn btn-primary" role="button">See All Events</button></a>    
                </div>

                 
            </div> <!-- .card -->
            &nbsp 
        </div> <!-- .col-md-6 -->
    </div> <!-- .row -->
@endsection <!-- content -->


@section('javascript')
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
<script src="/js/app/controllers/eventController.js"></script>
@endsection

{{--  @foreach($posts as $post)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a href="{{ url('events/'.$post->slug) }}">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-8">
                                            {{ $post->title }} 
                                        </div>

                                        <div class="col-xs-2">
                                            <strong>{{ \Carbon\Carbon::parse($post->time)->format('d M') }}</strong>
                                        </div>

                                        <div class="col-xs-2">
                                            <span class="badge">{{ $post->category->name }}</span>
                                        </div>
                                    </div>
                                    
                                </div>
                            <p>{{ substr(strip_tags($post->body), 0, 300) }}{{ strlen(strip_tags($post->body)) > 300 ? "...":"" }}</p>    
                        </div>
                    </div>

                    &nbsp

                @endforeach  --}}