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

                <p ng-hide="ctrl.wiki.welcome">
                    <!-- Edit Description -->
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
                                            <a ng-href="@{{note.link}}">
                                                <span ng-bind="note.name"></span>
                                            </a>
                                        </li>
                                    </ul>
                            </div>
                        </div>
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
       
        <!-- New Couse Modal -->
        <div class="modal fade" id="myNewCourseForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Add New Couse</h4>
                    </div>
                    <form ng-submit="ctrl.newCourse()" class="form-horizontal" 
                                name="newCourseForm" novalidate>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name" class="control-label col-sm-3">* Name:</label> 
                                <div class="col-sm-9">
                                    <input type='text' ng-model='ctrl.NewCourse.name' 
                                                       id="name"
                                                       class="form-control"
                                                       placeholder="Add course name"
                                                       required>
                                    </input>                                   
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="year" class="control-label col-sm-3">* Year:</label>

                                <div class="col-sm-9">
                                    <select type='number' ng-model='ctrl.NewCourse.year' 
                                                          id="year" 
                                                          class="form-control" 
                                                          ng-options="c.year_id as c.name for c in ctrl.years"
                                                          required>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description" class="control-label col-sm-3">Description:</label> 
                                <div class="col-sm-9">
                                    <textarea ng-model='ctrl.NewCourse.description' 
                                                        id="description"
                                                        class="form-control"
                                                        rows="10">
                                    </textarea>                                   
                                </div>
                            </div>
                                        
                        </div><!-- .modal-body -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary" 
                                                value="Add New Course"
                                                ng-disabled="newCourseForm.$invalid"></input>
                        </div><!-- .modal-footer -->
                    </form>
                </div>
            </div>
        </div><!-- Modal -->

        <!-- Edit Description Modal -->
        <div class="modal fade" id="myEditDescriptionForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Edit Course Description</h4>
                    </div>

                    <form ng-submit="ctrl.editDescription(ctrl.EditDescription.id)" class="form-horizontal" 
                                name="editDescriptionForm" novalidate>
                        
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name" class="control-label col-sm-3">Name:</label> 
                                <div class="col-sm-9">
                                    <p ng-bind="ctrl.EditDescription.name" id="name"
                                       class="form-control-static"></p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="year" class="control-label col-sm-3">Year:</label>
                                <div class="col-sm-9">
                                    <p ng-bind="ctrl.EditDescription.year" id="year"
                                       class="form-control-static"></p>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <div class="alert alert-danger text-center" role="alert" ng-show="ctrl.EditDescription.error">
                                        <span ng-bind="ctrl.EditDescription.error"></span>
                                    </div>
                                </div>

                                <label for="description" class="control-label col-sm-3">Description:</label> 
                                <div class="col-sm-9">
                                    <textarea ng-model='ctrl.EditDescription.description' 
                                                        id="description"
                                                        class="form-control"
                                                        rows="10">
                                    </textarea>                                   
                                </div>
                            </div>

                            <div class="form-group" ng-show="ctrl.EditDescription.error">
                                <label for="current_description" class="control-label col-sm-3">Current Version:</label> 
                                <div class="col-sm-9">
                                    <p ng-bind-html='ctrl.current_course.html_description' 
                                                        id="current_description"
                                                        class="form-control-static">
                                    </p>                                   
                                </div>
                            </div>
                                        
                        </div><!-- .modal-body -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal" ng-click="ctrl.fetchWiki(ctrl.wiki.id)">Cancel Edit</button>
                            <input type="submit" class="btn btn-primary" 
                                                value="Save Changes"
                                                ng-disabled="editDescriptionForm.$invalid"></input>
                        </div><!-- .modal-footer -->
                    </form>
                </div>
            </div>
        </div><!-- Modal -->
    </div><!-- .row -->
@endsection

@section('javascript')
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-sanitize.js"></script>
<script src="/js/app/controllers/wikiController.js"></script>
<script src="/js/app/directives/wikiDirective.js"></script>
@endsection