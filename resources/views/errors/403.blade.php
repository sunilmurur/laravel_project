<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>403 - Access Denied</title>

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{

            height:100vh;
            overflow:hidden;

            display:flex;
            justify-content:center;
            align-items:center;

            background:linear-gradient(135deg,#0f172a,#1e293b,#334155);

            font-family:Arial, Helvetica, sans-serif;
        }

        /* Animated Background */

        .circles{

            position:absolute;
            width:100%;
            height:100%;
            overflow:hidden;
            z-index:1;
        }

        .circles span{

            position:absolute;
            display:block;

            width:20px;
            height:20px;

            background:rgba(255,255,255,0.08);

            animation:animate 25s linear infinite;
            bottom:-150px;

            border-radius:50%;
        }

        .circles span:nth-child(1){
            left:25%;
            width:80px;
            height:80px;
            animation-delay:0s;
        }

        .circles span:nth-child(2){
            left:10%;
            width:20px;
            height:20px;
            animation-delay:2s;
            animation-duration:12s;
        }

        .circles span:nth-child(3){
            left:70%;
            width:20px;
            height:20px;
            animation-delay:4s;
        }

        .circles span:nth-child(4){
            left:40%;
            width:60px;
            height:60px;
            animation-delay:0s;
            animation-duration:18s;
        }

        .circles span:nth-child(5){
            left:65%;
            width:20px;
            height:20px;
            animation-delay:0s;
        }

        .circles span:nth-child(6){
            left:75%;
            width:110px;
            height:110px;
            animation-delay:3s;
        }

        .circles span:nth-child(7){
            left:35%;
            width:150px;
            height:150px;
            animation-delay:7s;
        }

        .circles span:nth-child(8){
            left:50%;
            width:25px;
            height:25px;
            animation-delay:15s;
            animation-duration:45s;
        }

        @keyframes animate {

            0%{
                transform:translateY(0) rotate(0deg);
                opacity:1;
                border-radius:0;
            }

            100%{
                transform:translateY(-1000px) rotate(720deg);
                opacity:0;
                border-radius:50%;
            }
        }

        /* Card */

        .error-card{

            position:relative;
            z-index:2;

            width:550px;

            background:rgba(255,255,255,0.08);

            backdrop-filter:blur(12px);

            border:1px solid rgba(255,255,255,0.1);

            border-radius:20px;

            padding:50px;

            text-align:center;

            color:#fff;

            animation:fadeIn 1s ease;
        }

        @keyframes fadeIn{

            from{
                transform:translateY(40px);
                opacity:0;
            }

            to{
                transform:translateY(0);
                opacity:1;
            }
        }

        .error-icon{

            font-size:80px;

            color:#ff4d4d;

            margin-bottom:20px;

            animation:pulse 2s infinite;
        }

        @keyframes pulse{

            0%{
                transform:scale(1);
            }

            50%{
                transform:scale(1.1);
            }

            100%{
                transform:scale(1);
            }
        }

        .error-code{

            font-size:90px;
            font-weight:bold;

            letter-spacing:5px;

            margin-bottom:10px;
        }

        .error-title{

            font-size:28px;

            margin-bottom:15px;
        }

        .error-message{

            color:#d1d5db;

            line-height:1.8;

            margin-bottom:35px;
        }

        .btn-custom{

            padding:10px 25px;

            border-radius:30px;

            margin:5px;

            transition:0.3s;
        }

        .btn-custom:hover{

            transform:translateY(-3px);

            box-shadow:0 8px 20px rgba(0,0,0,0.3);
        }

    </style>

</head>

<body>

    {{-- Animated Background --}}
    <div class="circles">

        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>

    </div>

    {{-- Error Card --}}
    <div class="error-card">

        <div class="error-icon">
            <i class="fas fa-lock"></i>
        </div>

        <div class="error-code">
            403
        </div>

        <div class="error-title">
            Access Denied
        </div>

        <div class="error-message">

            @auth

                Hello <strong>{{ Auth::user()->name }}</strong>,
                you do not have permission
                to access this page.

            @else

                You do not have permission
                to access this page.

            @endauth

        </div>

        <div>

            <a href="{{ url()->previous() }}"
               class="btn btn-secondary btn-custom">

                <i class="fas fa-arrow-left"></i>
                Go Back

            </a>

            <a href="{{ url('/dashboard') }}"
               class="btn btn-primary btn-custom">

                <i class="fas fa-home"></i>
                Dashboard

            </a>

        </div>

    </div>

</body>

</html>