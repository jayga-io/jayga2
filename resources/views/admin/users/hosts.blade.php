@extends('admin.layouts')
@section('content')
    <div class="container my-5">
        <h1>All Hosts</h1>

        <div class="row my-3">
            <table id="myTable" class="display">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        
                        <th>Listings Count</th>
                        <th>Joined At</th>
                        <th>View</th>
                        <th>Suspend</th>
                        <th>Contact</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $counter = 1; ?>
                    
                    @foreach ($hosts as $item)
                        <tr>
                            <td>{{$counter}}</td>

                            @if ($item->name == null)
                                <td>No Name</td>
                            @else
                                <td>{{$item->name}}</td>
                            @endif

                            @if ($item->phone == null)
                                <td>No Number</td>
                            @else
                                <td>{{$item->phone}}</td>
                            @endif

                            @if ($item->email == null)
                                <td>No Email</td>
                            @else
                                <td>{{$item->email}}</td>
                            @endif

                            <td>{{$item->listings->count()}}</td>

                            <td>{{$item->created_at->format('F j, Y')}}</td>
                            <td><button class="btn-samll btn-primary">View</button></td>
                            <td><a class="btn-small btn-warning" href="/admin/user/suspend/{{$item->id}}">Suspend</a></td>
                            <td><button class="btn-small btn-success fs-6">Messege</button></td>
                        </tr>
                        <?php $counter++; ?>
                    @endforeach
                        
                    
                    
                </tbody>
            </table>
        </div>
       
    </div>
@endsection