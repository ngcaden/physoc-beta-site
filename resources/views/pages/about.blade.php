@extends('main')

@section('title', '| About')


@section('content')
    <div class="card">
        <div class='row' ng-app='committee'>
            <div class='col-md-12' ng-controller='MainCtrl as ctrl'>

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

                <p>As the social bit of the Department of Physics, PhySoc makes it our mission to prove that all those long hours spent in labs are worth it after all! Honest! To keep you on your toes, we run physics tours and visits to Blackett labs - for example, last year we visited CERN, and had a series of talks from leading researchers in the institution. There's also our ever-popular bar night over in the Union.</p>

                <p>PhySoc is run by physics students, for physics students (and for anyone interested in physics!), all to make your time at Imperial as enjoyable and rewarding as we can. Get involved!</p>

                <p>We're all here for your benefit so come and talk to your reps and the PhySoc committee and let us know what we can do for you!</p>
                &nbsp
                <p class='text-center'><strong>To get in touch, please send an email to <a href"mailto:physics.society@imperial.ac.uk">physics.society@imperial.ac.uk</a></strong></p>
                &nbsp
               
                &nbsp
                <h4>PhySoc Committee 2017–18</h4>
                <hr>
                
                <div class='row'>
                    <div class='col-md-3 col-sm-4 col-xs-6 text-center' ng-repeat='member in ctrl.members'>
                        <img class='committee-image' ng-hide='member.picture' src="{{ 'images/logo_main-physoc.png' }}">
                        <img class='committee-image' ng-show='member.picture' src= '@{{ member.picture }}'>
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
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
<script type='text/javascript'>
angular.module('committee',[])
  .controller('MainCtrl', [function() {
      var self = this;
      self.members = [
          {position: 'President', name: 'Thomas Woolley'},
          {position: 'Vice President', name: 'Hunain Nadeem'},
          {position: 'Events Officer', name: 'William Richards'},
          {position: 'Webmaster', name: 'Quang Nguyen', picture: '{{ URL::to('/') }}/images/committee/webmaster.jpg'},
          {position: 'Publicity Officer', name: 'Timothy Marley'},
          {position: 'Social Secretary', name: 'Joseff Davies'},
          {position: 'Department Representative', name: 'Michaela Flegrova', picture: '{{ URL::to('/') }}/images/committee/dep-rep.jpg' },
          {position: 'PG Department Representative', name: 'Lloyd James'},
          {position: 'Careers and Sponsorship Officer', name: 'Nicholas Lee'},
          {position: 'Education and Lecturers Officer', name: 'Jemima Graham'},
      ];
  }]);

</script>
@endsection