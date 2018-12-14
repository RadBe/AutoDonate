<?php
    [$current_online, $online_record] = \App\Online::getOnline();
?>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">

    @yield('head')
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="/">{{config('site.name')}}</a>
        <button class="navbar-toggler navbar-toggler-right text-uppercase text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            @include('layouts.partials.nav')
        </div>
    </div>
</nav>

<div class="container py-4">
    <div class="jumbotron p-4 w-75 mb-0 mx-auto shadow">
        <div class="container">
            <div class="row text-center">

                <div class="col-lg-3">
                    <div class="p-3 mb-00 bg-success text-white shadow-sm rounded monitoring-online">
                        <h5 class="text-uppercase text-overflow monitoring-text">Онлайн</h5>
                        <h1 class="text-uppercase" id="online-players">{{$current_online[0]}}</h1>
                    </div>
                </div>

                <div class="col-lg-6 text-center m-auto">
                    <h1 class="header-sitename font-weight-bold">{{config('site.name')}}</h1>
                    <p style="font-size: 25px;">Наш IP: <span class="text-danger rounded" id="full-select">{{config('site.ip')}}</span></p>
                </div>

                <div class="col-lg-3">
                    <div class="p-3 mb-0 bg-success text-white shadow-sm rounded monitoring-online">
                        <h5 class="text-uppercase text-overflow monitoring-text">Рекорд</h5>
                        <h1 class="text-uppercase" id="online-record" title="{{$online_record[1]}}">{{$online_record[0]}}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="shadow w-75 p-4 rounded mt-4 mx-auto bg-white">
        @yield('content')
    </div>

</div>

@include('layouts.partials.footer')

</body>
</html>