<!DOCTYPE html>
<html lang="en">

<head>

</head>

<body class="{{ $class }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.debug.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>
    @stack('scripts')

    @include('layouts.navbars.fixed-plugin-js')
 </body>

</html>
