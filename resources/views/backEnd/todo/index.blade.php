@extends('backLayout.app')
@section('title')
Todo
@stop

@section('content')

    <h1>Todo <a href="{{ url('todo/create') }}" class="btn btn-primary pull-right btn-sm">Add New Todo</a></h1>
    <div class="table table-responsive">
        <table class="table table-bordered table-striped table-hover" id="tbltodo">
            <thead>
                <tr>
                    <th>ID</th><th>Title</th><th>Description</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($todo as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td><a href="{{ url('todo', $item->id) }}">{{ $item->title }}</a></td><td>{{ $item->description }}</td>
                    <td>
                        <a href="{{ url('todo/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs">Update</a> 
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['todo', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $('#tbltodo').DataTable({
            columnDefs: [{
                targets: [0],
                visible: false,
                searchable: false
                },
            ],
            order: [[0, "asc"]],
        });
    });
</script>
@endsection