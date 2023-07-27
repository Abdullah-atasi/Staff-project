<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">First</th>
        <th scope="col">Acitve</th>
        <th>Acitve</th>
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
            </tr>
        @php         $i++;     @endphp
        @endforeach     
        @else
            
        @endif
    </tbody>
  </table>
<br>
<div id="ajax_search_pagination">
    {{$data->links()}}
</div>