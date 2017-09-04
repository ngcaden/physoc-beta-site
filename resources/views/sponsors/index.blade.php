@extends('main')

@section('title','| All Sponsors')

@section('content')
    <div class='row'>
        <div class='col-sm-10'>
            <h1>All Sponsors</h1>
        </div>
        <div class='col-sm-2'>
            {!! Html::linkRoute('sponsors.create', 'Add', array(), array('class' => 'btn btn-lg btn-primary btn-block')) !!}
        </div>
    </div>

    <div class='row'>
        <div class='col-md-12'>
            <table class='table'>
                <thead>
                    <th>Name</th>
                    <th>URL</th></th>
                    <th>Logo</th>
                    <th></th>
                </thead>

                <tbody>
                    @foreach ($sponsors as $sponsor)
                        <tr>
                            <td>{{ $sponsor->name }}</td>
                            <td><a href="{{ $sponsor->url }}" target="_blank">{{ $sponsor->url }}</a></td>
                            <td>{{ $sponsor->logo }}</td>
                            <td>{!! Html::linkRoute('sponsors.edit', 'Edit', array($sponsor->id), array('class' => 'btn btn-sm btn-default')) !!} {!! Form::open(['route' => ['sponsors.destroy', $sponsor->id], 'method' => 'DELETE', 'style' => "display: inline;"]) !!}{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}{!! Form::close() !!}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection