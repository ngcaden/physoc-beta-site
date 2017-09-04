@extends('main')

@section('title', '| Categories')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                <h1>Categories</h1>
                <hr>    
                
                {!! Form::open(['route' => 'categories.store', 'method' => 'POST']) !!}
                <div class="input-group" >
                    {{ Form::text('name', null, ['class' => 'form-control']) }}
                    <span class="input-group-btn">{{ Form::submit('+', ['class' => 'btn btn-basic ßbtn-default']) }}</span>
                </div>
                {!! Form::close() !!}

                &nbsp
                
                <table class="table">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Category Name</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($categories as $category)
                        <tr>
                            <th>{{ $category->id }}</th>
                            <td>{{ $category->name }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            &nbsp
        </div>
    </div>


@endsection