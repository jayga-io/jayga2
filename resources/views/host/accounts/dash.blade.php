<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;800;900&family=Raleway:wght@100;300;600;800&display=swap" rel="stylesheet" /> 

<link href="https://fonts.googleapis.com/css2?family=Overpass+Mono:wght@300;400&display=swap" rel="stylesheet" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    
<title>Jayga | Accounts Center</title>
    <style>
      .nav-link{
          color: #139175;
          font-size: medium;
          font-weight: 700;
        }
        .wrapper {
            width: 100%;
            height: 100%;
            display: grid;
            place-items: center;
            background: #2b2d2f;
        }

.title {
  text-align: center;
  margin-top: 55px;
  color: #fff;
  font-size: 25px;
}

.card-debit {
  position: relative;
  width: 100%;
  height: 188px;
  padding: 12px;

  display: flex;
  flex-direction: column;
  justify-content: space-between;

  border-radius: 16px;
  border: solid 4px rgba(255, 255, 255, 0.1);

  background-image: url("https://products.ls.graphics/mesh-gradients/images/78.-Night-sky.jpg");
  background-position: center;
  background-size: cover;

  box-shadow: rgba(255, 255, 255, 0.25) 0px 54px 55px,
    rgba(255, 255, 255, 0.12) 0px -12px 30px,
    rgba(255, 255, 255, 0.12) 0px 4px 6px,
    rgba(255, 255, 255, 0.17) 0px 12px 13px,
    rgba(255, 255, 255, 0.09) 0px -3px 5px;
}

h1 {
  font-size: 20px;
}

h2 {
  font-size: 16px;
}

h3 {
  font-size: 11px;
}

p {
  font-size: 8px;
}

section {
  display: flex;
  flex-direction: column;
  gap: 4px;
}

.top,
.bottom {
  width: 100%;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.top img {
  width: 20px;
}

.brand {
  height: 20px;
  mix-blend-mode: overlay;
}

.infos {
  display: flex;
  flex-direction: column;
  gap: 16px;
}

.infos--bottom {
  display: flex;
  gap: 20px;
}

.card-number {
  display: flex;
  flex-direction: column;
  gap: 4px;
}

      
    </style>
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-body-tertiary" >
            <div class="container-fluid">
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <a class="navbar-brand d-flex align-items-center" href="#">
                <img class="px-3" style="float: right;" src="{{asset('assets/img/logo/Jayga Logo-02.png')}}" width="100" height="80" alt="logo"/>
                <span class="">Accounts Center</span class="">
              </a>
              <div class="collapse navbar-collapse px-5 " id="navbarTogglerDemo03">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="{{route('userdash')}}">Dashboard</a>
                  </li>
                  
                  <li class="nav-item">
                    <a class="nav-link" aria-disabled="true">Help Center</a>
                  </li>
                  
                </ul>
               
                <div class="dropdown">
                  <a href="#" class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-circle"></i>
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="{{route('userprofile')}}">Profile</a></li>
                    <li><a class="dropdown-item" href="{{route('logout')}}">Logout</a></li>
                    
                  </ul>
                </div>
                
              </div>
            </div>
          </nav>
    </div>

  <div class="container mt-5">
    <div class="row">
        <div class="col-sm-12 col-md-4">
          <div class="card text-white rounded-3 bg-success py-2" style="height: 100%;">
            <div class="card-body">
              <h5 class="card-title">My Earnings</h5>
              @if (count($details) == 0)
                  <h4 class="card-title">0.00 ৳</h4>
              @else
                  <h4 class="card-title">{{$details[0]->earnings}} ৳</h4>
              @endif
              
              
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-md-4">
          <div class="card text-white rounded-3 bg-success py-2" style="height: 100%;">
            <div class="card-body">
              <h5 class="card-title">Total Withdrawn</h5>
            @if (count($details) == 0)
              <h4 class="card-title">0.00 ৳</h4>
            @else
                <h4 class="card-title">{{$details[0]->withdraws}} ৳</h4>
            @endif
              
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-md-4">
          <div class="card text-white rounded-3 bg-success py-2" style="height: 100%;">
            <div class="card-body ">
                <div class="d-flex justify-content-between">
                    <h5 class="card-title">Remaining Balance</h5>
                    <a href="#" class="btn btn-warning">Withdraw</a>
                </div>
                @if (count($details) == 0)
                  <h4 class="card-title">0.00 ৳</h4>
              @else
                  <h4 class="card-title">{{$details[0]->earnings - $details[0]->withdraws}} ৳</h4>
              @endif
              
            </div>
          </div>
        </div>
      </div>
  </div>

  <div class="container">
    <div class="p-5 mt-4 mb-4 bg-light rounded-3 d-flex justify-content-between">
      <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold"><i class="bi bi-calendar3"></i> Bank Details</h1>
        
        <button class="btn btn-success btn-lg" type="button"><i class="bi bi-plus"></i>Add Another Bank</button>
      </div>
      <div class="card rounded-5 vh-90" style="width: 70%">
        <div class="card-body">
          <h5 class="card-title">Account Details</h5>
          @if (count($bank) == 0)
              <h2 class="card-text">No Bank Details Found</h2>
          @else
              <div class="card-debit">
            <div class="top">
              <h2>John Doe</h2>
              <img src="https://cdn-icons-png.flaticon.com/512/1436/1436392.png" />
            </div>
            <div class="infos">
              <section class="card-number">
                <p>Card Number</p>
                <h1>5495 9549 2883 2434</h1>
              </section>
              <div class="bottom">
                <aside class="infos--bottom">
                  <section>
                    <p>Expiry date</p>
                    <h3>08/24</h3>
                  </section>
                  <section>
                    <p>CVV</p>
                    <h3>748</h3>
                  </section>
                </aside>
                <aside>
                  
                </aside>
              </div>
            </div>
          </div>
          @endif
          
          
          
        </div>
      </div>

    </div>
    
  </div>

  <div class="container">
   <h2 style="font-size: 30px" class="mb-4">Transaction History</h2>
   <div class="row">
    <div class="col-lg-12">
        <table id="myTable2" class="display p-2">
            <thead>
                <tr>
                    <th>Name on booking</th>
                    <th>email</th>
                    <th>phone</th>
                    <th>Number of members</th>
                    <th>Arrival Date</th>
                    <th>View Details</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>No</td>
                    <td>No</td>
                    <td>No</td>
                    <td>No</td>
                    <td>No</td>
                    <td>No</td>
                    <td>No</td>
                </tr>
                
                
            </tbody>
        </table>
    </div>
   </div>
</div>

    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    
    <script>
        let table2 = new DataTable('#myTable2');
    </script>
	
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>
</html>