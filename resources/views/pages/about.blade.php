@extends('main')

@section('title', '| About')


@section('content')
    <div class="card">
        <div class='row'>
            <div class='col-md-12'>

                <h1>About Us</h1>

                <hr>
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <div class="item">
                            <img src="{{ 'images/about-pictures/california-trip.jpg' }}" alt="...">
                        </div>
                        <div class="item active">
                            <img src="{{ 'images/about-pictures/lab-tour.jpg' }}" alt="...">
                        </div>
                    </div>

                    <!-- Controls -->
                    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

                &nbsp

                <p>As the social bit of the Department of Physics, PhySoc makes it our mission to prove that physics is not only about long lab hours and lab reports! To aid you in your physics exploration, we run multiple physics tours and visits to Blackett labs. Last year we visited CERN, and had a series of talks from leading researchers in the field at Blackett. There's also our ever-popular bar night over in the Union.</p>

                <p>PhySoc is run by physics students, for physics students (and for anyone interested in physics!), all to make your time at Imperial as enjoyable and rewarding as we can. Get involved!</p>

                <p>We're all here for your benefit so come and talk to your reps and the PhySoc committee and let us know what we can do for you!</p>
                &nbsp
                <p class='text-center'><strong>To get in touch, please send an email to <a href"mailto:physics.society@imperial.ac.uk">physics.society@imperial.ac.uk</a></strong></p>
                &nbsp
               
                &nbsp
                <h4>PhySoc Committee 2017–18</h4>
                <hr>
                
                <div class='row' ng-app='committeeApp'  ng-controller='ListCtrl as ctrl'>
                    <div class='col-md-3 col-sm-4 col-xs-6 text-center' ng-repeat='member in ctrl.members'>
                        <img class='committee-image' ng-src= '@{{ member.picture }}'>
                        @{{member.name}}
                        <br>
                        <strong ng-bind='member.position'></strong>
                        <br/>
                        &nbsp
                    </div>
                </div>     
            </div>
        </div>
    </div>
@endsection

@section('javascript')
<script src="/js/app/controllers/committeeController.js"></script>
@endsection