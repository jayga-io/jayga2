<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <title>Jayga | My Bookings</title>
</head>

<body>
    @include('navbar')
    <div class="container rounded bg-white mt-5 mb-5">

        @if (session()->has('messege'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session()->get('messege') }}</strong>

            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h2>My Bookings</h2>

        @if (count($listings) > 0)
            <div class="container px-5" style="overflow-y: scroll; overflow-x:hidden; height: 500px;">
                @foreach ($listings as $item)
                    <div class="card my-5">

                        <div class="card-header d-flex justify-content-between">
                            <p>Status:
                                @if ($item->booking_status == 1)
                                    <span>&#128994; Approved</span>
                                @elseif($item->booking_status == 2)
                                    <span>&#128308; Denied</span>
                                @elseif($item->booking_status == 0)
                                    <span>&#128993; Pending</span>
                                @endif


                            </p>
                            <p>{{ $item->created_at->diffForHumans() }}</p>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-4 border-right">
                                    <img src="https://new.jayga.io/uploads/{{ $item->listing_images[0]->listing_targetlocation }}"
                                        style="width: 100%; height:100%; object-fit:contain" alt="">
                                </div>
                                <div class="col-md-5 border-right">
                                    <h5>{{ $item->listings->listing_title }}</h5>
                                    <p class="my-5">Booking ID: <span>{{ $item->booking_id }}</span></p>
                                    <div>
                                        <p>{{ $item->total_members }} Guests</p>
                                        <p>Checkin : <span>{{ $item->date_enter }}</span> | <span>Checkout:
                                                <span>{{ $item->date_exit }}</span></span></p>
                                    </div>
                                    <a class="btn btn-success my-3"
                                        href="/client/single-listing/{{ $item->listings->listing_id }}">Review
                                        Listing</a>
                                    @if ($item->booking_status == 2)
                                        <button class="btn btn-success my-3" data-bs-toggle="modal"
                                            data-bs-target="#staticBackdrop">Claim Refund</button>
                                    @endif
                                </div>
                                <div class="col-md-3 d-flex my-5">
                                    <div class="mx-3">
                                        <p>৳ {{ $item->listings->full_day_price_set_by_user }} *
                                            {{ $item->days_stayed }} Nights</p>
                                        <p>Jayga Service fee</p>
                                        <p>Total</p>
                                    </div>
                                    <div class="mx-3">
                                        <p>৳ {{ $item->net_payable }}</p>
                                        <p>3%</p>
                                        <p>৳ {{ $item->pay_amount }}</p>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>


                    <!-- Modal -->
                    <div class="modal fade " id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <form action="{{ route('claimrefund') }}" method="POST">
                                    @csrf
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Refund Request</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">



                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="bank-tab" data-bs-toggle="tab"
                                                    data-bs-target="#home-tab-pane" type="button" role="tab"
                                                    aria-controls="home-tab-pane" aria-selected="true">Bank</button>
                                            </li>

                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="bkash-tab" data-bs-toggle="tab"
                                                    data-bs-target="#bkash-tab-pane" type="button" role="tab"
                                                    aria-controls="bkash-tab-pane" aria-selected="false">Bkash</button>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel"
                                                aria-labelledby="home-tab" tabindex="0">
                                                <div class="alert alert-success p-2">
                                                    <ul>
                                                        <li>Please fill the form carefully to submit a refund request.
                                                            Successfull refund claim usually takes 2-3 working days.
                                                            Please be patient meanwhile.</li>
                                                    </ul>
                                                </div>
                                                <input type="hidden" value="{{ Session::get('user') }}"
                                                    name="user_id">
                                                <input type="hidden" value="{{ $item->lister_id }}" name="lister_id">
                                                <input type="hidden" value="{{ $item->listing_id }}"
                                                    name="listing_id">
                                                <input type="hidden" value="{{ $item->booking_id }}"
                                                    name="booking_id">
                                                <input type="hidden" name="refund_amount"
                                                    value="{{ $item->pay_amount }}">

                                                <label for="bank">Bank Name</label>
                                                <input type="text" name="bank_name" class="form-control mb-3">
                                                <label for="bank">Name on the account</label>
                                                <input type="text" name="acc_name" class="form-control mb-3">
                                                <label for="bank">Account Number</label>
                                                <input type="number" name="acc_number" class="form-control mb-3">
                                                <label for="bank">Routing Number</label>
                                                <input type="text" name="routing_num" class="form-control mb-3">
                                                <label for="bank">Branch Name</label>
                                                <input type="text" name="branch_name" class="form-control mb-3">
                                                <label for="messege">Reason for refund</label>
                                                <textarea name="messege" id="" cols="30" rows="10" class="form-control mb-3"
                                                    placeholder="Please tell us the reason for refund (Optional)"></textarea>
                                            </div>

                                            <div class="tab-pane fade" id="bkash-tab-pane" role="tabpanel"
                                                aria-labelledby="bkash-tab" tabindex="0">
                                                <div class="my-2">
                                                    <input type="hidden" value="{{ Session::get('user') }}"
                                                        name="user_id">
                                                    <input type="hidden" value="{{ $item->lister_id }}"
                                                        name="lister_id">
                                                    <input type="hidden" value="{{ $item->listing_id }}"
                                                        name="listing_id">
                                                    <input type="hidden" value="{{ $item->booking_id }}"
                                                        name="booking_id">
                                                    <input type="hidden" name="refund_amount"
                                                        value="{{ $item->pay_amount }}">
                                                    <label for="bkash" class="form-label">Bkash Number</label>
                                                    <input type="number" name="bkash_num" class="form-control"
                                                        placeholder="Enter your bkash account number">
                                                    <label for="messege">Reason for refund</label>
                                                    <textarea name="messege" id="" cols="30" rows="10" class="form-control mb-3"
                                                        placeholder="Please tell us the reason for refund (Optional)"></textarea>
                                                </div>

                                            </div>

                                        </div>



                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-warning"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>






            <div class="m-3 text-center">

                <a href="{{ route('backroute') }}" class="btn btn-secondary">Back to home</a>
                <a href="{{ route('userdash') }}" class="btn btn-success">Back to Dashboard</a>
            </div>
        @else
            <div class="container mb-5">
                <p>No Bookings Found!</p>
            </div>
            <div class="my-5 text-center">

                <a href="{{ route('backroute') }}" class="btn btn-secondary">Back to home</a>
                <a href="{{ route('userdash') }}" class="btn btn-success">Back to Dashboard</a>
            </div>
        @endif



    </div>


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>
