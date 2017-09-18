@extends('main')

@section('title','| Manage Sponsors')

@section('content')

<div class='row' ng-app='sponsorApp' ng-controller='ListCtrl as ctrl'>
    <div class="col-md-6">
        <div class="card"  id="column1">
            <h1>Manage Sponsors</h1>

            <hr>

            <form ng-submit="ctrl.newSponsor()" class="form-horizontal" 
                    name="sponsorForm" novalidate>
                <div class="form-group">
                    <label for="name" class="control-label col-sm-3">* Name:</label> 
                    <div class="col-sm-9">
                        <input type='text' ng-model='ctrl.NewSponsor.name' 
                                            id="name"
                                            class="form-control" 
                                            placeholder="Add sponsor's name"
                                            required>
                        </input>                                   
                    </div>
                </div>

                <div class="form-group">
                    <label for="url" class="control-label col-sm-3">* Sponsor URL:</label>
                    <div class="col-sm-9">
                        <input type='url' ng-model='ctrl.NewSponsor.url' 
                                            id="url" 
                                            class="form-control"
                                            placeholder="http://example.com"
                                            required>
                        </input>
                    </div>
                </div>
                            
                <div class="form-group">
                    <label for="description" class="control-label col-sm-3">* Description:</label>
                    <div class="col-sm-9">
                        <textarea ng-model="ctrl.NewSponsor.description"
                                    id="description" 
                                    class="form-control" 
                                    rows="5" 
                                    placeholder="Add sponsor's description"
                                    required>
                        </textarea>
                    </div>
                </div>
                

                <div class="form-group">
                    <label for="logo" class="control-label col-sm-3" >* Logo:</label>
                        
                    <div class="col-sm-9">
                        <input type='text' ng-model='ctrl.NewSponsor.logo' 
                                            id="logo" 
                                            class="form-control"
                                            ng-pattern="/^[a-zA-Z\/\.]+$/" 
                                            placeholder="Insert link to sponsor's logo"
                                            required>
                        </input>
                        
                        <div class="col-sm-12" style="height:100px;padding-left: 0px;padding-right: 0px;">
                            <img class='img-responsive' ng-src= "@{{ ctrl.NewSponsor.logo }}">
                        </div>
                    </div>
                </div>

                
                <div class="form-group"> 
                    <div class="col-sm-offset-3 col-sm-9">
                        <input type="submit" class="btn btn-primary" 
                                                value="Add New Event"
                                                ng-disabled="sponsorForm.$invalid">
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
                    <div ng-repeat="sponsor in ctrl.sponsors" class="panel">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-sm-9">
                                    <strong ng-bind='sponsor.name'></strong>
                                </div>
                                
                                <div class="col-sm-3">
                                    <div class="pull-right">
                                        <button type="button" class="btn btn-default btn-xs" ng-click="ctrl.editSponsor(sponsor)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                        <button type="button" class="btn btn-default btn-xs" ng-click="ctrl.deleteSponsor(sponsor.id)"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                                <div class="col-sm-8 col-sm-offset-2">
                                    <img class='img-responsive' ng-src= "@{{ sponsor.logo }}">
                                </div>
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
                        <h4 class="modal-title" id="myModalLabel">Edit Sponsor</h4>
                    </div>
                    <form ng-submit="ctrl.updateSponsor(ctrl.EditForm.id)" class="form-horizontal" 
                                name="editForm" novalidate>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name" class="control-label col-sm-3">* Name:</label> 
                                <div class="col-sm-9">
                                    <input type='text' ng-model='ctrl.EditForm.name' 
                                                        id="name"
                                                        class="form-control" 
                                                        required>
                                    </input>                                   
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="url" class="control-label col-sm-3">* Sponsor URL:</label>
                                <div class="col-sm-9">
                                    <input type='url' ng-model='ctrl.EditForm.url' 
                                                        id="url" 
                                                        class="form-control"
                                                        required>
                                    </input>
                                </div>
                            </div>
                                        
                            <div class="form-group">
                                <label for="description" class="control-label col-sm-3">* Description:</label>
                                <div class="col-sm-9">
                                    <textarea ng-model="ctrl.EditForm.description"
                                                id="description" 
                                                class="form-control" 
                                                rows="5" 
                                                required>
                                    </textarea>
                                </div>
                            </div>
                            

                            <div class="form-group">
                                <label for="logo" class="control-label col-sm-3" >* Logo:</label>
                                    
                                <div class="col-sm-9">
                                    <input type='text' ng-model='ctrl.EditForm.logo' 
                                                        id="logo" 
                                                        class="form-control"
                                                        ng-pattern="/^[a-zA-Z\/\.]+$/"
                                                        required>
                                    </input>
                                </div>
                            </div>

                            <img class='img-responsive' ng-src= "@{{ ctrl.EditForm.logo }}">
                        </div><!-- .modal-body -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary" 
                                                value="Save Changes"
                                                ng-disabled="editForm.$invalid"></input>
                        </div><!-- .modal-footer -->
                    </form>
                </div>
            </div><!-- Modal -->
        </div><!-- .card -->
    </div><!-- .col-md-6 -->
</div>

@endsection

@section('javascript')
<script src="/js/app/controllers/sponsorController.js"></script>
<script src="/js/equalColumn.js"></script>
@endsection