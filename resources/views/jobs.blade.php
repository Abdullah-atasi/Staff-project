@extends('main')
@section('title')
    Homework Page
@endsection

@section('content')
@if (Session::has('success'))
    <div class="alert alert-success" role="alert">{{Session::get('success')}}</div>
@endif
<p style="text-align: center">
    <a href="{{route('languageConverter','ar')}}">AR</a>
    <a href="{{route('languageConverter','en')}}">EN</a>
</p>
<p>
    <a href="{{route('createjob')}}" 
    style="margin: 50px;color: white" class="btn btn-sm btn-success">
    {{__('mycustom.addnew')}}</a>
</p>
<div class="col-md-4">
    <input type="text" id="searchbyjobname" class="form-control" 
    placeholder="search by job name">
    <br>
</div>
<div id="ajax_search_result">
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">First</th>
        <th scope="col">Acitve</th>
        <th>Acitve</th>
        <th>photo</th>
      </tr>
    </thead>
    <tbody>
    @if (!@empty($data))
     @php
         $i=1;
     @endphp
        @foreach ($data as $info)
            <tr>
            <td>{{$i}}</td>
            <td>{{$info->name}}</td>
            <td>@if ($info->active==1)
                enable
            @else
                disable
            @endif</td>
            <td>
                <a href="{{route('editjob',$info->id)}}" class="btn btn-sm btn-danger" style="color: white">edit</a>
                <a href="{{route('deltejob',$info->id)}}" class="btn btn-sm btn-danger" style="color: white">delete</a>
            </td>
            <td>
                @if(!@empty($info->file))
                    @foreach ($info->files as $file)
                <img src="uploads/{{$info->photo}}" style="width:50px;height:50px" alt="">
                @endforeach
                @endif
            </td>
            </tr>
        @php         $i++;     @endphp
        @endforeach     
        @else
            
        @endif
    </tbody>
  </table>
<br>
{{$data->links()}}
</div>
@endsection
@section('script')
    <script>
         $(document).ready(function(){
             $(document).on('input','#searchbyjobname',function(){
                var searchbyjobname=$(this).val();
                alert(searchbyjobname);
                jQuery.ajax({
                    url:"{{route('ajax_search_job')}}",
                    type:'post',
                    datatype:'html',
                    chache:false,
                    data:{searchbyjobname:searchbyjobname,'_token':"{{csrf_token()}}"}
                    success:function(data){
                        $('#ajax_search_result').html(data);
                    }
                    error:function(data){
                        
                    }
                });
                $(document).on('click','#ajax_search_pagination a',function(e){
                    e.preventDefault();
                    var searchbyjobname=$(this).val();
                    jQuery.ajax({
                    url:$(this).attr('href'),
                    type:'post',
                    datatype:'html',
                    chache:false,
                    data:{searchbyjobname:searchbyjobname,'_token':"{{csrf_token()}}"}
                    success:function(data){
                        $('#ajax_search_result').html(data);
                    }
                    error:function(data){
                    }
                });
            });
        }); 
     });
    </script>
@endsection
 