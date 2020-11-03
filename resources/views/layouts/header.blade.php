<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('public/images/logo-tnmt.png') }}" type="image/png">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('public/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/main.css')}}">
    @stack('scripts')
</head>
<body class="container">
    <a href="{{url('/')}}"><img src="{{asset('public/images/stnmt.png')}}" alt="so-tnmt" class="w-100" height="100"></a>