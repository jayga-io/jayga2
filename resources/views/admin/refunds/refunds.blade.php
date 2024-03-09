@extends('admin.layouts')
@section('content')
    <div>
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12 mt-5">
                    <h3 class="page-title mt-3">Refunds</h3>
                    
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <table id="myTable" class="display">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>user_id</th>
                            <th>user_name</th>
                            <th>phone</th>
                            <th>lister_id</th>
                            <th>listing_title</th>
                            <th>listing_id</th>
                            <th>booking_id</th>
                            <th>refund_amount</th>
                            <th>bkash number</th>
                            <th>account_name</th>
                            <th>account_number</th>
                            <th>branch_name</th>
                            <th>routing_num</th>
                            <th>Paid check</th>
                            <th>messege</th>
                            <th>Action</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $counter = 1; ?>
                        @foreach ($refunds as $item)
                            <tr>
                               <td>{{$counter}}</td>
                               <td>{{$item->user_id}}</td>
                               <td>{{$item->user->name}}</td>
                               <td>{{$item->user->phone}}</td>
                               <td>{{$item->lister_id}}</td>
                               <td>{{$item->listing->listing_title}}</td>
                               <td>{{$item->listing_id}}</td>
                               <td>{{$item->booking_id}}</td>
                               <td>৳ {{$item->refund_amount}}</td>
                               @if ($item->bkash == null)
                                   <td>Not Provided</td>
                               @else
                                    <td>{{$item->bkash}}</td>
                               @endif
                              
                               @if ($item->acc_name == null)
                                   <td>Not Provided</td>
                               @else
                                   <td>{{$item->acc_name}}</td>
                               @endif

                               @if ($item->acc_number == null)
                                   <td>Not Provided</td>
                               @else
                                   <td>{{$item->acc_number}}</td>
                               @endif
                               
                               @if ($item->branch_name == null)
                                   <td>Not provied</td>
                               @else
                                   <td>{{$item->branch_name}}</td>
                               @endif
                               
                               @if ($item->routing_num == null)
                                   <td>Not Provided</td>
                               @else
                                   <td>{{$item->routing_num}}</td>
                               @endif
                               
                               @if ($item->isPaid == false)
                                   <td><span class="badge rounded-pill bg-warning">Pending</span></td>
                               @else
                                   <td><span class="badge rounded-pill bg-success">Paid</span></td>
                               @endif

                               @if ($item->messege == null)
                                   <td>Not Provided</td>
                               @else
                                   <td>{{$item->messege}}</td>
                               @endif
                               
                               @if ($item->isPaid == true)
                                    <td><a href="/admin/refund-complete/{{$item->id}}" class="btn btn-success" aria-disabled="true">Mark Paid</a></td>
                               @else
                                    <td><a href="/admin/refund-complete/{{$item->id}}" class="btn btn-success">Mark Paid</a></td>
                               @endif
                              
                               <td><a href="/admin/delete/refund/{{$item->id}}" class="btn btn-warning">Delete</a></td>
                            </tr>
                            <?php $counter++; ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection