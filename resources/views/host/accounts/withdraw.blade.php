<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
	
    
    <title>Jayga | Accounts Center</title>
    <style>
      .nav-link{
          color: #139175;
          font-size: medium;
          font-weight: 700;
        }

      .card:hover{
          opacity: 1;
            transition: 0.5s;
            transform:scale(1.1);
            
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
              <a class="navbar-brand d-flex align-items-center" href="{{route('userdash')}}">
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
    @if(session()->has('Notice'))
					
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<strong>{{ session()->get('Notice') }}</strong>
						
					</div>
					
					
					@endif

         
    <div class="row">
        <div class="col-lg-6 col-md-12 mx-auto">
            <div class="card mb-4 rounded-5" >
                <div class="card-body">
                  <h5 class="card-title">Remaining Balance</h5>
                  @if (count($balance) == 0)
                    <h4 class="card-title">0.00 ৳</h4>
                  @else
                       <h4 class="card-title">{{$balance[0]->earnings}} ৳</h4>
                  @endif
                 
                  
                </div>
              </div>
              <div class="mt-4">
               
               
                @if ($balance[0]->earnings == 0 )
                    <button class="btn btn-success form-control p-2" disabled>Withdraw</button>
                @else
                    <button class="btn btn-success form-control p-2" data-bs-toggle="modal" data-bs-target="#exampleModal">Withdraw</button>
                @endif

                <a class="btn btn-warning mt-3 form-control p-2" href="{{route('acccenter')}}"><i
                  class="bi bi-arrow-left"></i> Back to Accounts Center</a>
            <!-- Modal -->
                <div class="modal fade" id="exampleModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      
                      <form action="{{route('withdrawconfirm')}}" method="POST">
                        @csrf
                      <div class="modal-header">
                        
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Withdraw alert</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <h2>Withdraw Amount</h2>
                        <input type="number" name="withdraw" class="form-control mb-3 p-2" placeholder="Withdraw amount" required require>
                        <input type="hidden" name="acc_name" value="{{$bank[0]->acc_name}}">
                        <input type="hidden" name="acc_number" value="{{$bank[0]->acc_number}}">
                        <input type="hidden" name="bank_name" value="{{$bank[0]->bank_name}}">
                        <input type="hidden" name="bank_id" value="{{$bank[0]->id}}">
                        <input type="hidden" name="branch_name" value="{{$bank[0]->branch_name}}">
                        <input type="hidden" name="routing_num" value="{{$bank[0]->routing_number}}">
                        <div class="alert alert-success"><strong>Note: </strong>Default Bank Account Will Be Selected Automatically</div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Request Withdraw</button>
                      </div>
                      </form>
                    </div>
                  </div>
                </div>
                
              </div>
            
        </div>
      </div>
  </div>

  

   
    
	
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>
</html>