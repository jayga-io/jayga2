<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jayga | Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link
     rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"
   />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
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
       @include('host.nav')
        <div class="row vh-60">
            <div class="col-sm-4 col-md-4 m-auto ">

              <div
                style="width: 100%; height: 100%; background: white; box-shadow: 0px -2px 18px rgba(0, 0, 0, 0.25); border-radius: 32px">

                <div class="py-4 text-center"
                  style="color: #139175; font-size: 38px; font-family: Montserrat; font-weight: 700; word-wrap: break-word ;">
                  Log-in
                </div>
              
                <div style="width: 100%; height: 178px; position: relative">

                  <div class="login-container ">
                    <form class="login-form" action="{{route('sendotp')}}" method="POST" >
                        @csrf
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">+88</span>
                          </div>
                          <input type="tel" id="phone" name="phone" class="form-control" placeholder="Enter your phone" required require>

                        </div>
                      <!--  <div class="form-group">
                            
                            <input type="tel" id="phone" name="phone" class="form-control" placeholder="Enter your phone" required require>
                        </div> -->
                        <button type="submit"  class="btn btn-warning" style="color: white;">Login</button>
                    </form>
                    
                </div>

                </div>
              
              </div>




             
            </div>
            <div class="col-md-8 m-auto">
              <div class="text-center px-5">
                 

                <dotlottie-player src="https://lottie.host/e36ab65c-9f3f-43d2-9b3f-073fac34b144/PfLAT4Wdxz.json" background="transparent" speed="1" style="width: 100%; height: 619.442px;" loop autoplay></dotlottie-player>

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
  <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
<!-- <script>
          const phoneInputField = document.querySelector("#phone");
        const phoneInput = window.intlTelInput(phoneInputField, {
          initialCountry: "bd",
          utilsScript:
            "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
        });


        function process(event) {
      event.preventDefault();

      const phoneNumber = phoneInput.getNumber();

      info.style.display = "none";
      error.style.display = "none";

      if (phoneInput.isValidNumber()) {
        info.style.display = "";
        info.innerHTML = `Phone number in E.164 format: <strong>${phoneNumber}</strong>`;
        return true;
      } else {
        error.style.display = "";
        error.innerHTML = `Invalid phone number.`;
        return false;
      }
      }
    </script> -->
    
</body>

</html>