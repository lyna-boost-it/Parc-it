<!DOCTYPE html>
<html>

<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">  <!-- page css -->
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script> <!-- page css -->
    <link rel="stylesheet" type="text/css" href="{{ URL('assets/vendors/styles/core.css') }}"; /> <!-- page css -->
    <link rel="stylesheet" type="text/css" href="{{ URL('assets/vendors/styles/icon-font.min.css') }}"; /> <!-- page css -->
    <link rel="stylesheet" type="text/css" href="{{ URL('assets/src/plugins/jvectormap/jquery-jvectormap-2.0.3.css') }}"; /> <!-- page css -->
    <link rel="stylesheet" type="text/css" href="{{ URL('assets/vendors/styles/style.css') }}"; /> <!-- PAge css-->
    <script nonce="undefined" src="https://cdn.zingchart.com/zingchart.min.js"></script> <!-- Doghnut stat-->

    <meta charset="utf-8" />
    <title>PARC'IT</title>
    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ URL('assets/vendors/images/car.jpeg') }}"; />
    <link rel="icon" type="image/jpeg" sizes="32x32" href="{{ URL('assets/vendors/images/car.jpeg') }}"; />
    <link rel="icon" type="image/jpeg" sizes="16x16" href="{{ URL('assets/vendors/images/car.jpeg') }}"; />


    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" /> <!-- // for written section in stats-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.min.css"
        rel="stylesheet" /><!-- // for written section in stats-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/1.6.0/tailwind.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" />
    <!-- // for written section in stats-->



<body>

    @stack('scripts')

    @include('layouts.navbars.fixed-plugin-js')

</body>

</head>
