@if (Auth::user()->type == 'Gestionnaire parc' ||
Auth::user()->type == 'Technicien' || Auth::user()->type == 'Gestionnaire Sup' || Auth::user()->type == 'Utilisateur')


    <!DOCTYPE html>
    <html>
    @include('layouts.headforKPIindex')


    <body>

        @include('layouts.header-bar')
        @include('layouts.navbar')




        <div class="main-container">
            <button class="btn btn-warning btn-round"> <a href="javascript:generatePDF()">Télécharger le PDF</a></button>

            <div id="test">
                {{ Absence_cheker() }}

                <div class="xs-pd-20-10 pd-ltr-20">
                    <div class="card-box pd-20 height-100-p mb-30">
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <img src="{{ URL('assets/vendors/images/staffstat.png') }}"; alt="" />
                            </div>
                            <div class="col-md-8">
                                <h4 class="font-20 weight-500 mb-10 text-capitalize">

                                    <div class="weight-600 font-30 text-blue"> Bienvenue</div>
                                </h4>

                                <p class="font-18 max-width-600">
                                    vous trouverez ici toutes les statistiques relatives au personnel <b>Le
                                        {{ $date }}</b>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>





                <div class="row">
                    <div class="card-box col-md-8 mb-20">
                        <div id="piechart"></div>
                    </div>


                    <div class="card-box col-md-4 mb-16">


                        <div class="rounded-lg shadow-sm mb-12">
                            <div class="rounded-lg bg-white shadow-lg md:shadow-xl relative overflow-hidden">
                                <div class="px-3 pt-12 pb-10 text-center relative z-20">
                                    <h1 class="text-sm uppercase text-gray-500 leading-tight" style="font-size: 2.5em;">
                                        Nombre
                                        total du personnel:</h1>
                                    <h3 class="text-3xl text-gray-700 font-semibold leading-tight my-3">
                                        {{ $totalstaff }}
                                        Personne</h3>

                                </div>


                            </div>
                        </div>

                        <div class="rounded-lg shadow-sm mb-12">
                            <div class="rounded-lg bg-white shadow-lg md:shadow-xl relative overflow-hidden">
                                <div class="px-3 pt-12 pb-10 text-center relative z-20">
                                    <h1 class="text-sm uppercase text-gray-500 leading-tight" style="font-size: 2em;">
                                        Conducteur:</h1>
                                    <h3 class="text-3xl text-gray-700 font-semibold leading-tight my-3">
                                        {{ $drivers }}
                                        Personne</h3>

                                </div>


                            </div>
                        </div>

                        <div class="rounded-lg shadow-sm mb-4">
                            <div class="rounded-lg bg-white shadow-lg md:shadow-xl relative overflow-hidden">
                                <div class="px-3 pt-8 pb-10 text-center relative z-10">
                                    <h1 class="text-sm uppercase text-gray-500 leading-tight" style="font-size: 2em;">
                                        Personnel du parc:</h1>
                                    <h3 class="text-3xl text-gray-700 font-semibold leading-tight my-3">
                                        {{ $pParck }}
                                        Personne</h3>

                                </div>


                            </div>
                        </div>

                        <div class="rounded-lg shadow-sm mb-4">
                            <div class="rounded-lg bg-white shadow-lg md:shadow-xl relative overflow-hidden">
                                <div class="px-3 pt-8 pb-10 text-center relative z-10">
                                    <h1 class="text-sm uppercase text-gray-500 leading-tight" style="font-size: 2em;">
                                        Personnel du centre de maintenance:</h1>
                                    <h3 class="text-3xl text-gray-700 font-semibold leading-tight my-3">
                                        {{ $pCentre }}
                                        Personne</h3>

                                </div>


                            </div>
                        </div>


                    </div>

                </div>

                <div class="xs-pd-20-10 pd-ltr-20">



                    <div class="card-box pd-20 height-100-p mb-30">
                        <main>
                            <h4 class="font-20 weight-500 mb-10 text-capitalize text-orange">Récupération et heures
                                supplémentaires </h4>

                            <input id="tab5" type="radio" name="tabsd" checked>



                            <section id="content5">
                                <table class="table nowrap hover data-table-export">
                                    <thead>
                                        <tr>
                                            <th>Numéro</th>
                                            <th> Nom Et Prénom</th>
                                            <th>H supp cumulées</th>
                                            <th> Recherche mois</th>


                                        </tr>
                                    </thead>

                                    @php
                                        $i = 0;

                                    @endphp


                                    <tbody>

                                        @foreach ($staffs as $staff)
                                            @php
                                                $i = $i + 1;
                                            @endphp
                                            <tr>
                                                <td> {{ $i }}</td>
                                                <td>{{ $staff->name }} {{ $staff->last_name }}</td>

                                                <td>
                                                    <table>

                                                        <tr>
                                                            <th>H Jour</th>
                                                            <th>H Nuit</th>

                                                            <th> V</th>
                                                            <th>J Fériés</th>
                                                            <th>Récupération</th>


                                                        </tr>

                                                        <tr>
                                                            <td> {{ DB::table('hours')->where('staff_id', '=', $staff->id)->where('type_days', '=', 'Journée de travail')->sum('day_hours') +
                                                                DB::table('hours')->where('staff_id', '=', $staff->id)->where('type_days', '=', 'Nuit de travail')->sum('day_hours') }}
                                                            </td>
                                                            <td> {{ DB::table('hours')->where('staff_id', '=', $staff->id)->where('type_days', '=', 'Journée de travail')->sum('night_hours') +
                                                                DB::table('hours')->where('staff_id', '=', $staff->id)->where('type_days', '=', 'Nuit de travail')->sum('night_hours') }}
                                                            </td>
                                                            <td> {{ DB::table('hours')->where('staff_id', '=', $staff->id)->where('type_days', '=', 'Vendredi')->count() }}
                                                            </td>
                                                            <td> {{ DB::table('hours')->where('staff_id', '=', $staff->id)->where('type_days', '=', 'Jour férié')->count() }}
                                                            </td>

                                                            <td>{{ round(
                                                                (CheckDayHours(
                                                                    DB::table('hours')->where('staff_id', '=', $staff->id)->where('type_days', '=', 'Journée de travail')->sum('day_hours') +
                                                                        DB::table('hours')->where('staff_id', '=', $staff->id)->where('type_days', '=', 'Nuit de travail')->sum('day_hours'),
                                                                ) +
                                                                    (DB::table('hours')->where('staff_id', '=', $staff->id)->where('type_days', '=', 'Journée de travail')->sum('night_hours') +
                                                                        DB::table('hours')->where('staff_id', '=', $staff->id)->where('type_days', '=', 'Nuit de travail')->sum('night_hours')) *
                                                                        2 +
                                                                    (DB::table('hours')->where('staff_id', '=', $staff->id)->where('type_days', '=', 'Vendredi')->count() +
                                                                        DB::table('hours')->where('staff_id', '=', $staff->id)->where('type_days', '=', 'Jour férié')->count()) *
                                                                        8) /
                                                                    8,
                                                            ) }}
                                                                Jour(s) </td>

                                                        </tr>

                                                    </table>

                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                            href="#" role="button" data-toggle="dropdown">
                                                            <i class="dw dw-more"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
                                                            style="width: 650px;">
                                                            <form
                                                                action="{{ route('Kpis.staff.show', $staff->id) }}"
                                                                method="get" class="dropdown-item">
                                                                @csrf
                                                                <button type="submit"
                                                                    class="btn btn-outline-primary btn-round">{{ __('Stat') }}</button>

                                                                    <div class="form-group" style=" display: inline-block;">
                                                                        Du
                                                                     </div>
                                                                     <input type="hidden" value="stat" id="type"
                                                                     name="type">

                                                                         <div class="form-group" style=" display: inline-block;">
                                                                         <input type="date" style="width: 200px"
                                                                         name="date1" class="form-control"
                                                                         placeholder="Du">
                                                                     </div>
                                                                     <div class="form-group" style=" display: inline-block;">
                                                                        Au
                                                                     </div>
                                                                     <div class="form-group" style=" display: inline-block;">
                                                                         <input type="date"style="width: 200px"
                                                                             name="date2" class="form-control"
                                                                             placeholder="Au">
                                                                     </div>



                                                            </form>




                                                            <form action="{{  route('Kpis.staff.show', $staff->id) }}"
                                                                method="get" class="dropdown-item">
                                                                @csrf
                                                                <button type="submit"
                                                                    class="btn btn-outline-primary btn-round">{{ __('Absences ') }}</button>

                                                                <div class="form-group" style=" display: inline-block;">
                                                                   Du
                                                                </div>
                                                                    <div class="form-group" style=" display: inline-block;">
                                                                    <input type="date" style="width: 200px"
                                                                    name="date1" class="form-control"
                                                                    placeholder="Du">
                                                                </div>
                                                                <div class="form-group" style=" display: inline-block;">
                                                                   Au
                                                                </div>
                                                                <div class="form-group" style=" display: inline-block;">
                                                                    <input type="date"style="width: 200px"
                                                                        name="date2" class="form-control"
                                                                        placeholder="Au">
                                                                </div>

                                                                <input type="hidden" value="abs" id="type"
                                                                    name="type">

                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </section>





                        </main>












                    </div>
                </div>
            </div>
        </div>




        <input type="hidden" value="{{ $drivers }} " id="drivers">
        <input type="hidden" value="{{ $pParck }} " id="pParck">
        <input type="hidden" value="{{ $pCentre }} " id="pCentre">


        @include('layouts.footerforKPIindex')

    </body>

    </html>


    <script type="text/javascript">
        var drivers = parseInt($("#drivers").val());
        var pParck = parseInt($("#pParck").val());
        var pCentre = parseInt($("#pCentre").val());
        // Load google charts
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        // Draw the chart and set the chart values
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                ['Conducteur', drivers],
                ['Parc', pParck],
                ['Centre de maintenance', pCentre],

            ]);

            // Optional; add a title and set the width and height of the chart
            var options = {
                'title': 'NOMBRE TOTALE DU PERSONNEL',
                'width': 800,
                'height': 600
            };

            // Display the chart inside the <div> element with id="piechart"
            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }
    </script>





    <script>
        $("#staff_type").change(function() {
            if ($(this).val() == "Conducteur") {
                $('#conducteur_fieldDiv').show();
                $('#conducteur_field').attr('required', '');
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
            if ($(this).val() == "Personnel du centre de maintenance") {
                $('#Mstaff_fieldDiv').show();
                $('#Mstaff_field').attr('required', '');
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
            if ($(this).val() == "Personnel du parc") {
                $('#pcDiv').show();
                $('#pc').attr('required', '');
                $('#pc').attr('data-error', 'This field is required.');
            } else {
                $('#pcDiv').hide();
                $('#pc').removeAttr('required');
                $('#pc').removeAttr('data-error');
            }
        });
        $("#staff_type").trigger("change");
    </script>
    <script>
        $("#search_type").change(function() {
            if ($(this).val() == "période spécifique") {
                $('#specificDiv').show();
                $('#specific').attr('required', '');
                $('#specific').attr('data-error', 'This field is required.');
            } else {
                $('#specificDiv').hide();
                $('#specific').removeAttr('required');
                $('#specific').removeAttr('data-error');
            }
        });
        $("#staff_type").trigger("change");
    </script>



    <style type="text/css">
        @import url("https://fonts.googleapis.com/css?family=Open+Sans:400,600,700");
        @import url("https://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.css");

        *,
        *:before,
        *:after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }



        section {
            display: none;
            padding: 20px 0 0;
            border-top: 1px solid #ddd;
        }

        input {
            display: none;
        }

        label {
            display: inline-block;
            margin: 0 0 -1px;
            padding: 15px 25px;
            font-weight: 600;
            text-align: center;
            color: #bbb;
            border: 1px solid transparent;
            font-size: 1.5em;
        }

        label:before {
            font-family: fontawesome;
            font-weight: normal;
            margin-right: 10px;
            font-size: 1.5em;
        }



        label:hover {
            color: #888;
            cursor: pointer;
        }

        input:checked+label {
            color: #555;
            border: 1px solid #ddd;
            border-top: 2px solid orange;
            border-bottom: 1px solid #fff;
        }

        #tab1:checked~#content1,
        #tab2:checked~#content2,
        #tab3:checked~#content3 {
            display: block;
        }

        #tab4:checked~#content4,
        #tab5:checked~#content5,
        #tab6:checked~#content6 {
            display: block;
        }

        #tab7:checked~#content7,
        #tab8:checked~#content8 {
            display: block;
        }

        @media screen and (max-width: 650px) {
            label {
                font-size: 0;
            }

            label:before {
                margin: 0;
                font-size: 18px;
            }
        }

        @media screen and (max-width: 400px) {
            label {
                padding: 15px;
            }
        }
    </style>
