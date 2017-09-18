@extends('main')

@section('title','| All Posts')

@section('content')

<div class='row' ng-app='postApp' ng-controller='ListCtrl as ctrl'>
    <div class="col-md-6">
        <div class="card"  id="column1">
            <h1>Manage Events</h1>

            <hr>

            <form ng-submit="ctrl.newEvent()" class="form-horizontal" 
                    name="eventForm" novalidate>
                <div class="form-group">
                    <label for="title" class="control-label col-sm-3">* Title:</label> 
                    <div class="col-sm-9">
                        <input type='text' ng-model='ctrl.NewEvent.title' 
                                            id="title"
                                            class="form-control" 
                                            placeholder="Add a short, clear name"
                                            maxlength="64"
                                            required>
                        </input>                                   
                    </div>
                </div>

                <div class="form-group">
                    <label for="date" class="control-label col-sm-3">* Time:</label>
                    <div class="col-sm-3">
                        <input ng-model="ctrl.NewEvent.date" id="date" 
                                placeholder="Date" 
                                class="form-control"
                                ng-pattern="/^[0-9\-]+$/" 
                                ng-minlength="10"
                                ng-maxlength="10"
                                required>
                        </input>
                    </div>
                    <div class="col-xs-6 col-sm-3">
                        <input ng-model='ctrl.NewEvent.start' 
                                placeholder="Start time" 
                                class="form-control" 
                                ng-pattern="/^[0-9:]+$/" 
                                ng-minlength="5"
                                ng-maxlength="5"
                                required>
                        </input>
                    </div>
                    <div class="col-xs-6 col-sm-3">
                        <input ng-model='ctrl.NewEvent.end' 
                                placeholder="End Time" 
                                class="form-control"
                                ng-pattern="/^[0-9:]+$/" 
                                ng-minlength="5" 
                                ng-maxlength="5" 
                                required>
                        </input>
                    </div>
                </div>

                <div class="form-group">
                    <label for="location" class="control-label col-sm-3" >* Location:</label>
                        
                    <div class="col-sm-9">
                        <input type='text' ng-model='ctrl.NewEvent.location' 
                                            id="location" 
                                            class="form-control"
                                            placeholder="Include a place or address" 
                                            ng-maxlength="64"
                                            required>
                        </input>
                    </div>
                </div>


                <div class="form-group">
                    <label for="category" class="control-label col-sm-3" >* Category:</label>
                        
                    <div class="col-sm-9">
                        <select type='text' ng-model='ctrl.NewEvent.category' 
                                            id="category" 
                                            class="form-control" 
                                            ng-options="c.id as c.category for c in ctrl.categories"
                                            required>
                        </select>
                    </div>
                </div>
                            
                <div class="form-group">
                    <label for="body" class="control-label col-sm-3">Description:</label>
                    <div class="col-sm-9">
                        <textarea ng-model="ctrl.NewEvent.body"
                                    id="body" 
                                    class="form-control" 
                                    rows="5" 
                                    placeholder="Tell people more about the event">
                        </textarea>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="link" class="control-label col-sm-3">Event Link:</label>
                    <div class="col-sm-9">
                        <input type='url' ng-model='ctrl.NewEvent.link' 
                                            id="link" 
                                            class="form-control"
                                            placeholder="http://example.com">
                        </input>
                    </div>
                </div>

                <div class="form-group"> 
                    <div class="col-sm-offset-3 col-sm-9">
                        <input type="submit" class="btn btn-primary" 
                                                value="Add New Event"
                                                ng-disabled="eventForm.$invalid">
                    </div>
                </div>
                
            </form>
        </div><!-- .card -->
    &nbsp
    </div><!-- .col-md-6 -->
    
    <div class="col-md-6">
        <div class="card"  id="column2">
            <div class='well'  style='height:100%; overflow:scroll;'>  
                <div class="panel-group">
                    <div ng-repeat="event in ctrl.events" class="panel" ng-class='ctrl.getEventClass(event)'>
                        <div class="panel-heading">
                            <strong ng-bind='event.date | date: "MMM dd"'></strong> &nbsp <span ng-bind='event.title'></span>
                            <div class="pull-right">
                                <button type="button" class="btn btn-default btn-xs" ng-click="ctrl.editPost(event)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                <button type="button" class="btn btn-default btn-xs" ng-click="ctrl.deletePost(event.id)"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </div>
                </div><!-- .panel-group -->
            </div><!-- .well -->
            
            <!-- Button trigger modal -->
            <div class="modal fade" id="myEditForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Edit Event</h4>
                    </div>
                        <form ng-submit="ctrl.updateEvent(ctrl.editForm.id)" class="form-horizontal" 
                                name="editForm" novalidate>
                            <div class="modal-body">
                                    <div class="form-group">
                                        <label for="title" class="control-label col-sm-3">* Title:</label> 
                                        <div class="col-sm-9">
                                            <input type='text' ng-model='ctrl.editForm.title' 
                                                                id="title"
                                                                class="form-control" 
                                                                placeholder="Add a short, clear name"
                                                                maxlength="64"
                                                                required>
                                            </input>                                   
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="date" class="control-label col-sm-3">* Time:</label>
                                        <div class="col-sm-3">
                                            <input ng-model="ctrl.editForm.date" id="date" 
                                                    placeholder="Date" 
                                                    class="form-control"
                                                    ng-pattern="/^[0-9\-]+$/" 
                                                    ng-minlength="10"
                                                    ng-maxlength="10"
                                                    required>
                                            </input>
                                        </div>
                                        <div class="col-xs-6 col-sm-3">
                                            <input ng-model='ctrl.editForm.start' 
                                                    placeholder="Start time" 
                                                    class="form-control" 
                                                    ng-pattern="/^[0-9:]+$/" 
                                                    ng-minlength="5"
                                                    ng-maxlength="5"
                                                    required>
                                            </input>
                                        </div>
                                        <div class="col-xs-6 col-sm-3">
                                            <input ng-model='ctrl.editForm.end' 
                                                    placeholder="End Time" 
                                                    class="form-control"
                                                    ng-pattern="/^[0-9:]+$/" 
                                                    ng-minlength="5" 
                                                    ng-maxlength="5" 
                                                    required>
                                            </input>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="location" class="control-label col-sm-3" >* Location:</label>
                                            
                                        <div class="col-sm-9">
                                            <input type='text' ng-model='ctrl.editForm.location' 
                                                                id="location" 
                                                                class="form-control"
                                                                placeholder="Include a place or address" 
                                                                ng-maxlength="64"
                                                                required>
                                            </input>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="category" class="control-label col-sm-3" >* Category:</label>
                                            
                                        <div class="col-sm-9">
                                            <select type='text' ng-model='ctrl.editForm.category_id' 
                                                                id="category" 
                                                                class="form-control" 
                                                                ng-options="c.id as c.category for c in ctrl.categories"
                                                                required>
                                            </select>
                                        </div>
                                    </div>
                                                
                                    <div class="form-group">
                                        <label for="body" class="control-label col-sm-3">Description:</label>
                                        <div class="col-sm-9">
                                            <textarea ng-model="ctrl.editForm.body"
                                                        id="body" 
                                                        class="form-control" 
                                                        rows="5" 
                                                        placeholder="Tell people more about the event">
                                            </textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="link" class="control-label col-sm-3">Event Link:</label>
                                        <div class="col-sm-9">
                                            <input type='url' ng-model='ctrl.editForm.link' 
                                                                id="link" 
                                                                class="form-control"
                                                                placeholder="http://example.com">
                                            </input>
                                        </div>
                                    </div>
                            </div><!-- .modal-body -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                <input type="submit" class="btn btn-primary" 
                                                                    value="Save Changes"
                                                                    ng-disabled="editForm.$invalid">
                            </div><!-- .modal-footer -->
                        </form>
                    </div>
                </div>
            </div><!-- Modal -->
        </div><!-- .card -->
    </div><!-- .col-md-6 -->
</div>

@endsection

@section('javascript')
<script src="/js/app/controllers/postController.js"></script>
<script src="/js/equalColumn.js"></script>
@endsection