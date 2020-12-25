<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Giám sát tài nguyên nước Sơn La</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Manuale:wght@500&display=swap" rel="stylesheet">
        
        <link rel="stylesheet" href="{{asset('public/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('public/TNN_TRANG_MO_DAU/css/tnn-trang-mo-dau.css')}}">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" type="text/css">

        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
        <script src="https://unpkg.com/esri-leaflet@2.5.0/dist/esri-leaflet.js" integrity="sha512-ucw7Grpc+iEQZa711gcjgMBnmd9qju1CICsRaryvX7HJklK0pGl/prxKvtHwpgm5ZHdvAil7YPxI1oWPOWK3UQ==" crossorigin=""></script>
    </head>
    <body class="container p-0">
        <div id="e146_11">
            <span id="e148_25" class="font-weight-bold">Đo đạc bản đồ và thông tin địa lý</span>
            <span id="e148_17" class="font-weight-bold">Viễn thám</span>
            <span id="e148_13" class="font-weight-bold">Biến đổi khí hậu</span>
            <span id="e148_22" class="font-weight-bold">Môi trường</span>
            <span id="e148_21" class="font-weight-bold">Khí tượng thủy văn</span>
            <span id="e148_11" class="font-weight-bold">Tài nguyên nước</span>
            <span id="e148_7" class="font-weight-bold">Đất đai</span>
            <span id="e148_20" class="font-weight-bold">Địa chất khoáng sản</span>
            <div id="e81_36"></div>
            <div id="e81_34"></div>
            <div id="e81_26"></div>
            <div id="e81_32"></div>
            <div id="e81_24"></div>
            <div id="e81_22"></div>
            <div id="e148_5"></div>
            <div id="e148_3"></div>
            <span id="e77_49" class="font-weight-bold">QUẢN LÝ CƠ SỞ DỮ LIỆU TÀI NGUYÊN VÀ MÔI TRƯỜNG</span>
            <div id="e81_30"></div>
            <div id="e146_12"></div>
        </div>

    <script src="{{ asset('js/tai-nguyen-nuoc/configMap.js') }}"></script>
    </body>
</html>
