@extends('main')

@section('title')
    Add new Fun
@endsection
@section('content')
    
<form action="{{route('storejob')}}" enctype="multipart/form-data"
method="POST"  style="width: 80%; margin:0 auto">
    @csrf
    <div class="form-group">
        <label for="job_name">job name</label>
        <input type="text" class="form-control" id="job_name" name="job_name">
        @error('job_name')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="job_active">active status</label>
        <select name="job_active" id="job_active" class="form-control">
            <option value="">select status</option>
            <option value="1">yes</option>
            <option value="0">no</option>
        </select>
        @error('job_active')
        <span class="text-danger">{{$message}}</span>
    @enderror
    </div>
    <div class="form-group">
        <label for="job_name">jobs logo</label>
        <input type="file" class="form-control" name="photo[]" multiple id="photo">
        @error('photo')
          <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <input type="submit" value="Add job" class="btn btn-primary">
</form>
@endsection