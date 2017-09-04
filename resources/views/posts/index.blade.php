@extends('main')

@section('title','| All Posts')

@section('content')

    <div class='row'>
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                <h1>All Events</h1>

                <hr>

                <div class='row'>
                    {!! Html::linkRoute('posts.create', 'Create New', array(), array('class' => 'btn btn-lg btn-primary btn-block')) !!}
                    &nbsp

                    <div class='col-md-12'>
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
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection