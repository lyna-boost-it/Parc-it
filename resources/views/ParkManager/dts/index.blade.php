@if (Auth::user()->type == 'Gestionnaire parc' ||
    Auth::user()->type == 'Utilisateur' ||
    Auth::user()->type == 'Demandeur' ||
    Auth::user()->type == 'Gestionnaire Sup')


    <!DOCTYPE html>
    <html>
    @include('layouts.headForindexx')

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

                                <h3 style="color:#EE643A; ">Gestion des demandes de réparation
                                </h3>
                            </div>

                        </div>

                    </div>
                </div>



                <div class="card-box mb-30">
                    <div class="pd-20">
                        <a style="background:#EE643A;color:#ffffff;float: right;
                        @if (Auth::user()->type == 'Gestionnaire Sup') color: currentColor;
                                cursor: not-allowed;
                                opacity: 0.5;
                                text-decoration: none; @endif
                                                        "
                            href="{{ route('ParkManager.dts.create') }}" class="btn btn-sm  "
                            @if (Auth::user()->type == 'Gestionnaire Sup') disabled @endif>
                            Créer une demande
                        </a>

                    </div>
                    <div class="pb-20 table_container">

                        <table class="table_moving table nowrap hover data-table-export">
                            <div id="table_for_stuff">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Type</th>

                                        <th>TYPE DE PANNE</th>
                                        <th>Type de Maintenance</th>
                                        <th>Action d'entrée</th>
                                        <th>DATE ET HEURE D'ENTREE</th>
                                        <th>Etat</th>


                                        <th class="datatable-nosort">Action</th>

                                    </tr>
                                </thead>




                                <tbody>
                                    @foreach ($maintenances as $maintenance)
                                        @foreach ($vehicules as $vehicule)
                                            @if ($maintenance->vehicle_id == $vehicule->id)
                                                <tr
                                                    style="background-color:
                                                          @if ($maintenance->state == 'en instance') #ffc0003b @endif


                                                    @if ($maintenance->state == 'en cours') #73eb9229 @endif
                                                         @if ($maintenance->state == 'en attente') #ff48002b @endif

                                                      ">

                                                    <td>{{ $maintenance->code_dt }}</td>
                                                    <td>{{ $maintenance->type }}</td>

                                                    <td>{{ $maintenance->type_panne }}</td>
                                                    <td>{{ $maintenance->type_maintenance }}</td>
                                                    <td>{{ $maintenance->action }}</td>
                                                    <td>{{ $maintenance->enter_date }} {{ $maintenance->enter_time }}
                                                    <td><b>
                                                            @if ($maintenance->state == 'en attente')
                                                                Envoyée
                                                            @endif
                                                            @if ($maintenance->state == 'en instance')
                                                            En instance
                                                                @endif @if ($maintenance->state == 'en cours')
                                                                    {{ $maintenance->state }}
                                                                @endif
                                                        </b></td>


                                                    <td>
                                                        <div class="dropdown">
                                                            @if ($maintenance->answer == 'en attente' && Auth::user()->type == 'Gestionnaire parc')
                                                                <div style=" display: inline-block;">
                                                                    @if ($maintenance->answer == 'en attente' && Auth::user()->type != 'Gestionnaire Sup')
                                                                        <form style="display: inline;"
                                                                            action="{{ route('ParkManager.validation.createV', $maintenance->id) }}"
                                                                            method="get" class="dropdown-item">
                                                                            @csrf

                                                                            <button type="submit"
                                                                                style=" display: inline;background-color: transparent; border-color: transparent;">
                                                                                <input type="hidden" value="Vehicule"
                                                                                    id="type" name="type">
                                                                                <input type="hidden" value="accepted"
                                                                                    id="valide" name="valide">

                                                                                <span class="hovertext"
                                                                                    data-hover="Accepté">
                                                                                    <i class="dw dw-check"
                                                                                        style="color: green"></i></span>
                                                                            </button>
                                                                        </form>
                                                                    @endif
                                                                    @endif
                                                                    @if ($maintenance->answer == 'en attente' || $maintenance->answer == 'en instance')
                                                                    <form style="display: inline;"
                                                                        action="{{ route('ParkManager.validation.archive', $maintenance->id) }}"
                                                                        method="get" class="dropdown-item">
                                                                        @csrf

                                                                        <button type="submit"
                                                                            style="display: inline; background-color: transparent; border-color: transparent;"
                                                                            onclick="return confirm('êtes-vous sûr?')">


                                                                            <span class="hovertext"
                                                                                data-hover="Archivé">
                                                                                <i class="fas fa-archive  "
                                                                                    style="color: red"></i>
                                                                            </span>
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            @endif
                                                            <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                                href="#" role="button" data-toggle="dropdown">
                                                                <i class="dw dw-more"></i>
                                                            </a>
                                                            <div
                                                                class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">


                                                                <a class="dropdown-item"
                                                                    href="{{ route('ParkManager.dts.show', $maintenance->id) }}"><i
                                                                        class="dw dw-eye"></i> Consulter</a>


                                                                @if (Auth::user()->type == 'Gestionnaire Sup')
                                                                @else
                                                                    @if ($maintenance->state == 'en instance')
                                                                        @if (Auth::user()->type != 'Demandeur')
                                                                            <form class="form-delete dropdown-item"
                                                                                method="get"
                                                                                action="{{ route('ParkManager.validation.createV', $maintenance->id) }}">

                                                                                @csrf
                                                                                <input type="hidden" value="Vehicule"
                                                                                    id="type" name="type">
                                                                                <input type="hidden" value="accepted"
                                                                                    id="valide" name="valide">
                                                                                <button type="submit"
                                                                                    style=" background-color: transparent;
                                                                             border-color: transparent;">

                                                                                    <i class="dw dw-edit2"></i>2eme
                                                                                    Traitement

                                                                                </button>
                                                                            </form>
                                                                        @endif
                                                                    @endif
                                                                    @if ($maintenance->state == 'en cours')
                                                                        @if (Auth::user()->type != 'Demandeur')
                                                                            <form class="form-delete dropdown-item"
                                                                                method="get"
                                                                                action="{{ route('ParkManager.validation.choose1', $maintenance->id) }}">

                                                                                @csrf
                                                                                <button type="submit"
                                                                                    style=" background-color: transparent;
                                                                                     border-color: transparent;">

                                                                                    <i class="dw dw-delete-3"></i>Sortie

                                                                                </button>
                                                                            </form>
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </td>





                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach

                                        @foreach ($materials as $material)
                                            @if ($maintenance->vehicle_id == $material->id)
                                                <tr
                                                    style="background-color:
                                                @if ($maintenance->state == 'en instance') #ffc0003b @endif


                                          @if ($maintenance->state == 'en cours') #73eb9229 @endif
                                               @if ($maintenance->state == 'en attente') #ff48002b @endif

                                            ">

                                                    <td>{{ $maintenance->code_dt }}</td>
                                                    <td>{{ $maintenance->type }}</td>

                                                    <td>{{ $maintenance->type_panne }}</td>
                                                    <td>{{ $maintenance->type_maintenance }}</td>
                                                    <td>{{ $maintenance->action }}</td>
                                                    <td>{{ $maintenance->enter_date }} {{ $maintenance->enter_time }}
                                                    <td><b>
                                                            @if ($maintenance->state == 'en attente')
                                                                Envoyée
                                                            @endif
                                                            @if ($maintenance->state == 'en instance')
                                                                Traitée
                                                                @endif @if ($maintenance->state == 'en cours')
                                                                    {{ $maintenance->state }}
                                                                @endif


                                                        </b></td>


                                                    <td>
                                                        <div class="dropdown">
                                                            @if ($maintenance->answer == 'en attente' && Auth::user()->type != 'Gestionnaire Sup')
                                                                <div style=" display: inline-block;">
                                                                    @if (Auth::user()->type != 'Demandeur')
                                                                        <form style="display: inline;"
                                                                            action="{{ route('ParkManager.validation.createV', $maintenance->id) }}"
                                                                            method="get" class="dropdown-item">
                                                                            @csrf

                                                                            <button type="submit"
                                                                                style=" display: inline;background-color: transparent; border-color: transparent;">
                                                                                <input type="hidden" value="Vehicule"
                                                                                    id="type" name="type">
                                                                                <input type="hidden" value="accepted"
                                                                                    id="valide" name="valide">

                                                                                <span class="hovertext"
                                                                                    data-hover="Accepté">
                                                                                    <i class="dw dw-check"
                                                                                        style="color: green"></i></span>
                                                                            </button>
                                                                        </form>
                                                                    @endif    @endif
                                                                    @if ($maintenance->answer == 'en attente'|| $maintenance->answer == 'en instance')
                                                                    <form class="form-delete dropdown-item"
                                                                        method="post"
                                                                        action="{{ route('ParkManager.validation.destroy', $maintenance->id) }}">
                                                                        @method('DELETE')
                                                                        @csrf
                                                                        <button type="submit"
                                                                            style="display: inline; background-color: transparent; border-color: transparent;
                                                                            "  onclick="return confirm('êtes-vous sûr?')">
                                                                            <input type="hidden" value="Vehicule"
                                                                                id="type" name="type">
                                                                            <input type="hidden" value="Refusée"
                                                                                id="valide" name="valide"
                                                                                onclick="return confirm('êtes-vous sûr?')">

                                                                            <span class="hovertext"
                                                                                data-hover="Archivé">
                                                                                <i class="fas fa-archive  "
                                                                                    style="color: red"></i>
                                                                            </span>
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            @endif
                                                            <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                                href="#" role="button" data-toggle="dropdown">
                                                                <i class="dw dw-more"></i>
                                                            </a>
                                                            <div
                                                                class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">


                                                                <a class="dropdown-item"
                                                                    href="{{ route('ParkManager.dts.show', $maintenance->id) }}"><i
                                                                        class="dw dw-eye"></i> Consulter</a>


                                                                @if (Auth::user()->type == 'Gestionnaire Sup')
                                                                @else
                                                                    @if ($maintenance->state == 'en instance')
                                                                        @if (Auth::user()->type != 'Demandeur')
                                                                            <form class="form-delete dropdown-item"
                                                                                method="get"
                                                                                action="{{ route('ParkManager.validation.createV', $maintenance->id) }}">

                                                                                @csrf
                                                                                <input type="hidden" value="Vehicule"
                                                                                    id="type" name="type">
                                                                                <input type="hidden" value="accepted"
                                                                                    id="valide" name="valide">
                                                                                <button type="submit"
                                                                                    style=" background-color: transparent;
                                                                         border-color: transparent;">

                                                                                    <i class="dw dw-edit2"></i>2eme
                                                                                    Traitement

                                                                                </button>
                                                                            </form>
                                                                        @endif
                                                                    @endif
                                                                    @if ($maintenance->state == 'en cours')
                                                                        @if (Auth::user()->type != 'Demandeur')
                                                                            <form class="form-delete dropdown-item"
                                                                                method="get"
                                                                                action="{{ route('ParkManager.validation.choose1', $maintenance->id) }}">

                                                                                @csrf
                                                                                <button type="submit"
                                                                                    style=" background-color: transparent;
                                                                                 border-color: transparent;">

                                                                                    <i
                                                                                        class="dw dw-delete-3"></i>Sortie

                                                                                </button>
                                                                            </form>
                                                                        @endif
                                                                    @endif
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
                            </div>
                        </table>


                    </div>
                </div>
                <div class="page-header">

                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="title">

                                <h3 style="color:#EE643A; ">Liste des demandes déjà faites
                                </h3>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="card-box mb-30">
                    <div class="pd-20">


                    </div>
                    <div class="pb-20 table_container">

                        <table class="table_moving table nowrap hover data-table-export">
                            <div id="table_for_stuff">
                                <thead>
                                    <tr>
                                        <th>ID</th>

                                        <th>Type </th>

                                        <th>TYPE DE PANNE</th>
                                        <th>NATURE DE PANNE</th>
                                        <th>Type de Maintenance</th>
                                    <th>DATE ET HEURE DE SORTIE</th>



                                        <th class="datatable-nosort">Action</th>

                                    </tr>
                                </thead>




                                <tbody>
                                    @foreach ($maintenances_done as $maintenance)
                                        @foreach ($vehicules as $vehicule)
                                            @if ($maintenance->vehicle_id == $vehicule->id)
                                                <tr>

                                                    <td>{{ $maintenance->code_dt }}</td>

                                                    <td>{{ $maintenance->type }}</td>
                                                    <td>{{ $maintenance->type_panne }}</td>
                                                     <td>{{ $maintenance->nature_panne }}</td>
                                                    <td>{{ $maintenance->type_maintenance }}</td>

                                                    <td>{{ $maintenance->updated_at }}



                                                    <td>
                                                        <div class="dropdown">

                                                            <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                                href="#" role="button" data-toggle="dropdown">
                                                                <i class="dw dw-more"></i>
                                                            </a>
                                                            <div
                                                                class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">


                                                                <a class="dropdown-item"
                                                                    href="{{ route('ParkManager.dts.show', $maintenance->id) }}"><i
                                                                        class="dw dw-eye"></i> Consulter</a>


                                                            </div>
                                                        </div>
                                                    </td>




                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach


                                        @foreach ($materials as $material)
                                            @if ($maintenance->vehicle_id == $material->id)
                                                <tr>

                                                    <td>{{ $maintenance->code_dt }}</td>

                                                    <td>{{ $maintenance->type }}</td>
                                                    <td>{{ $maintenance->type_panne }}</td>
                                                      <td>{{ $maintenance->nature_panne }}</td>
                                                    <td>{{ $maintenance->type_maintenance }}</td>
                                                     <td>{{ $maintenance->updated_at }}



                                                    <td>
                                                        <div class="dropdown">

                                                            <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                                href="#" role="button" data-toggle="dropdown">
                                                                <i class="dw dw-more"></i>
                                                            </a>
                                                            <div
                                                                class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">


                                                                <a class="dropdown-item"
                                                                    href="{{ route('ParkManager.dts.show', $maintenance->id) }}"><i
                                                                        class="dw dw-eye"></i> Consulter</a>


                                                            </div>
                                                        </div>
                                                    </td>




                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endforeach

                                </tbody>
                            </div>
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











        .hovertext {
            position: relative;
            border-bottom: 2px dotted black;
        }

        .hovertext:hover:before {
            opacity: 3;
            visibility: visible;
        }
    </style>
@endif
