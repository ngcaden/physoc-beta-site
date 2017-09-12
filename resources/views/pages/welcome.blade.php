@extends('main')

@section('title', '| Home')

@section('content')
    
    <div class='row'>
        <div class='col-md-6'>
            <div class="card" id="welcome-column">   
                
                <div class="text-center">
                    <img src="/images/welcome-banner/freshers-fair-2017.jpg"  style='width:100%;'>
                </div>
                
                &nbsp

                <h1 class='text-center'>
                    Welcome to Imperial College Physics Society! 
                </h1>
                 
                <hr>

                <p class="text-justify">We run multiple events throughout the year, including lab tours and annual physic trips. Every other week, we also hold Research Frontier conferences, during which invited researchers present their cutting-edge research in physics. Furthermore, we run lots of social events to bring together the Physics community at Imperial and beyond.</p>
                &nbsp
                <p class="text-center"><strong>We are currently looking for 2017/18 sponsors of all tiers.</strong></p>
                
                <p class="text-center"><strong>Email us at <a href="mailto:physics.society@imperial.ac.uk">physics.society@imperial.ac.uk</a> if you are interested.</strong></p>
 
            </div> <!-- .card -->
        &nbsp 
        </div> <!-- .col-md-6 -->

        <div class='col-md-6' ng-app='eventApp'>            
            <div class="card" ng-controller='ListCtrl as ctrl'  id="event-column">
                <h3>Upcoming Events</h3>
                <hr>
                <div class='text-center'>
                    <button class="btn btn-info" ng-click="myFilter = {category:'Social'}">Social</button>
                    <button class="btn btn-success" ng-click="myFilter = {category:'Careers'}">Careers</button>
                    <button class="btn btn-warning" ng-click="myFilter = {category:'Lab Tour'}">Lab Tour</button>
                    <button class="btn btn-danger" ng-click="myFilter = {category:'Research'}">Research</button>
                    <button class="btn btn-default" ng-click="myFilter = {}">All</button>
                </div>
                &nbsp 

                <div class='well' style='height:65%;overflow:scroll;'>

                    <div class="panel-group">
                        <div ng-repeat="event in ctrl.events | filter:myFilter" class="panel" ng-class='ctrl.getEventClass(event)'>
                            <div class="panel-heading">
                                <a data-toggle="collapse" href="#collapse@{{event.id}}">
                                    <strong ng-bind='event.date | date: "mediumDate"'></strong> &nbsp <span ng-bind='event.title'></span>
                                </a>
                            </div>
                            
                            <div id="collapse@{{event.id}}" class="panel-collapse collapse"> 
                                <div class="panel-body">
                                    <p ng-show='event.body' ng-bind='event.body'></p>
                                    <p><strong>Location:</strong> <span ng-bind='event.location'></span><br>
                                    <strong>Date:</strong> <span ng-bind='event.date | date: "mediumDate"'></span><br>
                                    <strong>Time:</strong> <span ng-bind='event.start'></span>-<span ng-bind='event.end'></span><br>
                                    <strong ng-show='event.link'>Event link:</strong> <a href="@{{event.link}}" ng-bind='event.link'></a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <button class="btn btn-primary" ng-click='ctrl.allEvents()'>Show Past Events</button>  
                    <button class="btn btn-primary" ng-click='ctrl.hideAllEvents()'>Hide Past Events</button>  
                </div>

                 
            </div> <!-- .card -->
            &nbsp 
        </div> <!-- .col-md-6 -->
    </div> <!-- .row -->
@endsection <!-- content -->


@section('javascript')
<script src="/js/app/controllers/eventController.js"></script>
@endsection