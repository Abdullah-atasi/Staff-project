@extends('main')

@section('title')
    Add new Fun
@endsection
@section('content')
    
{{-- <form method="POST" action="{{route('updatejob',$data['id'])}}" style="width: 80%; margin:0 auto"> --}}
    <form method="POST" action="{{route('updatejob',$data->id)}}" style="width: 80%; margin:0 auto">
    @csrf
    <div class="form-group">
        <label for="job_name">job name</label>
        <input type="text" class="form-control" id="job_name" name="job_name" 
        {{-- value="{{$data['name']}}"> --}}
        value="{{$data->name}}">
        @error('job_name')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="job_active">active status</label>
        <select name="job_active" id="job_active" class="form-control">
            <option value="">select status</option>
            {{-- <option @if ($data['active']==1) selected @endif value="1">yes</option> --}}
            <option @if ($data->active==1) selected @endif value="1">yes</option>
            <option @if ($data->active==0) selected @endif value="0">no</option>
        </select>
        @error('job_active')
        <span class="text-danger">{{$message}}</span>
    @enderror
    </div>
    <input type="submit" value="Edit job" class="btn btn-primary">
</form>
@endsection