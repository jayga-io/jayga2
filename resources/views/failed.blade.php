<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jayga | Payment Failure</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css">
    <style>
        body {
            text-align: center;
            font-family: Oswald;
            margin-top: 50px;
        }
    
        .main-container {
            width: 500px;
            height: 500px;
            margin: 0 auto;
            border: 1px solid lightgrey;
            border-radius: 5px;
            background-color: #f0f0f0;
        }
    
        .top-container {
            height: 280px;
            background-color: rgb(240, 46, 12);
        }
    
        i.bigger-size {
            font-size: 280px;
            color: white;
        }
    
        .bottom-container {
            margin-top: 30px;
        }
    
        
    
        button {
            font-family: Roboto;
            background-color: #f0f0f0;
            border-radius: 15px;
            padding: 15px;
            width: 150px;
            border: 3px solid #29CDB5;
            color: #555;
        }
    
        button:hover {
            background-color: #29CDB5;
            color: white;
            cursor: pointer;
        }
    
        h1 {
            margin-bottom: -15px;
            color: #555;
        }
    
        p {
            font-size: 20px;
            color: #555;
        }

        .celebration {
            font-size: 50px;
            animation: bounce 2s infinite;
        }
    
       
    </style>
</head>
<body>
    
    <div class="main-container">
        
        <div class="top-container ">
            <i class="fa fa-exclamation-circle bigger-size" aria-hidden="true"></i>

        </div>
      
        <div class="bottom-container">
          <h1>Error</h1>
          <p>Transaction Failed</p>
      
          <i class="fa fa-frown-o" style="font-size: 50px;" aria-hidden="true"></i>

        </div>
        <img style="float: right;" src="{{ asset('/assets/img/logo/Jayga Logo-02.png')}}" width="50" height="70" alt="logo">
      </div>
      <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
</body>
</html>