<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>PARCIT</title>
    <!-- Site favicon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ URL('assets/vendors/styles/core.css') }}"; />
    <link rel="stylesheet" type="text/css" href="{{ URL('assets/vendors/styles/icon-font.min.css') }}"; />

    <link rel="stylesheet" type="text/css" href="{{ URL('assets/src/plugins/fullcalendar/fullcalendar.css') }}"; />

    <link rel="stylesheet" type="text/css" href="{{ URL('assets/vendors/styles/style.css') }}"; />
    <script src=
    "https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
        </script>

    <script src=
"https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js">
        </script>

    <link rel="apple-touch-icon" sizes="180x180" href="{{ URL('assets/vendors/images/car.png') }}"; />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ URL('assets/vendors/images/car.png') }}"; />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ URL('assets/vendors/images/car.png') }}"; />
    <link rel="stylesheet" type="text/css" href="vendors/styles/core.css" />






    <!-- *********************************************-->








<body>

    @stack('scripts')

    @include('layouts.navbars.fixed-plugin-js')

</body>

</head>