@else
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://fonts.googleapis.com/css?family=Raleway:500,800" rel="stylesheet">
        <title>Document</title>
    </head>

    <body>
        <use>
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                x="0px" y="0px" viewBox="0 0 1000 1000" enable-background="new 0 0 1000 1000"
                xml:space="preserve" class="whistle">
                <metadata> Svg Vector Icons : http://www.onlinewebfonts.com/icon </metadata>
                <g>
                    <g transform="translate(0.000000,511.000000) scale(0.100000,-0.100000)">
                        <path
                            d="M4295.8,3963.2c-113-57.4-122.5-107.2-116.8-622.3l5.7-461.4l63.2-55.5c72.8-65.1,178.1-74.7,250.8-24.9c86.2,61.3,97.6,128.3,97.6,584c0,474.8-11.5,526.5-124.5,580.1C4393.4,4001.5,4372.4,4001.5,4295.8,3963.2z" />
                        <path
                            d="M3053.1,3134.2c-68.9-42.1-111-143.6-93.8-216.4c7.7-26.8,216.4-250.8,476.8-509.3c417.4-417.4,469.1-463.4,526.5-463.4c128.3,0,212.5,88.1,212.5,224c0,67-26.8,97.6-434.6,509.3c-241.2,241.2-459.5,449.9-488.2,465.3C3181.4,3180.1,3124,3178.2,3053.1,3134.2z" />
                        <path
                            d="M2653,1529.7C1644,1445.4,765.1,850,345.8-32.7C62.4-628.2,22.2-1317.4,234.8-1960.8C451.1-2621.3,947-3186.2,1584.6-3500.2c1018.6-501.6,2228.7-296.8,3040.5,515.1c317.8,317.8,561,723.7,670.1,1120.1c101.5,369.5,158.9,455.7,360,553.3c114.9,57.4,170.4,65.1,1487.7,229.8c752.5,93.8,1392,181.9,1420.7,193.4C8628.7-857.9,9900,1250.1,9900,1328.6c0,84.3-67,172.3-147.4,195.3c-51.7,15.3-790.8,19.1-2558,15.3l-2487.2-5.7l-55.5-63.2l-55.5-61.3v-344.6V719.8h-411.7h-411.7v325.5c0,509.3,11.5,499.7-616.5,494C2921,1537.3,2695.1,1533.5,2653,1529.7z" />
                    </g>
                </g>
            </svg>
        </use>
        <h1>403</h1>
        <h2>VOUS N'AVEZ PAS ACCÈS À CETTE PAGE!</h2>
    </body>

    </html>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            background: #233142;

        }

        .whistle {
            width: 20%;
            fill: #f95959;
            margin: 100px 40%;
            text-align: left;
            transform: translate(-50%, -50%);
            transform: rotate(0);
            transform-origin: 80% 30%;
            animation: wiggle .2s infinite;
        }

        @keyframes wiggle {
            0% {
                transform: rotate(3deg);
            }

            50% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(3deg);
            }
        }

        h1 {
            margin-top: -100px;
            margin-bottom: 20px;
            color: #facf5a;
            text-align: center;
            font-family: 'Raleway';
            font-size: 90px;
            font-weight: 800;
        }

        h2 {
            color: #455d7a;
            text-align: center;
            font-family: 'Raleway';
            font-size: 30px;
            text-transform: uppercase;
        }
    </style>
@endif
