@extends('layouts.app')

@section('content')
<div class="container">
    @if(auth()->user()->role === 'admin')
            <a href="/statistics" class="btn btn-primary mt-5">All Statistics</a>
        @endif
    <h1>Top 10 Users with Highest Task Counts</h1>
    
    <table class="table">
        <thead>
            <tr>
                <th>User Id</th> 
                <th>Student Name</th>
                <th>Task Count</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($topUsers as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->assigned_tasks_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function(){
        $('.dropdown-toggle').dropdown();
    });
</script>
@endsection
