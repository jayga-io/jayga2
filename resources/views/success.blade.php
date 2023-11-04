<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success Page with Celebration</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .success-container {
            text-align: center;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1s;
        }

        .success-icon {
            font-size: 100px;
            color: #4CAF50;
        }

        .celebration {
            font-size: 50px;
            animation: bounce 2s infinite;
        }

        @keyframes fadeIn {
            0% { opacity: 0; transform: scale(0.8); }
            100% { opacity: 1; transform: scale(1); }
        }

        @keyframes bounce {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-20px);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
        
            <div class="col-md-6 offset-md-3">
                <div class="success-container">
                    <img style="float: right;" src="{{ asset('/assets/img/logo/Jayga Logo-02.png')}}" width="50" height="70" alt="logo">
                <div class="row d-flex justify-content-between">
                	<lottie-player src="https://lottie.host/17aacc4f-d373-499c-a5a7-1c17a9546e6a/Y0ILM8XkHz.json" background="#0000" speed="1" style="width: 100%; height: 150px" loop autoplay direction="1" mode="normal">
                        </lottie-player>
            
                </div>
                    <i class="success-icon">&#10004;</i>
                    <h2>Success</h2>
                    <p>Your payment was successful!</p>
                    
                    <span class="celebration">&#127881;</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
