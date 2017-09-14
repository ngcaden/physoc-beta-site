@extends('main')

@section('title','| All Posts')

@section('content')

<div class='row'>
    <div class="col-md-8 col-md-offset-2">
        <div class="card" ng-app='postApp'>
            <h1>All Events</h1>

            <hr>

            <div class='row'>
                {!! Html::linkRoute('posts.create', 'Create New', array(), array('class' => 'btn btn-lg btn-primary btn-block')) !!}
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
                <div class='well' ng-controller='ListCtrl as ctrl'>
                    <div class="panel-group">
                        <div ng-repeat="event in ctrl.events" class="panel" ng-class='ctrl.getEventClass(event)'>
                            <div class="panel-heading">
                                <a data-toggle="collapse" href="#collapse@{{event.id}}">
                                    <strong ng-bind='event.date | date: "MMM dd"'></strong> &nbsp <span ng-bind='event.title'></span>
                                </a>
                            </div>
                            
                            <div id="collapse@{{event.id}}" class="panel-collapse collapse"> 
                                <div class="panel-body">
                                    <form>
                                        <label for="body">Description:</label>
                                        <textarea ng-show="event.body" ng-model="event.body" class="form-control" id="body"></textarea>

                                        <label for="location">Location:</label> 
                                        <input type='text' ng-model='event.location' id="location" class="form-control"></input>

                                        <label for="date">Date:</label>
                                        <input type='date' ng-model='event.date' id="date" class="form-control" placeholder="yyyy-MM-dd"></input>

                                        <label for:"timestart">Time start:</label> 
                                        <input type='number' ng-model='event.start' id="timestart" class="form-control"></input>
                                        <label for:"timeend">Time start:</label> 
                                        <input type='number' ng-model='event.end' id="timeend" class="form-control"></input>
                                        
                                        <label for:"link">Event link:</label> 
                                        <input type='text'  ng-model='event.link' id="link" class="form-control"></input>
                                    </form>    
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
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
<script src="/js/app/controllers/postController.js"></script>
@endsection