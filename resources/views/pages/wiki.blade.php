@extends('main')

@section('title', '| Wiki')

@section('content')
    <div class="row" ng-app="wikiApp" ng-controller="MainCtrl as ctrl">
        <div class="col-sm-3">
            <div class="well">
                <div class="panel-group">
                    <div ng-repeat="year in ctrl.years" class="panel panel-info">
                                        
                        <div class="panel-heading">
                            <strong><span ng-bind="year.name"></span></strong>
                        </div>
                
                        
                        <div class="panel-body" style="margin:0px;">
                            <ul style="padding-left:12px;">
                                <li ng-repeat="course in ctrl.courses | filter: {year: year.year_id}">
                                    <a ng-click="ctrl.fetchWiki(course.id)" href>
                                        <span ng-bind="course.name"></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div><!-- .panel-group -->

                <!-- Add New Subject -->
                <a ng-click="ctrl.newCourseForm()" href>
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Add New Course
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
                <div class="content-box" style="background-color:#f5faff;">
                    <h4 class="content-box" style="background-color:#cedff2;">Description</h4>

                    <p><span ng-bind-html="ctrl.wiki.html_description"></span></p>
                    
                    <!-- Edit Description -->
                    <p ng-hide="ctrl.wiki.welcome">
                        <a ng-click="ctrl.editDescriptionForm()" href>
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Description
                        </a> 
                    </p>
                </div>

                &nbsp

                <!-- Notes -->
                <div ng-show="ctrl.courseNotes" class="content-box">
                    <h4 class="content-box" style="background-color:#cef2e0;">Course Notes</h4>
                    
                    <p ng-hide="ctrl.courseNotes.length">
                        No course note to show
                    </p>

                    <ul class="nav nav-tabs" ng-show="ctrl.courseNotes.length">
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

                    <p>
                        <a ng-click="ctrl.addNotesForm()" href>
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Add Notes
                        </a>
                    </p>
                </div> 
                &nbsp 

                <!-- Useful Links -->
                <div class="content-box" ng-show="ctrl.usefulLinks">
                    <h4 class="content-box" style="background-color:#cef2e0;">Useful Links</h4>
                    
                    <p ng-hide="ctrl.usefulLinks.length">
                        No useful link to show
                    </p>

                    <ul ng-show="ctrl.usefulLinks.length">
                    &nbsp
                        <li ng-repeat="link in ctrl.usefulLinks">
                            <a ng-href="@{{link.url}}" target="_blank">
                                <span ng-bind="link.name"></span>
                            </a>
                        </li>
                    </ul>

                    <p>
                        <a ng-click="ctrl.addLinksForm()" href>
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Add Useful Links
                        </a>
                    </p>
                </div> 
                &nbsp 

                <!-- Past Papers -->
                <div class="content-box" ng-show="ctrl.pastPapers">

                    <h4 class="content-box" style="background-color:#cef2e0;">Past Papers and Solutions</h4>

                    &nbsp

                    <div ng-show="ctrl.pastPapers">
                        <p>
                            <a ng-click="ctrl.addPastPapersForm()" href>
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Upload Past Papers
                            </a> 
                        </p>
                        <p>
                            <a ng-click="ctrl.solutionGuide()" href>
                                <i class="fa fa-file-text" aria-hidden="true"></i> Solution Creation Guide
                            </a>
                        </p>

                        <p ng-hide="ctrl.pastPapers.length">
                            No past paper to show
                        </p>

                        <div ng-show="ctrl.pastPapers.length">
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
                                    <p>
                                        <a ng-href="@{{paper.url}}" target="_blank">
                                            <i class="fa fa-download" aria-hidden="true"></i> Download the PDF version of the paper here
                                        </a>
                                    </p>

                                    <p ng-hide="ctrl.solutions.length">
                                        Unfortunately, there is currently no solution to this paper.
                                    </p>

                                    <ol>
                                        <li ng-repeat="solution in ctrl.solutions | filter:{paper_id:paper.id}">
                                            <a ng-href="@{{solution.url}}" target="_blank" href>
                                                <i class="fa fa-external-link" aria-hidden="true"></i> View/Edit Solution 
                                            </a> 
                                        </li>
                                    </ol>
                                    <p>
                                        <a ng-click="ctrl.addNewSolutionForm(paper.id)" href>
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Add Solution Link
                                        </a> 
                                    </p>
                                </div><!-- .tab-pane -->
                            </div><!-- .tab-content -->
                        </div>
                    </div>
                </div><!-- .div -->
            </div><!-- .card-wiki -->
        </div><!-- .col-sm-9 -->
       
       <!-- Forms -->

        <div new-course-form></div>
        <div edit-description-form></div>
        <div add-notes-form></div>
        <div add-links-form></div>
        <div add-past-papers-form></div>
        <div show-solution-guide></div>
        <div add-new-solution-form></div>
    </div><!-- .row -->
    
@endsection

@section('javascript')
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-sanitize.js"></script>
<script src="/assets/vendor/ng-file-upload/ng-file-upload.min.js"></script>
<script src="/js/app/controllers/wikiController.js"></script>
<script src="/js/app/directives/wikiFormDirective.js"></script>
@endsection