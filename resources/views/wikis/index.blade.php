@extends('main')

@section('title', '| Wiki')

@section('content')
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="card">    
                <h3 class='text-center'>Sign in with your Imperial account to view this page</h3>

                
                <h1 class="text-center"><i class="fa fa-book" aria-hidden="true"></i> Welcome to the Imperial Physics Wiki!</h1>
                <hr>
                <h3>Choose your subject:</h3>
                
                <div class="container-fluid">	
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
                </div>              
            </div>
        </div>
    </div>
@endsection