@extends('backLayout.app')
@section('title')
Todo
@stop

@section('content')

    <h1>Todo</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID.</th> <th>Title</th><th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $todo->id }}</td> <td> {{ $todo->title }} </td><td> {{ $todo->description }} </td>
                </tr>
            </tbody>    
        </table>
    </div>

@endsection