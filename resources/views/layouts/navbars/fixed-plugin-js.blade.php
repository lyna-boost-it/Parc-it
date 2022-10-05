

<script>
    $(document).ready(function () {
        $sidebar = $('.sidebar');
        $sidebar_img_container = $sidebar.find('.sidebar-background');
        $full_page = $('.full-page');
        $sidebar_responsive = $('body > .navbar-collapse');
        sidebar_mini_active = true;
        window_width = $(window).width();
        fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();
        // if( window_width > 767 && fixed_plugin_open == 'Dashboard' ){
        //     if($('.fixed-plugin .dropdown').hasClass('show-dropdown')){
        //         $('.fixed-plugin .dropdown').addClass('show');
        //     }
        //
        // }
        $('.fixed-plugin a').click(function (event) {
            // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
            if ($(this).hasClass('switch-trigger')) {
                if (event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                }
            }
        });
        $('.fixed-plugin .active-color span').click(function () {
            $full_page_background = $('.full-page-background');
            $(this).siblings().removeClass('active');
            $(this).addClass('active');
            var new_color = $(this).data('color');
            if ($sidebar.length != 0) {
                $sidebar.attr('data-active-color', new_color);
            }
            if ($full_page.length != 0) {
                $full_page.attr('data-active-color', new_color);
            }
            if ($sidebar_responsive.length != 0) {
                $sidebar_responsive.attr('data-active-color', new_color);
            }
        });
        $('.fixed-plugin .background-color span').click(function () {
            $(this).siblings().removeClass('active');
            $(this).addClass('active');
            var new_color = $(this).data('color');
            if ($sidebar.length != 0) {
                $sidebar.attr('data-color', new_color);
            }
            if ($full_page.length != 0) {
                $full_page.attr('filter-color', new_color);
            }
            if ($sidebar_responsive.length != 0) {
                $sidebar_responsive.attr('data-color', new_color);
            }
        });
        $('.fixed-plugin .img-holder').click(function () {
            $full_page_background = $('.full-page-background');
            $(this).parent('li').siblings().removeClass('active');
            $(this).parent('li').addClass('active');
            var new_image = $(this).find("img").attr('src');
            if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
                $sidebar_img_container.fadeOut('fast', function () {
                    $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                    $sidebar_img_container.fadeIn('fast');
                });
            }
            if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
                var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');
                $full_page_background.fadeOut('fast', function () {
                    $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
                    $full_page_background.fadeIn('fast');
                });
            }
            if ($('.switch-sidebar-image input:checked').length == 0) {
                var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
                var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');
                $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
            }
            if ($sidebar_responsive.length != 0) {
                $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
            }
        });
        $('.switch-sidebar-image input').on("switchChange.bootstrapSwitch", function () {
            $full_page_background = $('.full-page-background');
            $input = $(this);
            if ($input.is(':checked')) {
                if ($sidebar_img_container.length != 0) {
                    $sidebar_img_container.fadeIn('fast');
                    $sidebar.attr('data-image', '#');
                }
                if ($full_page_background.length != 0) {
                    $full_page_background.fadeIn('fast');
                    $full_page.attr('data-image', '#');
                }
                background_image = true;
            } else {
                if ($sidebar_img_container.length != 0) {
                    $sidebar.removeAttr('data-image');
                    $sidebar_img_container.fadeOut('fast');
                }
                if ($full_page_background.length != 0) {
                    $full_page.removeAttr('data-image', '#');
                    $full_page_background.fadeOut('fast');
                }
                background_image = false;
            }
        });
        $('.switch-mini input').on("switchChange.bootstrapSwitch", function () {
            $body = $('body');
            $input = $(this);
            if (paperDashboard.misc.sidebar_mini_active == true) {
                $('body').removeClass('sidebar-mini');
                paperDashboard.misc.sidebar_mini_active = false;
                $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();
            } else {
                $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');
                setTimeout(function () {
                    $('body').addClass('sidebar-mini');
                    paperDashboard.misc.sidebar_mini_active = true;
                }, 300);
            }
            // we simulate the window Resize so the charts will get updated in realtime.
            var simulateWindowResize = setInterval(function () {
                window.dispatchEvent(new Event('resize'));
            }, 180);
            // we stop the simulation of Window Resize after the animations are completed
            setTimeout(function () {
                clearInterval(simulateWindowResize);
            }, 1000);
        });
    });
</script>





