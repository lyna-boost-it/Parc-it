


<div class="footer-wrap pd-20 mb-20 card-box "style="background:#545454 ">
    <span style="color: white"> PARC'IT &copy; Developed by Boost it 2022
     | Tous Droits Réservés</span>

 </div>


@stack('scripts')

@include('layouts.navbars.fixed-plugin-js')
<!-- js -->
<script src="{{URL('assets/vendors/scripts/core.js')}}";></script>
<script src="{{URL('assets/vendors/scripts/script.min.js')}}";></script>
<script src="{{URL('assets/vendors/scripts/process.js')}}";></script>
<script src="{{URL('assets/vendors/scripts/layout-settings.js')}}";></script>
<script src="{{URL('assets/src/plugins/jQuery-Knob-master/jquery.knob.min.js')}}";></script>
<script src="{{URL('assets/src/plugins/highcharts-6.0.7/code/highcharts.js')}}";></script>
<script src="{{URL('assets/src/plugins/highcharts-6.0.7/code/highcharts-more.js')}}";></script>
<script src="{{URL('assets/src/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js')}}";></script>
<script src="{{URL('assets/src/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}";></script>
<script src="{{URL('assets/src/plugins/apexcharts/apexcharts.min.js')}}";></script> <!-- dashboard 2-->
<script src="{{URL('assets/vendors/scripts/dashboard2.js')}}";></script>
<script src="{{URL('assets/vendors/scripts/dashboard3.js')}}";></script>

<script src="{{URL('assets/src/plugins/datatables/js/jquery.dataTables.min.js')}}";></script>
<script src="{{URL('assets/src/plugins/datatables/js/dataTables.bootstrap4.min.js')}}";></script>
<script src="{{URL('assets/src/plugins/datatables/js/dataTables.responsive.min.js')}}";></script>
<script src="{{URL('assets/src/plugins/datatables/js/responsive.bootstrap4.min.js')}}";></script>
<!-- buttons for Export datatable -->
<script src="{{URL('assets/src/plugins/datatables/js/dataTables.buttons.min.js')}}";></script>
<script src="{{URL('assets/src/plugins/datatables/js/buttons.bootstrap4.min.js')}}";></script>
<script src="{{URL('assets/src/plugins/datatables/js/buttons.print.min.js')}}";></script>
<script src="{{URL('assets/src/plugins/datatables/js/buttons.html5.min.js')}}";></script>
<script src="{{URL('assets/src/plugins/datatables/js/buttons.flash.min.js')}}";></script>
<script src="{{URL('assets/src/plugins/datatables/js/pdfmake.min.js')}}";></script>
<script src="{{URL('assets/src/plugins/datatables/js/vfs_fonts.js')}}";></script>
<!-- Datatable Setting js -->
<script src="{{URL('assets/vendors/scripts/datatable-setting.js')}}";></script>
<!-- Calander -->
<script src="{{URL('assets/src/plugins/fullcalendar/fullcalendar.min.js')}}";></script>
<script src="{{URL('assets/vendors/scripts/calendar-setting.js')}}";></script>

<script src="{{URL('assets/src/plugins/jquery-steps/jquery.steps.js')}}";></script>
<script src="{{URL('assets/vendors/scripts/steps-setting.js')}}";></script>
<script src="{{URL('assets/vendors/scripts/topfd.js')}}";></script>
<script src="lib/jquery/jquery.min.js"></script>

<script src="lib/bootstrap/js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script>
<script src="lib/jquery.scrollTo.min.js"></script>
<script src="lib/jquery.nicescroll.js" type="text/javascript"></script>
<script src="lib/jquery.sparkline.js"></script>
<!--common script for all pages-->
<script src="lib/common-scripts.js"></script>
<script type="text/javascript" src="lib/gritter/js/jquery.gritter.js"></script>
<script type="text/javascript" src="lib/gritter-conf.js"></script>
<!--script for this page-->
<script src="lib/sparkline-chart.js"></script>
<script src="lib/zabuto_calendar.js"></script>
<!-- Google Tag Manager (noscript) -->
<!-- Google Tag Manager (noscript) -->
<noscript
	><iframe
		src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS"
		height="0"
		width="0"
		style="display: none; visibility: hidden"
	></iframe
></noscript>
<!-- End Google Tag Manager (noscript) -->
<script>
    var button = document.getElementById("button");
    var makepdf = document.getElementById("makepdf");

    button.addEventListener("click", function () {



 window.print();
        return true;
    });
</script>
