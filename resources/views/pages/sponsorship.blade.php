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
                <div class='well' ng-app="sponsorApp">
                    <div class="panel-group" ng-controller="ListCtrl as ctrl">
                        <div ng-repeat="sponsor in ctrl.sponsors" class="panel panel-default">
                            <div class="panel-heading">
                                <strong ng-bind='sponsor.name'></strong>
                            </div>
                            
                            <div class="panel-body">
                                <div class='container-fluid'>
                                        <img class='img-responsive' ng-src= "@{{ sponsor.logo }}">
                                </div>
                                &nbsp
                                
                                <p ng-show='sponsor.description' ng-bind='sponsor.description'></p>
                                <strong ng-show='sponsor.url'>Sponsor URL:</strong> <a href="@{{sponsor.url}}" ng-bind='sponsor.url'></a></p>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection

@section('javascript')
<script src="/js/app/controllers/sponsorController.js"></script>
</script>
@endsection