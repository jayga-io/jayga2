<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <title>Jayga | Booking Management</title>
    <style>
        .nav-link {
            color: #139175;
            font-size: medium;
            font-weight: 700;
        }

        .card:hover {
            opacity: 1;
            transition: 0.5s;
            transform: scale(1.1);

        }
    </style>
</head>

<body>
    <div class="container">
        @include('host.nav')
    </div>

    <div class="container">
        <div class="p-3 mb-4 bg-light rounded-3">
            <div class="container-fluid py-4">
                <h1 class="display-5 fw-bold"><i class="bi bi-calendar3"></i> Manage Bookings</h1>
                <p class="col-md-8 fs-4">Manage all your bookings, see pendings & more...</p>
                <a class="btn btn-warning btn-lg" href="{{ route('userdash') }}" type="button"><i
                        class="bi bi-arrow-left"></i> Return to dashboard</a>
            </div>
        </div>

    </div>


    <div class="container">
        <ul class="nav nav-tabs p-4" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button"
                    role="tab" aria-controls="all" aria-selected="true">All Bookings
                    ({{ $bookings->count() }})</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending" type="button"
                    role="tab" aria-controls="pending" aria-selected="false">Pending Bookings
                    ({{ $pendings->count() }})</button>
            </li>
        </ul>
        <div class="tab-content p-4" id="myTabContent">
            <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
              <div class="row">
                <div class="col-md-12">
                  <table id="myTable" class="display ">
                    <thead>
                        <tr>
                            <th>Name on booking</th>
                            <th>Listing Title</th>

                            <th>phone</th>
                            <th>Number of members</th>
                            <th>Arrival Date</th>
                            <th>Checkout Date</th>
                            <th>Short_stay_slot</th>
                            <th>Short_stay_time</th>
                            <th>Booking Made</th>
                            <th>Pay Amount</th>
                            <th>Jayga_fee</th>
                            <th>Net payable</th>
                            <th>Booking_status</th>
                            <th>Complete</th>
                            <th>Cancel</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $item)
                            <tr>
                                <td>{{ $item->booking_order_name }}</td>
                                <td>{{ $item->listings->listing_title }}</td>

                                <td>{{ $item->phone }}</td>
                                <td>{{ $item->total_members }}</td>
                                <td><span class="badge rounded-pill bg-success" >{{ $item->date_enter }}</span></td>
                                <td><span class="badge rounded-pill bg-danger">{{ $item->date_exit }}</span></td>

                                @if ($item->tier == 0)
                                    <td><span class="badge rounded-pill bg-success">Full Stay</span></td>
                                    <td> <span class="badge rounded-pill bg-danger">No slot selected</span></td>
                                @else
                                    <td>{{ $item->tier }}</td>
                                    <td>{{$item->short_stays[0]->times}}</td>
                                @endif

                                
                                <td>{{ $item->created_at->diffForHumans() }}</td>
                                
                                @if ($item->pay_amount == null)
                                    <td><span class="badge rounded-pill bg-warning">Not paid</span></td>
                                @else
                                    <td>{{ $item->pay_amount }} tk/-</td>
                                @endif

                                <td>6.9%</td>

                                <td>{{$item->pay_amount - ($item->pay_amount * 6.9)/100 }} tk/-</td>

                                @if ($item->booking_status == 1)
                                    <td><span class="badge rounded-pill bg-success">Confirmed</span></td>
                                @endif
                                <td><a class="btn btn-success"
                                        href="/user/booking-complete/{{ $item->booking_id }}/{{$item->pay_amount - ($item->pay_amount * 6.9)/100 }}">Mark Complete</a></td>
                                <td> <a class="btn btn-danger"
                                        href="/user/booking-cancel/{{ $item->booking_id }}">Cancel</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
              </div>
                
            </div>
            <div class="tab-pane fade" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                <table id="myTable2" class="display">
                    <thead>
                        
                            <th>Name on booking</th>
                            <th>Listing Title</th>
                            <th>phone</th>

                            <th>Arrival Date</th>
                            <th>Number of members</th>
                            <th>Checkout Date</th>
                            <th>Payment Status</th>

                            <th>is Approved?</th>
                            <th>Created At</th>
                            <th>Confirm</th>
                            <th>Decline</th>
                        
                    </thead>
                    <tbody>
                        @foreach ($pendings as $item)
                            <tr>
                                <td>{{ $item->booking_order_name }}</td>
                                <td>{{ $item->listings->listing_title }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>{{ $item->date_enter }}</td>
                                <td>{{ $item->total_members }}</td>
                                <td>{{ $item->date_exit }}</td>
                                @if ($item->payment_flag == true)
                                    <td><span class="badge rounded-pill bg-success">Paid</span></td>
                                @else
                                    <td><span class="badge rounded-pill bg-warning">Due</span></td>
                                @endif

                                @if ($item->isApproved == true)
                                    <td><span class="badge rounded-pill bg-success">Approved</span></td>
                                @else
                                    <td><span class="badge rounded-pill bg-warning">Not Approved</span></td>
                                @endif

                                <td>{{ $item->created_at->diffForHumans() }}</td>
                                <td> <a class="btn btn-success"
                                        href="/user/booking-confirm/{{ $item->booking_id }}">Confirm</a> </td>
                                <td><a class="btn btn-warning"
                                        href="/user/booking-deny/{{ $item->booking_id }}">Deny</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>
    </div>

    
    <script>
        let table = new DataTable('#myTable',{
          scrollX: true
        })
    </script>
    <script>
        let table2 = new DataTable('#myTable2')
    </script>
   
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>
