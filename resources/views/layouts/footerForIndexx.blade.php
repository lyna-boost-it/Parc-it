


<div class="footer-wrap pd-20 mb-20 card-box "style="background:#ecf0f4 ">
      <span style="color: #243b506e; font-size:14px;"> PARC'IT &copy; 2022 Developed by Boost it 
     | Tous Droits Réservés</span>

 </div>



<!-- js -->
<script src="{{URL('assets/vendors/scripts/core.js')}}";></script>
<script src="{{URL('assets/vendors/scripts/script.min.js')}}";></script>
<script src="{{URL('assets/vendors/scripts/process.js')}}";></script>
<script src="{{URL('assets/vendors/scripts/layout-settings.js')}}";></script>
<link rel="stylesheet" type="text/css" href="{{ URL('assets/vendors/styles/icon-font.min.css') }}"; />
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
<script src="{{URL('assets/vendors/scripts/calendar-setting.js')}}";></script>
<script src="{{URL('assets/vendors/scripts/pdf.js')}}";></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>

<script>
    var button = document.getElementById("button");
    var makepdf = document.getElementById("makepdf");

    button.addEventListener("click", function () {



 window.print();
        return true;
    });
</script>

<script type="text/javascript">

    $("#vehicle_id").select2({
          placeholder: "Sélectionner un véhicule",
          allowClear: true
      });
</script>
