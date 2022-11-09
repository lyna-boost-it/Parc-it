@if (Auth::user()->type == 'Gestionnaire parc' ||
    Auth::user()->type == 'Utilisateur' ||
    Auth::user()->type == 'Gestionnaire Sup')

    <!DOCTYPE html>
    <html>
    @include('layouts.headForindex')

    <body>

        @include('layouts.header-bar')
        @include('layouts.navbar')

        <div class="mobile-menu-overlay"></div>

        <div class="main-container">
            <div class="xs-pd-20-10 pd-ltr-20">
                <div class="page-header">
                    @include('inc.flash')
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="title">
                                <h3 style="color:#EE643A; ">Gestion des Pointages</h3>
                            </div>

                        </div>

                    </div>
                </div>



                <div class="card-box mb-30">
                    <div class="pd-20">


                    </div>
                    <div class="pb-20">

                        <table class="table nowrap hover data-table-export">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nom Et Prénom</th>
                                    <th>Matricule P</th>
                                    <th>Type du personnel</th>
                                    <th>Affectation</th>
                                     <th>Fonction</th>
                                    <th>État</th>
                                    <th class="datatable-nosort">Action</th>



                                </tr>
                            </thead>




                            <tbody>
                                @foreach ($staffs as $staff)
                                    @foreach ($units as $unit)
                                        @if ($unit->id == $staff->unit_id)
                                            <tr>
                                                <td>{{ $staff->id }}</td>
                                                <td>{{ $staff->name }} {{ $staff->last_name }}</td>
                                                <td>{{ $staff->serial_numbers }}</td>
                                                <td>{{ $staff->person_type }}</td>
                                                <td>{{ $unit->name }}</td>
                                                <td>{{ $staff->function }}</td>

                                                <td>
                                                    <div class="col-xs-4"
                                                        style="padding-right: 5px;
                                                padding-left: 5px;font-size:18px;">


                                                        @if ($staff->staff_state == 'absent')
                                                            <span class="fa fa-sticky-note " style="color: #3da8bb;  ">
                                                            </span> <span style="color: #3da8bb;  ">
                                                                Absent
                                                            </span>
                                                        @endif
                                                        @if ($staff->staff_state == 'en mission')
                                                            <span class="fa fa-sticky-note " style="color: #543dbb; ">
                                                            </span> <span style="color: #543dbb; ">
                                                                en mission
                                                            </span>
                                                        @endif
                                                        @if ($staff->staff_state == 'pas au travail')
                                                            <span class="fa fa-sticky-note " style=" font-size:14px;    color: #c73939;
    font-weight: 600;">
                                                            </span> <span style="font-size:14px; color: #c73939;    font-weight: 600; "><b>Pas-présent</b>
                                                            </span>
                                                        @endif
                                                        @if ($staff->staff_state == 'au travail')
                                                            <span class="fa fa-sticky-note " style="color: #148a5d;
    font-weight: 600;font-size:14px;   ">
                                                            </span> <span style="color: #148a5d;
    font-weight: 600;font-size:14px; "> Au travail</span>
                                                        @endif
                                                    </div>
                                                </td>




                                                <td>
                                                    <div class="dropdown">
                                                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                            href="#" role="button" data-toggle="dropdown">
                                                            <i class="dw dw-more"></i>
                                                        </a>
                                                        <div
                                                            class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">

                                                            @if ($staff->staff_state == 'pas au travail' || $staff->staff_state == 'en mission')
                                                                <a class="dropdown-item" style="color: #4cbb3d; font-size:18px;"
                                                                    href="{{ route('ParkManager.attendances.createAttendance', $staff->id) }}"
                                                                    @if (Auth::user()->type == 'Gestionnaire Sup') style="  color: currentColor;
                                                                    cursor: not-allowed;
                                                                    opacity: 0.5;
                                                                    text-decoration: none;" @endif>
                                                                    <span class="fa fa-check-square  " >

                                                                    </span> Marquer la présence</a>
                                                            @endif



                                                            @if ($staff->staff_state == 'au travail')
                                                                @foreach ($attendences as $attendence)
                                                                    @if ($attendence->staff_id == $staff->id)
                                                                        <a class="dropdown-item"style="color: #bb3d3d; font-size:18px;"
                                                                            href="{{ route('ParkManager.attendances.editAttendance', $attendence->id) }}"
                                                                            @if (Auth::user()->type == 'Gestionnaire Sup') style="  color: currentColor;
                                                                            cursor: not-allowed;
                                                                            opacity: 0.5;
                                                                            text-decoration: none;" @endif>
                                                                            <span class="fa fa-sign-out  " >

                                                                            </span>  marquer la sortie</a>
                                                                    @endif
                                                                @endforeach
                                                            @endif


                                                        </div>
                                                    </div>




                                                </td>






                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endforeach


                            </tbody>
                        </table>


                    </div>
                </div>

                @include('layouts.footerForIndexx')

    </body>

    </html>
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
