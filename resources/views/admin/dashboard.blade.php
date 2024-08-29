@extends('admin.layouts')

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12 mt-5">
                <h3 class="page-title mt-3">Greetings Admin!</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card board1 fill">
                <div class="card-body">
                    <div class="dash-widget-header">
                        <div>
                            <h3 class="card_widget_header">{{ $bookings }}</h3>
                            <h6 class="text-muted">Total Booking</h6>
                        </div>
                        <div class="ml-auto mt-md-3 mt-lg-0"> <span class="opacity-7 text-muted"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewbox="0 0 24 24"
                                    fill="none" stroke="#009688" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-user-plus">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="8.5" cy="7" r="4"></circle>
                                    <line x1="20" y1="8" x2="20" y2="14"></line>
                                    <line x1="23" y1="11" x2="17" y2="11"></line>
                                </svg></span> </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card board1 fill">
                <div class="card-body">
                    <div class="dash-widget-header">
                        <div>
                            <h3 class="card_widget_header">৳ {{ $total }}</h3>
                            <h6 class="text-muted">Earned</h6>
                        </div>
                        <div class="ml-auto mt-md-3 mt-lg-0"> <span class="opacity-7 text-muted"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewbox="0 0 24 24"
                                    fill="none" stroke="#009688" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-dollar-sign">
                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                </svg></span> </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card board1 fill">
                <div class="card-body">
                    <div class="dash-widget-header">
                        <div>
                            <h3 class="card_widget_header">{{ $active_listings }}</h3>
                            <h6 class="text-muted">Active Listings</h6>
                        </div>
                        <div class="ml-auto mt-md-3 mt-lg-0"> <span class="opacity-7 text-muted"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewbox="0 0 24 24"
                                    fill="none" stroke="#009688" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-file-plus">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z">
                                    </path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                    <line x1="12" y1="18" x2="12" y2="12"></line>
                                    <line x1="9" y1="15" x2="15" y2="15"></line>
                                </svg></span> </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card board1 fill">
                <div class="card-body">
                    <div class="dash-widget-header">
                        <div>
                            <h3 class="card_widget_header">{{ $listings }}</h3>
                            <h6 class="text-muted">Listings</h6>
                        </div>
                        <div class="ml-auto mt-md-3 mt-lg-0"> <span class="opacity-7 text-muted"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewbox="0 0 24 24"
                                    fill="none" stroke="#009688" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-globe">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="2" y1="12" x2="22" y2="12"></line>
                                    <path
                                        d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z">
                                    </path>
                                </svg></span> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-3 col-sm-6 col-12">
            <a href="#">
                <div class="card board1 fill">
                    <div class="card-body">
                        <div class="dash-widget-header">
                            <div>
                                <h3 class="card_widget_header">{{ $disabled_listings }}</h3>
                                <h6 class="text-muted">Disabled Listings</h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0"> <span class="opacity-7 text-muted"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewbox="0 0 24 24" fill="none" stroke="#009688" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="2" y1="12" x2="22" y2="12"></line>
                                        <path
                                            d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z">
                                        </path>
                                    </svg></span> </div>
                        </div>
                    </div>
                </div>
            </a>

        </div>

		<div class="col-xl-3 col-sm-6 col-12">
            <a href="#">
                <div class="card board1 fill">
                    <div class="card-body">
                        <div class="dash-widget-header">
                            <div>
                                <h3 class="card_widget_header">{{ $users }}</h3>
                                <h6 class="text-muted">Users</h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0"> <span class="opacity-7 text-muted"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewbox="0 0 24 24" fill="none" stroke="#009688" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="2" y1="12" x2="22" y2="12"></line>
                                        <path
                                            d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z">
                                        </path>
                                    </svg></span> </div>
                        </div>
                    </div>
                </div>
            </a>

        </div>

		<div class="col-xl-3 col-sm-6 col-12">
            <a href="#">
                <div class="card board1 fill">
                    <div class="card-body">
                        <div class="dash-widget-header">
                            <div>
                                <h3 class="card_widget_header">{{ $hosts }}</h3>
                                <h6 class="text-muted">Hosts</h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0"> <span class="opacity-7 text-muted"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewbox="0 0 24 24" fill="none" stroke="#009688" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="2" y1="12" x2="22" y2="12"></line>
                                        <path
                                            d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z">
                                        </path>
                                    </svg></span> </div>
                        </div>
                    </div>
                </div>
            </a>

        </div>

		<div class="col-xl-3 col-sm-6 col-12">
            <a href="#">
                <div class="card board1 fill">
                    <div class="card-body">
                        <div class="dash-widget-header">
                            <div>
                                <h3 class="card_widget_header">{{ $pending_inventories }}</h3>
                                <h6 class="text-muted">Pending Inventories</h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0"> <span class="opacity-7 text-muted"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewbox="0 0 24 24" fill="none" stroke="#009688" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="2" y1="12" x2="22" y2="12"></line>
                                        <path
                                            d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z">
                                        </path>
                                    </svg></span> </div>
                        </div>
                    </div>
                </div>
            </a>

        </div>


		<div class="col-xl-3 col-sm-6 col-12">
            <a href="#">
                <div class="card board1 fill">
                    <div class="card-body">
                        <div class="dash-widget-header">
                            <div>
                                <h3 class="card_widget_header">{{ $accepted_inventories }}</h3>
                                <h6 class="text-muted">Accepted Inventories</h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0"> <span class="opacity-7 text-muted"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewbox="0 0 24 24" fill="none" stroke="#009688" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="2" y1="12" x2="22" y2="12"></line>
                                        <path
                                            d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z">
                                        </path>
                                    </svg></span> </div>
                        </div>
                    </div>
                </div>
            </a>

        </div>
    </div>


    <div>
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12 mt-5">
                    <h3 class="page-title mt-3">Earnings</h3>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <table id="myTable" class="display">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>invoice_number</th>
                            <th>Listing ID</th>
                            <th>Booking ID</th>
                            <th>Listing Fee</th>
                            <th>Booking Fee</th>
                            <th>Total</th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php $counter = 1; ?>
                        @foreach ($tk as $item)
                            <tr>
                                <td>{{ $counter }}</td>
                                <td>{{ $item->invoice }}</td>
                                <td>{{ $item->listing_id }}</td>
                                <td>{{ $item->booking_id }}</td>
                                <td>৳ {{ $item->listing_fee }}</td>
                                <td>৳ {{ $item->booking_fee }}</td>


                                <td>৳ {{ $item->total }}</td>





                            </tr>
                            <?php $counter++; ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
