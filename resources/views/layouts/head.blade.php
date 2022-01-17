<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">


    <!-- CSS
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/skeleton/2.0.4/skeleton.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Favicon
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <link rel="icon" type="image/png" href="images/favicon.png">

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .button-danger {
            background-color: #cd1818;
            color: #fff;
        }

        .button-secondary {
            background-color: #334433;
            color: #fff;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .alert {
            display: block;
            padding: 20px;
            border-left: 5px solid;
        }

        .alert-success {
            background-color: #D5F5E3;
            border-left-color: #2ECC71;
            color: #2ECC71;
        }

        .alert-info {
            background-color: #D6EAF8;
            border-left-color: #3498DB;
            color: #3498DB;
        }

        .alert-warning {
            background-color: #FCF3CF;
            border-left-color: #F1C40F;
            color: #F1C40F;
        }

        .alert-error {
            background-color: #F2D7D5;
            border-left-color: #C0392B;
            color: #C0392B;
        }
    </style>
</head>
