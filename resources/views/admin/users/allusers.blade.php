@extends('admin.layouts')
@section('content')
    <div class="container my-5"> 
        <h1>All Users</h1>

        <div class="row">
            <table id="myTable" class="display">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        
                        <th>Active Bookings</th>
                        <th>Joined At</th>
                        <th>Suspend</th>
                        <th>Contact</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $counter = 1; ?>
                    
                    @foreach ($users as $item)
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

                            <td>{{$item->bookings->count()}}</td>

                            <td>{{$item->created_at->format('F j, Y')}}</td>

                            @if ($item->isSuspended == true)
                            <td><a class="btn btn-warning" href="/admin/user/unsuspend/{{$item->id}}">Un Suspend</a></td>
                            @else
                            <td><a class="btn btn-warning" href="/admin/user/suspend/{{$item->id}}">Suspend</a></td> 
                            @endif

                            
                            <td><button class="btn btn-success fs-6" data-toggle="modal" data-target="#exampleModal">Messege</button></td>
                            <td><a href="/admin/user/delete/{{$item->id}}" class="btn btn-danger">Delete</a></td>
                        </tr>
                        <?php $counter++; ?>
                    @endforeach
                        
                    
                    
                </tbody>
            </table>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Send Messege</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <form action="{{route('sendmessege')}}" method="POST">
                        @csrf
                        <div class="modal-body">
                            
                                <label for="contact" class="form-label">Enter contact address</label>
                                <input type="text" class="form-control" placeholder="Enter phone/email" name="contactaddress">
                                <label class="form-label my-2" for="messege">Enter Messege</label>
                                <textarea class="form-control" rows="5" type="text" name="messege" placeholder="Enter Messege"></textarea>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Send</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
       
    </div>
@endsection