<script>
$("#staff_type").change(function() {
    if ($(this).val() == "Conducteur") {
        $('#conducteur_fieldDiv').show();
        $('#conducteur_field').attr('required','');
        $('#conducteur_field').attr('data-error', 'This field is required.');
    } else {
        $('#conducteur_fieldDiv').hide();
        $('#conducteur_field').removeAttr('required');
        $('#conducteur_field').removeAttr('data-error');
    }
});
$("#staff_type").trigger("change");


</script>

<script>
$("#staff_type").change(function() {
    if ($(this).val() == "Personnel du centre de maintenance" ) {
        $('#Mstaff_fieldDiv').show();
        $('#Mstaff_field').attr('required','');
        $('#Mstaff_field').attr('data-error', 'This field is required.');
    } else {
        $('#Mstaff_fieldDiv').hide();
        $('#Mstaff_field').removeAttr('required');
        $('#Mstaff_field').removeAttr('data-error');
    }

});
$("#staff_type").trigger("change");


  </script>

<script>
    $("#staff_type").change(function() {
        if ($(this).val() == "Personnel du parc" ) {
            $('#staff_fieldDiv').show();
            $('#staff_field').attr('required','');
            $('#staff_field').attr('data-error', 'This field is required.');
        } else {
            $('#staff_fieldDiv').hide();
            $('#staff_field').removeAttr('required');
            $('#staff_field').removeAttr('data-error');
        }

    });
    $("#staff_type").trigger("change");
</script>
  <script>$(function() {
    $('.view_details').click(function() {
      if ($(this).is(':checked')) {
        $(this)
          .next('label')
          .html('&times;')
          .attr('title', 'tap here to close full profile');
        $(this)
          .parent()
          .next('main')
          .slideDown('normal');
      } else {
        $(this)
          .next('label')
          .html('☰')
          .attr('title', 'tap here to view full profile');
        $(this)
          .parent()
          .next('main')
          .slideUp('fast');
      }
    });
  });</script>





<script>
    $("#staff_type_for_absence").change(function() {
        if ($(this).val() == "Conducteur") {
            $('#conducteur_fieldDiv_for_absence').show();
            $('#conducteur_field_for_absence').attr('required','');
            $('#conducteur_field_for_absence').attr('data-error', 'This field is required.');
        } else {
            $('#conducteur_fieldDiv_for_absence').hide();
            $('#conducteur_field_for_absence').removeAttr('required');
            $('#conducteur_field_for_absence').removeAttr('data-error');
        }
    });
    $("#staff_type_for_absence").trigger("change");


      </script>

    <script>
    $("#staff_type_for_absence").change(function() {
        if ($(this).val() == "Personnel du centre de maintenance" ) {
            $('#Mstaff_fieldDiv_for_absence').show();
            $('#Mstaff_field_for_absence').attr('required','');
            $('#Mstaff_field_for_absence').attr('data-error', 'This field is required.');
        } else {
            $('#Mstaff_fieldDiv_for_absence').hide();
            $('#Mstaff_field_for_absence').removeAttr('required');
            $('#Mstaff_field_for_absence').removeAttr('data-error');
        }
    });
    $("#staff_type_for_absence").trigger("change");


    </script>

    <script>
    $("#staff_type_for_absence").change(function() {
        if ($(this).val() == "Personnel du parc" ) {
            $('#Msctaff_fieldDiv_for_absence').show();
            $('#Msctaff_field_for_absence').attr('required','');
            $('#Msctaff_field_for_absence').attr('data-error', 'This field is required.');
        } else {
            $('#Msctaff_fieldDiv_for_absence').hide();
            $('#Msctaff_field_for_absence').removeAttr('required');
            $('#Msctaff_field_for_absence').removeAttr('data-error');
        }
    });
    $("#staff_type_for_absence").trigger("change");


      </script>



   <script>
    $("#destination_type").change(function() {
        if ($(this).val() == "Destination (A->B)" ) {
            $('#AB_Div').show();
            $('#AB').attr('required','');
            $('#AB').attr('data-error', 'This field is required.');
        } else {
            $('#AB_Div').hide();
            $('#AB').removeAttr('required');
            $('#AB').removeAttr('data-error');
        }
    });
    $("#destination_type").trigger("change");


      </script>

   <script>
    $("#destination_type").change(function() {
        if ($(this).val() == "Territoire" ) {
            $('#Territoire_Div').show();
            $('#Territoire').attr('required','');
            $('#Territoire').attr('data-error', 'This field is required.');
        } else {
            $('#Territoire_Div').hide();
            $('#Territoire').removeAttr('required');
            $('#Territoire').removeAttr('data-error');
        }
    });
    $("#destination_type").trigger("change");


      </script>
   <script>
    $("#vehicule_type").change(function() {
        if ($(this).val() == "pick-up" ) {
            $('#pick-up_Div').show();
            $('#pick-up').attr('required','');
            $('#pick-up').attr('data-error', 'This field is required.');
        } else {
            $('#pick-up_Div').hide();
            $('#pick-up').removeAttr('required');
            $('#pick-up').removeAttr('data-error');
        }
    });
    $("#vehicule_type").trigger("change");


      </script>
   <script>
    $("#vehicule_type").change(function() {
        if ($(this).val() == "mini-fourgonnettes" ) {
            $('#mini-fourgonnettes_Div').show();
            $('#mini-fourgonnettes').attr('required','');
            $('#mini-fourgonnettes').attr('data-error', 'This field is required.');

        } else {
            $('#mini-fourgonnettes_Div').hide();
            $('#mini-fourgonnettes').removeAttr('required');
            $('#mini-fourgonnettes').removeAttr('data-error');
        }
    });
    $("#vehicule_type").trigger("change");


      </script>
   <script>
    $("#vehicule_type").change(function() {
        if ($(this).val() == "minibus" ) {
            $('#minibus_Div').show();
            $('#minibus').attr('required','');
            $('#minibus').attr('data-error', 'This field is required.');

                } else {
            $('#minibus_Div').hide();
            $('#minibus').removeAttr('required');
            $('#minibus').removeAttr('data-error');
        }
    });
    $("#vehicule_type").trigger("change");


      </script>
  <script>

