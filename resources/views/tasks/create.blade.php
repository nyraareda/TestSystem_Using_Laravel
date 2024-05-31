@extends('layouts.app')
@section('title',"Add Task")
@section('content')
    <div class="container my-5">
        <h1>Create New Task</h1>
 
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        <form action="/tasks" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">description</label>
                <input class="form-control" id="description" name="description" rows="3" value="{{ old('description') }}">
            </div>
            <div class="mb-3">
                <label for="assigned_to_id" class="form-label">{{ __('Assign To') }}</label>
                <select class="form-control @error('assigned_to_id') is-invalid @enderror" id="assigned_to_id" name="assigned_to_id" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('assigned_to_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                    @endforeach
                </select>
                {{-- @error('assigned_to_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror --}}
            </div>
             <button type="submit" class="btn btn-primary">Add Task</button>
        </form>
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    
    <script>
        $(document).ready(function(){
            $('.dropdown-toggle').dropdown();
        });
    </script>
        @endsection