@extends('main')

@section('title','| All Posts')

@section('content')

<div class='row' ng-app='postApp'>
    <div class="col-md-8 col-md-offset-2">
        <div class="card"ng-controller='ListCtrl as ctrl'>
            <h1>All Events</h1>

            <hr>

            <div class='row'>

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
                
                &nbsp

                {{--  <div class='col-md-12'>
                    <table class='table'>
                        <thead>
                            <th>Title</th>
                            <th>Location</th>
                            <th>Category</th>
                            <th>Timing</th>
                            <th></th>
                        </thead>

                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ substr(strip_tags($post->location),0,50) }}{{ strlen(strip_tags($post->body)) >50 ? '...' : '' }}</td>
                                    <td>{{ $post->category->name }}</td>
                                    <td>{{ date('M j, Y H:i', strtotime($post->timing)) }}</td>
                                    <td>{!! Html::linkRoute('posts.show', 'View', array($post->id), array('class' => 'btn btn-sm btn-default')) !!} {!! Html::linkRoute('posts.edit', 'Edit', array($post->id), array('class' => 'btn btn-sm btn-default')) !!} {!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'DELETE', 'style' => "display: inline;"]) !!}{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}{!! Form::close() !!}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>  --}}
                <div class='well'>
                    <div class="panel-group">
                        <div ng-repeat="event in ctrl.events" class="panel" ng-class='ctrl.getEventClass(event)'>
                            <div class="panel-heading">
                                <a data-toggle="collapse" href="#collapse@{{event.id}}">
                                    <strong ng-bind='event.date | date: "MMM dd"'></strong> &nbsp <span ng-bind='event.title'></span>
                                </a>
                                <button type="button" class="pull-right btn btn-danger btn-xs" ng-click="ctrl.deletePost(event.id)"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                            </div>
                            
                            <div id="collapse@{{event.id}}" class="panel-collapse collapse"> 
                                <div class="panel-body">
                                    {{--  <form>
                                        <label for="body">Description:</label>
                                        <textarea ng-show="event.body" ng-model="event.body" class="form-control" id="body"></textarea>

                                        <label for="location">Location:</label> 
                                        <input type='text' ng-model='event.location' id="location" class="form-control"></input>

                                        <label for="date">Date:</label>
                                        <input type="date" ng-model="event.date | date:'yyyy-MM-dd'" id="date" class="form-control" placeholder="yyyy-MM-dd" required></input>

                                        <label for:"timestart">Time start:</label> 
                                        <input ng-model='event.start' id="timestart" class="form-control" required></input>
                                        <label for:"timeend">Time start:</label> 
                                        <input ng-model='event.end' id="timeend" class="form-control" required></input>
                                        
                                        <label for:"link">Event link:</label> 
                                        <input type='text'  ng-model='event.link' id="link" class="form-control"></input>
                                    </form>      --}}
                                    

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')
<script src="/js/app/controllers/postController.js"></script>
@endsection