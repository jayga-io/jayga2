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
    <title>Jayga | Manage your listing</title>
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
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="#">
                    <h2><img class="px-3" style="float: right;" src="{{ asset('assets/img/logo/Jayga Logo-02.png') }}"
                            width="100" height="80" alt="logo" /></h2>

                </a>
                <div class="collapse navbar-collapse px-5 " id="navbarTogglerDemo03">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="#">Explore</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">List your home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-disabled="true">Help Center</a>
                        </li>

                    </ul>

                    <div class="dropdown">
                        <a href="#" class="btn btn-warning dropdown-toggle" type="button"
                            id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>

                        </ul>
                    </div>

                </div>
            </div>
        </nav>
    </div>

    <div class="container">
        <div class="p-3 mb-4 bg-light rounded-3">
            <div class="container-fluid py-4">
                <h1 class="display-5 fw-bold"><i class="bi bi-calendar3"></i> Manage Listings</h1>
                <p class="col-md-8 fs-4">Manage all your listings</p>
                <a class="btn btn-warning btn-lg" href="{{ route('userdash') }}" type="button"><i
                        class="bi bi-arrow-left"></i> Return to dashboard</a>
            </div>
        </div>

    </div>


    <div class="container">
        <ul class="nav nav-tabs p-4" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button"
                    role="tab" aria-controls="all" aria-selected="true">All Listings
                    ({{ $listings->count() }})</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending" type="button"
                    role="tab" aria-controls="pending" aria-selected="false">Inactive Listings
                    ({{ $inactives->count() }})</button>
            </li>
        </ul>
        <div class="tab-content p-4" id="myTabContent">
            <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                <table id="myTable" class="display">
                    <thead>
                        <tr>
                            <th>Lister Name</th>

                            <th>Listing Title</th>
                            <th>Number of guest allowed</th>
                            <th>Full Day Price</th>
                            <th>Listing Address</th>
                            <th>Short Stay Allow</th>
                            <th>Listing Type</th>
                            <th>Approval Status</th>
                            <th>Active Status</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listings as $item)
                            <tr>
                                <td>{{ $item->lister_name }}</td>
                                <td>{{ $item->listing_title }}</td>
                                <td>{{ $item->guest_num }}</td>
                                <td>{{ $item->full_day_price_set_by_user }} tk/-</td>
                                <td>{{ $item->listing_address }}</td>
                                @if ($item->allow_short_stay == true)
                                    <td><span class="badge rounded-pill bg-success">Allowed</span></td>
                                @else
                                    <td><span class="badge rounded-pill bg-danger">Not Allowed</span></td>
                                @endif

                                <td>{{ $item->listing_type }}</td>

                                @if ($item->isApproved == true)
                                    <td><span class="badge rounded-pill bg-success">Approved</span></td>
                                @else
                                    <td><span class="badge rounded-pill bg-warning">Not Approved</span></td>
                                @endif

                                @if ($item->isActive == true)
                                    <td><span class="badge rounded-pill bg-success">Active</span></td>
                                @else
                                    <td><span class="badge rounded-pill bg-secondary">Inactive</span></td>
                                @endif
                                
                                <td><a href="/user/listing/single-item/{{$item->listing_id}}" class="btn btn-success">Edit</a></td>
                                <td><a href="/user/delete/listing/{{$item->listing_id}}" class="btn btn-warning">Delete</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                <table id="myTable2" class="display">
                    <thead>
                        <tr>
                            <th>Lister Name</th>

                            <th>Listing Title</th>
                            <th>Number of guest allowed</th>
                            <th>Full Day Price</th>
                            <th>Listing Address</th>
                            <th>Short Stay Allow</th>
                            <th>Listing Type</th>
                            <th>Approval Status</th>
                            <th>Active Status</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inactives as $item)
                            <tr>
                                <td>{{ $item->lister_name }}</td>
                                <td>{{ $item->listing_title }}</td>
                                <td>{{ $item->guest_num }}</td>
                                <td>{{ $item->full_day_price_set_by_user }} tk/-</td>
                                <td>{{ $item->listing_address }}</td>
                                @if ($item->allow_short_stay == true)
                                    <td><span class="badge rounded-pill bg-success">Allowed</span></td>
                                @else
                                    <td><span class="badge rounded-pill bg-danger">Not Allowed</span></td>
                                @endif

                                <td>{{ $item->listing_type }}</td>

                                @if ($item->isApproved == true)
                                    <td><span class="badge rounded-pill bg-success">Approved</span></td>
                                @else
                                    <td><span class="badge rounded-pill bg-warning">Not Approved</span></td>
                                @endif

                                @if ($item->isActive == true)
                                    <td><span class="badge rounded-pill bg-success">Active</span></td>
                                @else
                                    <td><span class="badge rounded-pill bg-secondary">Inactive</span></td>
                                @endif
                                
                                <td><a href="/user/listing/single-item/{{$item->listing_id}}" class="btn btn-success">Edit</a></td>
                                <td><a href="#" class="btn btn-warning">Delete</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>
    </div>

    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        let table = new DataTable('#myTable');
    </script>
    <script>
        let table2 = new DataTable('#myTable2');
    </script>
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
