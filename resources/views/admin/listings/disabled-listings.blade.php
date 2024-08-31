@extends('admin.layouts')
@section('content')
    <div class="my-5">
        <div class="row my-3 mx-auto">
            <div class="col-12">
                <h1 class="my-2">Disabled Listings</h1>
                <table id="myTable" class="display">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Lister Name</th>
                            <th>Listing Title</th>
                            <th>Number of guest allowed</th>
                            <th>Full Day Price</th>
                            <th>Listing Address</th>
                            <th>Short Stay Allow</th>
                            <th>Listing Type</th>
                            <th>Approval Status</th>
                            <th>Active Status</th>
                            <th>Total viewed</th>
                            <th>Total Bookings</th>
                            <th>View</th>
                            <th>Disable</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $counter = 1; ?>
                        @foreach ($disabled_listings as $item)
                            <tr>
                                <td>{{ $counter }}</td>
                                <td>{{ $item->lister_name }}</td>
                                <td>{{ $item->listing_title }}</td>
                                <td>{{ $item->guest_num }}</td>
                                <td>{{ $item->full_day_price_set_by_user }} tk/-</td>
                                <td>{{ $item->listing_address }}</td>
                                @if ($item->allow_short_stay == true)
                                    <td><span class="badge rounded-pill bg-success" style="color: white" >Allowed</span></td>
                                @else
                                    <td><span class="badge rounded-pill bg-danger" style="color: white" >Not Allowed</span></td>
                                @endif

                                <td>{{ $item->listing_type }}</td>

                                @if ($item->isApproved == true)
                                    <td><span class="badge rounded-pill bg-success" style="color: white" >Approved</span></td>
                                @else
                                    <td><span class="badge rounded-pill bg-warning" style="color: white">Not Approved</span></td>
                                @endif

                                @if ($item->isActive == true)
                                    <td><span class="badge rounded-pill bg-success" style="color: white">Active</span></td>
                                @else
                                    <td><span class="badge rounded-pill bg-secondary" style="color: white">Inactive</span></td>
                                @endif

                                <td>{{$item->view_count}}</td>
                                <td>{{$item->booking_count}}</td>
                                <td><a href="/admin/view-listing/{{$item->listing_id}}" class="btn btn-warning"><i class="fa fa-eye"></i></a></td>
                                @if ($item->isApproved == false)
                                <td><a href="/admin/enable-listing/{{$item->listing_id}}" class="btn btn-success">Enable</a></td>
                                @else
                                <td><a href="/admin/disable-listing/{{$item->listing_id}}" class="btn btn-warning">Disable</a></td>
                                @endif
                                
                                
                                <td><a href="/admin/delete-listing/{{$item->listing_id}}" class="btn btn-warning">Delete</a></td>
                            </tr>
                            <?php $counter++; ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection