@extends('admin.layouts')
@section('content')
    <div class="my-5">
        <h1>Feedbacks</h1>
        <div class="row">
            <div class="col-12 my-2">
                    <table id="myTable" class="display">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>User</th>
                            <th>Messege</th>
                            <th>Type</th>
                            <th>Created_at</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $counter = 1; ?>
                        
                            
                            @foreach ($user as $item)
                                <tr>
                                    <td>{{$counter}}</td>
                                    @if($item->user->name == null)
                                        <td>{{$item->user->email}}</td>
                                    @elseif($item->user->email == null)
                                        <td>{{$item->user->phone}}</td>
                                    @else
                                        <td>{{$item->user->name}}</td>
                                    @endif
                                    <td>{{$item->user->name}}</td>
                                    <td>{{$item->note}}</td>
                                    <td>{{$item->type}}</td>
                                    <td>{{$item->created_at->diffForHumans()}}</td>
                                </tr>
                                
                            @endforeach
                            
                        
                        <?php $counter++; ?>
                    </tbody>
                </table>
            </div>
           
        </div>
    </div>
@endsection