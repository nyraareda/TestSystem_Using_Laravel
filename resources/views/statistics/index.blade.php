@extends('layouts.app')

@section('content')
<div class="container">
        @if(auth()->user()->role === 'admin')
            <a href="/tasks" class="btn btn-primary mt-5">All Tasks</a>
        @endif
    <table class="table">
        <thead>
            <tr>
                <th>ID</th> 
                <th>Student Name</th>
                <th>Task Count</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($statistics as $statistic)
                <tr>
                    <td>{{ $statistic->id }}</td>
                    <td>{{ $statistic->user->name }}</td>
                    <td>{{ $statistic->task_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $statistics->links() }}
    </div>
</div>
<!-- Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Include Bootstrap Bundle -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

<!-- Initialize Bootstrap dropdown -->
<script>
    $(document).ready(function(){
        $('.dropdown-toggle').dropdown();
    });
</script>
@endsection
