<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jayga | Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link
     rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"
   />
    <style>
        body {
            background: #f4f4f4;
        }

        .login-container {
            width: 100%;
            margin: 0 auto;
            padding: 30px;
            background: #fff;
           /* box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3); */
            border-radius: 5px;
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-form {
            margin-top: 20px;
            
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .login-btn {
            background: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .login-btn:hover {
            background: #0056b3;
        }

        .signup-link {
            text-align: center;
            margin-top: 20px;
        }

        .nav-link{
          color: #139175;
          font-size: medium;
          font-weight: 700;
        }
     
    </style>
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-body-tertiary mb-5" >
            <div class="container-fluid">
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <a class="navbar-brand" href="{{route('home')}}">
                <h2><img style="float: right;" src="{{asset('assets/img/logo/Jayga Logo-02.png')}}" width="70" height="70" alt="logo"/></h2>
    
              </a>
              <div class="collapse navbar-collapse px-5" id="navbarTogglerDemo03">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="#">Admin</a>
                  </li>
                 
                </ul>
                
              </div>
            </div>
          </nav>
        <div class="row ">
           
            <div class="col-md-8 m-auto">
                <div class="card m-auto" style="max-width: 32rem; ">
                    <div class="login-container ">
                        <div class="py-4 text-center"
                            style="color: #139175; font-size: 38px; font-family: Montserrat; font-weight: 700; word-wrap: break-word ;">
                            <img src="{{asset('assets/img/logo.png')}}" height="70px;" width="70px;" alt="" srcset=""> Jayga | <small
                                class="fs-6">Admin </small>
                        
                        </div>
                        <div class="card-body ">
                            <form class="form-control" method="POST" action="{{route('adminauth')}}" >
                                @csrf
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"> Username</span>
                                        </div>
                                        <input type="text" name="username" class="form-control" placeholder="Enter username" required require>
                                
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"> Password</span>
                                        </div>
                                        <input type="password" name="password" class="form-control" placeholder="Enter password" required require>
                                
                                    </div>
                                    <!--  <div class="form-group">
                                                                    
                                                                    <input type="tel" id="phone" name="phone" class="form-control" placeholder="Enter your phone" required require>
                                                                </div> -->
                                       
                                <button type="submit" class="form-control btn btn-success  my-2" style="color: white;">Login</button>
                                      
                                    
                            </form>
                        </div>
                        
                        
                    </div>
                </div>
            </div>
           
        </div>
        
      </div>
      
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>
</html>