var from = document.getElementById('date1').textContent;
        var to = document.getElementById('date2').textContent;

        var splitFrom = from.split('/');
        var splitTo = to.split('/');
        var fromDate = Date.parse(splitFrom[0], splitFrom[1] - 1, splitFrom[2]);
        var toDate = Date.parse(splitTo[0], splitTo[1] - 1, splitTo[2]);

    $('#date2').change(function () {
        var diff = fromDate < toDate;

    });
</script>

<script>
    $(function() {
    var u = window.location.href.substr(window.location.href
                .lastIndexOf("/") + 1);
    $(".nav li a").each(function() {
    $h = $(this).attr("href");
    if ($h == u || $h == '')
        $(this).addClass("active");
    })
});
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.debug.js" >
</script>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@2.5.0/dist/alpine.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/countup@1.8.2/dist/countUp.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" ></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" ></script>
<script>
    function generatePDF() {
        var doc = new jsPDF();  //create jsPDF object
         doc.fromHTML(document.getElementById("test"), // page element which you want to print as PDF
         15,
         15,
         {
           'width': 170  //set width
         },
         function(a)
          {
           doc.save("HTML2PDF.pdf"); // save file name as HTML2PDF.pdf
         });
       }
    </script>







<style>
#chart-container{
height: 500px;
}</style>
<style>
.chart--container {
min-height: 530px;
width: 100%;
height: 100%;
}

.zc-ref {
display: none;
}
</style>

<script>
    $("#day_type").change(function() {
        if ($(this).val() == "Jour férié" ) {
            $('#spacial_daysA').show();
            $('#spacial_daysA').attr('required','');
            $('#spacial_daysA').attr('data-error', 'This field is required.');

                } else {
            $('#spacial_daysA').hide();
            $('#spacial_daysA').removeAttr('required');
            $('#spacial_daysA').removeAttr('data-error');
        }
    });
    $("#day_type").trigger("change");


</script>
<script>
    $("#hour_type").change(function() {
        if ($(this).val() == "Jour" ) {
            $('#spacial_hourA').show();
            $('#spacial_hourA').attr('required','');
            $('#spacial_hourA').attr('data-error', 'This field is required.');

                } else {
            $('#spacial_hourA').hide();
            $('#spacial_hourA').removeAttr('required');
            $('#spacial_hourA').removeAttr('data-error');
        }
    });
    $("#hour_type").trigger("change");


</script>

<script>
    $("#hour_type").change(function() {
        if ($(this).val() == "Nuit" ) {
            $('#spacial_hourB').show();
            $('#spacial_hourB').attr('required','');
            $('#spacial_hourB').attr('data-error', 'This field is required.');

                } else {
            $('#spacial_hourB').hide();
            $('#spacial_hourB').removeAttr('required');
            $('#spacial_hourB').removeAttr('data-error');
        }
    });
    $("#hour_type").trigger("change");


</script>
