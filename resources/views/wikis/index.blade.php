@extends('main')

@section('title', '| Wiki')

@section('content')
    <div class="row" ng-app="wikiApp" ng-controller="MainCtrl as ctrl">
        <div class="col-sm-3">
            <div class="well">
                <div class="panel-group">
                    <div ng-repeat="year in ctrl.years" class="panel panel-info">
                                        
                    <div class="panel-heading">
                        <a data-toggle="collapse" href="#collapse@{{ year.year_id }}">
                            <strong ng-bind="year.name"></strong>
                        </a>
                    </div>
                
                    <div id="collapse@{{ year.year_id }}" class="panel-collapse collapse">
                        <div class="panel-body">
                            <a ng-repeat="course in ctrl.courses | filter: {year: year.year_id}" ng-click="ctrl.fetchCourse(course.name)" href>
                                <span ng-bind="course.name"></span>
                            </a>
                        </div>
                    </div>

                    </div>
                </div>
            </div><!-- .card -->
        </div><!-- .col-sm-6 -->

        <div class="col-sm-9">
            <div class="card-wiki">    
                <h3>
                    <span ng-show="ctrl.wiki.name" ng-bind="ctrl.wiki.name"></span>
                    <span class='pull-right'>
                        <form class="form-horizontal" method="POST" action="{{ route('logout') }}">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary">
                                Logout
                            </button>
                        </form>
                    </span>
                </span>
                </h3>  
                <hr>
                
                <!-- Description -->
                <p>
                    <span ng-bind="ctrl.wiki.description"></span>
                </p> 
                &nbsp 
                <div class="dropdownbox">
                    <a class="btn" data-toggle="collapse" data-target="#viewnotes">
                        <strong>Course Notes</strong> &nbsp <span class="pull-right"><i class="fa fa-caret-down" aria-hidden="true"></i></span>
                    </a>
                    
                    
                    <div class="collapse" id="viewnotes">
                        <hr>
                        <ul class="nav nav-tabs">
                            <li ng-repeat="uniqueSet in ctrl.uniqueSets">
                                <a ng-href="#set@{{uniqueSet.id}}" data-toggle="tab">
                                    <span ng-bind="uniqueSet.set"></span>
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane" ng-repeat="uniqueSet in ctrl.uniqueSets" id="set@{{uniqueSet.id}}">
                                
                                    <div ng-repeat="note in ctrl.courseNotes | filter: {set:uniqueSet.set}">
                                        <a ng-href="@{{note.link}}">
                                            <span ng-bind="note.name"></span>
                                        </a>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div> 
                &nbsp 
                <div class="dropdownbox">
                    <a class="btn" data-toggle="collapse" data-target="#viewlinks">
                        <strong>Useful Links <i class="fa fa-caret-down" aria-hidden="true"></i></strong>
                    </a>

                    <div class="collapse" id="viewlinks">
                        <span ng-bind="ctrl.wiki.links"></span>
                    </div> 
                </div>

                &nbsp 
                <h4>Past Papers and Solutions</h4>
                <p>
                    <span ng-bind="ctrl.wiki.papers"></span>
                </p> 

                {{--  <div class="container-fluid">	
                    <ul class="nav nav-tabs">
                        <li class="active"><a  href="#1" data-toggle="tab">Year 1</a>
                        </li>
                        <li><a href="#2" data-toggle="tab">Year 2</a>
                        </li>
                        <li><a href="#3" data-toggle="tab">Year 3</a>
                        </li>
                        <li><a href="#4" data-toggle="tab">Options</a>
                        </li>
                    </ul>

                    <div class="tab-content ">
                        <div class="tab-pane active" id="1">
                            <div class="well">
                                @foreach ($ones as $one) 
                                    <div class="panel-group">
                                        <div class="panel panel-success">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" href="#collapse{{ $one->id }}">{{ $one->name }}</a>
                                                </h4>
                                            </div>
                                            
                                            <div id="collapse{{ $one->id }}" class="panel-collapse collapse">
                                            
                                            <div class="panel-body">
                                                @foreach($one->wikis as $wiki)
                                                    <p>{!! Html::linkRoute('wikis.show', $wiki->year, $wiki->id) !!}</p>
                                                @endforeach
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="text-center">
                                    {!! Html::linkRoute('wikis.create', 'Upload Year 1 Past Paper', array(1), array('class' => 'btn btn-default')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="2">
                            <div class="well">
                                @foreach ($twos as $two) 
                                    <div class="panel-group">
                                        <div class="panel panel-success">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" href="#collapse1">{{ $two->name }}</a>
                                                </h4>
                                            </div>
                                            
                                            <div id="collapse1" class="panel-collapse collapse">
                                            
                                            <div class="panel-body">Panel Body</div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="text-center">
                                    {!! Html::linkRoute('wikis.create', 'Upload Year 2 Past Paper', array(2), array('class' => 'btn btn-default')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="3">
                            <div class="well">
                                @foreach ($threes as $three) 
                                    <div class="panel-group">
                                        <div class="panel panel-success">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" href="#collapse1">{{ $three->name }}</a>
                                                </h4>
                                            </div>
                                            
                                            <div id="collapse1" class="panel-collapse collapse">
                                            
                                            <div class="panel-body">Panel Body</div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="text-center">
                                    {!! Html::linkRoute('wikis.create', 'Upload Year 3 Past Paper', array(3), array('class' => 'btn btn-default')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="4">
                            <div class="well">
                                @foreach ($options as $option) 
                                    <div class="panel-group">
                                        <div class="panel panel-success">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" href="#collapse1">{{ $option->name }}</a>
                                                </h4>
                                            </div>
                                            
                                            <div id="collapse1" class="panel-collapse collapse">
                                            
                                            <div class="panel-body">Panel Body</div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="text-center">
                                    {!! Html::linkRoute('wikis.create', 'Upload Options Past Paper', array(0), array('class' => 'btn btn-default')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                --}}
            </div>
        </div>
    </div>

@endsection

@section('javascript')
<script src="/js/app/controllers/wikiController.js"></script>
<script src="/js/app/directives/wikiDirective.js"></script>
@endsection