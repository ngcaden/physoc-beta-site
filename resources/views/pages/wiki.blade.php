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
                                <strong><span ng-bind="year.name"></span> <i class="fa fa-caret-down" aria-hidden="true"></i></strong>
                            </a>
                        </div>
                
                        <div id="collapse@{{ year.year_id }}" class="panel-collapse collapse in" ng-show="ctrl.courses">
                            <div class="panel-body">
                                <ul>
                                    <li ng-repeat="course in ctrl.courses | filter: {year: year.year_id}">
                                        <a ng-click="ctrl.fetchWiki(course.id)" href>
                                            <span ng-bind="course.name"></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div><!-- .panel-group -->

                <!-- Add New Subject -->
                <a ng-click="ctrl.newCourseForm()" href>
                    Add New Course
                </a>
            </div><!-- .well -->
        </div><!-- .col-sm-3 -->

        <div class="col-sm-9">
            <div class="card-wiki">    
                <!-- Heading -->
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
                </h3>  
                <hr>
                
                <!-- Description -->
                <p>
                    <span ng-bind-html="ctrl.wiki.html_description"></span>
                </p>

                <!-- Edit Description -->
                <p ng-hide="ctrl.wiki.welcome">
                    <a ng-click="ctrl.editDescriptionForm()" href>
                        Edit Description
                    </a> 
                </p>
                &nbsp

                <!-- Notes -->
                <div class="dropdownbox">
                    <a class="btn" data-toggle="collapse" data-target="#viewnotes">
                        <strong>Course Notes <i class="fa fa-caret-down" aria-hidden="true"></i></strong>
                    </a>

                    <div class="collapse in" id="viewnotes" ng-show="ctrl.courseNotes">
                        <ul class="nav nav-tabs">
                            <li ng-repeat="uniqueSet in ctrl.uniqueSets" 
                                ng-class="{active: uniqueSet.id == 0}">
                                <a ng-href="#set@{{uniqueSet.id}}" data-toggle="tab">
                                    <span ng-bind="uniqueSet.set"></span>
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane" ng-repeat="uniqueSet in ctrl.uniqueSets" 
                                                  id="set@{{uniqueSet.id}}"
                                                  ng-class="{active: uniqueSet.id == 0}">
                                    &nbsp
                                    <ul>
                                        <li ng-repeat="note in ctrl.courseNotes | filter: {set:uniqueSet.set}">
                                            <a target="_blank" ng-href="@{{note.url}}">
                                                <span ng-bind="note.name"></span>
                                            </a>
                                        </li>
                                    </ul>
                            </div>
                        </div>

                        &nbsp

                        <p ng-show="ctrl.courseNotes">
                            <a ng-click="ctrl.addNotesForm()" href>
                                Add Notes
                            </a> 
                        </p>
                    </div>  
                </div> 
                &nbsp 

                <!-- Useful Links -->
                <div class="dropdownbox">
                    <a class="btn" data-toggle="collapse" data-target="#viewlinks">
                        <strong>Useful Links <i class="fa fa-caret-down" aria-hidden="true"></i></strong>
                    </a>

                    <div class="collapse in" id="viewlinks" ng-show="ctrl.usefulLinks">
                        <ul>
                            <li ng-repeat="link in ctrl.usefulLinks">
                                <a ng-href="@{{link.url}}" target="_blank">
                                    <span ng-bind="link.name"></span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    &nbsp

                    <p ng-show="ctrl.usefulLinks">
                        <a ng-click="ctrl.addLinksForm()" href>
                            Add Useful Links
                        </a> 
                    </p>

                </div> 
                &nbsp 

                <!-- Past Papers -->
                <div class="dropdownbox">
                    <a class="btn" data-toggle="collapse" data-target="#viewpapers">
                        <strong>Past Papers and Solutions <i class="fa fa-caret-down" aria-hidden="true"></i></strong>
                    </a>

                    <div class="collapse in" id="viewpapers" ng-show="ctrl.pastPapers">
                        <ul class="nav nav-tabs">
                            <li ng-repeat="paper in ctrl.pastPapers" 
                                ng-class="{active: paper.year_id == 0}">
                                <a ng-href="#paper@{{paper.id}}" data-toggle="tab" ng-click="ctrl.fetchAnswers(paper.id)">
                                    <span ng-bind="paper.year"></span>
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane" ng-repeat="paper in ctrl.pastPapers" 
                                                  id="paper@{{paper.id}}"
                                                  ng-class="{active: paper.year_id == 0}">
                                &nbsp
                                <p><a ng-href="@{{paper.url}}">Download the PDF version of the paper here</a></p>
                                <div ng-repeat="question in ctrl.questions">
                                    <h5>Question <span ng-bind="question.question"></span></h5>
                                    <div ng-repeat="answer in ctrl.answers | filter: {question: question.question}">
                                        <p ng-bind="answer.body"></p>
                                    </div>
                                </div>
                            </div><!-- .tab-pane -->
                        </div><!-- .tab-content -->
                    </div><!-- .collapse -->
                </div><!-- .dropdownbox -->
            </div><!-- .card-wiki -->
        </div><!-- .col-sm-9 -->
       
       <!-- Forms -->
        <div new-course-form></div>
        <div edit-description-form></div>
        <div add-notes-form></div>
        <div add-links-form></div>
        <div add-past-papers-form></div>
    </div><!-- .row -->
@endsection

@section('javascript')
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-sanitize.js"></script>
<script src="/assets/vendor/ng-file-upload/ng-file-upload.min.js"></script>
<script src="/js/app/controllers/wikiController.js"></script>
<script src="/js/app/directives/wikiFormDirective.js"></script>
@endsection