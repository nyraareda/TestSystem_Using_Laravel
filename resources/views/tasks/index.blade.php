@extends('layouts.app')

@section('content')
    <div class="container">
        @if(auth()->user()->role === 'admin')
            <a href="/tasks/create" class="btn btn-primary mt-5">Add new Task</a>
        @endif

        @if(auth()->user()->role === 'admin')
            <a href="/statistics" class="btn btn-secondary mt-5">Statistics</a>
        @endif
        
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th> 
                    <th>Title</th>
                    <th>description</th>
                    <th>Stusdent Name</th> 
                    <th>Assigned By</th>
                    <th colspan="3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td>{{ $task->id }}</td>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->description }}</td>
                        <td>{{ $task->assignedTo->name }}</td> 
                        <td>{{ $task->assignedBy->name }}</td>       
                        <td><a href="/tasks/{{ $task->id }}" class="btn btn-success">VIEW</a></td>
                        <td><a href="/tasks/{{ $task->id }}/edit" class="btn btn-warning">EDIT</a></td>
                        <td>
                            <form action="/tasks/{{ $task->id }}" method="POST">
                                @csrf
                                @method("delete")   
                                <button type="submit" class="btn btn-danger">DELETE</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="d-flex justify-content-center">
            {{ $tasks->links() }}
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
        <script>
        $(document).ready(function(){
            $('.dropdown-toggle').dropdown();
        });
    </script>
@endsection
