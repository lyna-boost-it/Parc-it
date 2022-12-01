@if (Auth::user()->type == 'Gestionnaire parc' ||
    Auth::user()->type == 'Utilisateur' ||
    Auth::user()->type == 'Gestionnaire Sup')
    <div class="main-container" id="makepdf">
        <!DOCTYPE html>
        <html>
        @include('layouts.headForindexx')

        <body>

            @include('layouts.header-bar')
            @include('layouts.navbar')


            <div id="makepdf">

                <div class="xs-pd-20-10 pd-ltr-20">

                    <div id="test">
                        <div class="page-header">
                            <div class="row">

                                <h3>Fiche Technique du vehicule : </h3>
                                <h4 style="display: inline;color:#000000">Num D'imatriculation:</h4>
                                <h5 style="display: inline;">{{ $vehicule->marticule }} <a
                                        href="{{ route('ParkManager.vehicules.show', $vehicule->id) }}">
                                        <span class="fa fa-eye  " style="color: #3d5fbb"></span> </a></h5>

                            </div>
                        </div>






                        @php
                            $i = 0;
                        @endphp
                        @if ($dts != null)


                            @foreach ($dts as $maintenance)
                                <div class="page-header" style="background-color:#ffffff">
                                    <div class="sidenav">
                                        @php
                                            $i = $i + 1;
                                        @endphp
                                        <button class="dropdown-btn">DT: Num {{ $i }}
                                            <i class="fa fa-caret-down"></i>
                                        </button>
                                        <div class="dropdown-container">
                                            <table style=" width: 90%;border-collapse: collapse;">
                                                <tr>
                                                    <th>
                                                        <h4 style="display: inline; color:#000000">N° de la demande de
                                                            travaux
                                                            (DT)
                                                            : </h4>
                                                        <h5 style="display: inline;color:#000000">
                                                            {{ $maintenance->code_dt }}
                                                        </h5>
                                                        <br>
                                                        <h4 style="display: inline;color:#000000">Date et Heure: </h4>
                                                        <h5 style="display: inline;color:#000000">
                                                            {{ $maintenance->created_at }}
                                                        </h5>
                                                    </th>
                                                    <th>
                                                        <h4 style="display: inline;color:#000000">TYPE DE PANNE: </h4>
                                                        <h5 style="display: inline;color:#000000">
                                                            {{ $maintenance->type_panne }}
                                                        </h5>
                                                        <br>
                                                        <h4 style="display: inline;color:#000000">Nature de Panne: </h4>
                                                        <h5 style="display: inline;color:#000000">
                                                            {{ $maintenance->nature_panne }}
                                                        </h5>

                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        @foreach ($staffs as $staff)
                                                            @if ($staff->id == $maintenance->driver_id)
                                                                <h4 style="display: inline;color:#000000 ">Conducteur:
                                                                </h4>
                                                                <h5 style="display: inline;color:#000000">
                                                                    {{ $staff->name }}
                                                                    {{ $staff->last_name }}</h5>
                                                            @endif
                                                        @endforeach

                                                        <br>
                                                        @foreach ($units as $unit)
                                                            @if ($unit->id == $maintenance->unit_id)
                                                                <h4 style="display: inline;color:#000000">Affectation
                                                                    (unité)
                                                                    :
                                                                </h4>
                                                                <h5 style="display: inline;color:#000000">
                                                                    {{ $unit->name }}
                                                                </h5>
                                                            @endif
                                                        @endforeach

                                                    </th>
                                                    <th>
                                                        @if ($staff)
                                                            <h4 style="display: inline;color:#000000">Réception (Pers) :
                                                            </h4>
                                                            <h5 style="display: inline;color:#000000">
                                                                {{ $staff->name }}
                                                                {{ $staff->last_name }}</h5>
                                                        @endif

                                                        <br>
                                                        <h4 style="display: inline;color:#000000">Action d'entrée
                                                            (État):
                                                        </h4>
                                                        <h5 style="display: inline;color:#000000">
                                                            {{ $maintenance->action }}
                                                        </h5>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th>

                                                        <h4 style="display: inline;color:#000000 ">DATE ET HEURE
                                                            D’ENTREE(État):
                                                        </h4>
                                                        <h5 style="display: inline;color:#000000">
                                                            {{ $maintenance->enter_date }}
                                                            {{ $maintenance->enter_time }}</h5>
                                                        <br>
                                                        @if ($maintenance->type == 'Véhicule')
                                                            <h4 style="display: inline;color:#000000">Matricule du
                                                                véhicule:
                                                            </h4>
                                                            <h5 style="display: inline;color:#000000">
                                                                {{ $vehicule->marticule }}
                                                            </h5>
                                                        @else
                                                            <h4 style="display: inline;color:#000000">Modèle du Machine:
                                                            </h4>
                                                            <h5 style="display: inline;color:#000000">
                                                                {{ $vehicule->model }}
                                                            </h5>
                                                        @endif
                                                    </th>
                                                    <th>
                                                        @if ($maintenance->type == 'Véhicule')
                                                            <h4 style="display: inline;color:#000000">Type:
                                                                {{ $vehicule->vehicle_type }}</h4>

                                                            <h5 style="display: inline;color:#000000">
                                                                Marque: {{ $vehicule->mark }}</h5>
                                                            <br>
                                                        @else
                                                            <h4 style="display: inline;color:#000000">Type:
                                                                {{ $vehicule->type_of_machine }}</h4>

                                                            <h5 style="display: inline;color:#000000">
                                                                Marque: {{ $vehicule->mark }}</h5>
                                                            <br>
                                                        @endif
                                                        <h4 style="display: inline;color:#000000">Observation: </h4>
                                                        <h5 style="display: inline;color:#000000">
                                                            {{ $maintenance->observation }}
                                                        </h5>


                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        <h4 style="display: inline;color:#000000 ">Type de maintenance:
                                                        </h4>
                                                        <h5 style="display: inline;color:#000000">
                                                            {{ $maintenance->type_maintenance }}</h5>
                                                    </th>
                                                </tr>



                                            </table>

                                            @php
                                                $a = 0;
                                                $e = 0;
                                                $f = 0;
                                            @endphp



                                            @foreach ($repairs as $repair)
                                                @if ($maintenance->id == $repair->dt_code)
                                                    <div class="sidenav">
                                                        @php
                                                            $a = $a + 1;
                                                        @endphp
                                                        <button class="dropdown-btn">Réparation {{ $a }}:
                                                            déclaré le
                                                            {{ $repair->created_at }}
                                                            <i class="fa fa-caret-down"></i>
                                                        </button>
                                                        <div class="sidenav">


                                                            <div class="row">




                                                                <div class="col-md-6  ">
                                                                    <div class="panel">
                                                                        <div class="panel-body bio-chart">
                                                                            <h4 style="display: inline; ">Date
                                                                                d'intervention:
                                                                            </h4>
                                                                            <h5 style="display: inline;">
                                                                                {{ $repair->intervention_date }}</h5>
                                                                            <br>
                                                                            <h4 style="display: inline;"> Diagnostique:
                                                                            </h4>
                                                                            <h5 style="display: inline;">
                                                                                {{ $repair->diagnostic }}</h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6  ">
                                                                    <div class="panel">
                                                                        <div class="panel-body bio-desk">
                                                                            <h4 style="display: inline;">Personne(s)
                                                                                intervenante(s):
                                                                            </h4>
                                                                            <h5 style="display: inline;">
                                                                                @foreach ($repair_staffs as $repair_staff)
                                                                                    @foreach ($staffs as $staff)
                                                                                        @if ($repair_staff->staff_id == $staff->id && $repair_staff->repair_id == $repair->id)
                                                                                            {{ $staff->name }}
                                                                                            {{ $staff->last_name }} ,
                                                                                        @endif
                                                                                    @endforeach
                                                                                @endforeach
                                                                            </h5>
                                                                            <br>
                                                                            <h4 style="display: inline;">Pannes
                                                                                réparées:
                                                                            </h4>
                                                                            <h5 style="display: inline;">
                                                                                {{ $repair->repaired_breakdowns }}</h5>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6  ">
                                                                    <div class="panel">
                                                                        <div class="panel-body bio-chart">
                                                                            <h4 style="display: inline; ">Liquide
                                                                                consommés:
                                                                            </h4>
                                                                            <h5 style="display: inline;">
                                                                                {{ $repair->liquid }}
                                                                            </h5>
                                                                            <br>
                                                                            <h4 style="display: inline;"> Lubrifiant
                                                                                consommés:
                                                                            </h4>
                                                                            <h5 style="display: inline;">
                                                                                {{ $repair->lubricant }}</h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6  ">
                                                                    <div class="panel">
                                                                        <div class="panel-body bio-desk">
                                                                            <h4 style="display: inline;">Date et Heure
                                                                                de
                                                                                sortie: </h4>
                                                                            <h5 style="display: inline;">
                                                                                {{ $repair->end_date }}
                                                                                {{ $repair->end_time }}</h5>
                                                                            <br>
                                                                            <h4 style="display: inline;">VEHICULE: </h4>
                                                                            <h5 style="display: inline;">
                                                                                {{ $vehicule->vehicle_type }}
                                                                            </h5>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6  ">
                                                                    <div class="panel">
                                                                        <div class="panel-body bio-chart">
                                                                            <h4 style="display: inline; ">Numéro de
                                                                                Série:
                                                                            </h4>
                                                                            <h5 style="display: inline;">
                                                                                {{ $vehicule->code }}
                                                                            </h5>
                                                                            <br>
                                                                            <h4 style="display: inline;"> Date
                                                                                d'acquisition:
                                                                            </h4>
                                                                            <h5 style="display: inline;">
                                                                                {{ $vehicule->acquisition_date }}</h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6  ">
                                                                    <div class="panel">
                                                                        <div class="panel-body bio-desk">
                                                                            <h4 style="display: inline;">Observation:
                                                                            </h4>
                                                                            <h5 style="display: inline;">
                                                                                {{ $repair->observation }}
                                                                            </h5>
                                                                            <br>
                                                                            @foreach ($staffs as $staff)
                                                                                @if ($staff->id == $repair->driver_id)
                                                                                    <h4 style="display: inline;">
                                                                                        Conducteur
                                                                                        (sortie)
                                                                                        :
                                                                                    </h4>
                                                                                    <h5 style="display: inline;">
                                                                                        {{ $staff->name }}
                                                                                        {{ $staff->last_name }}</h5>
                                                                                @endif
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <br><br>
                                                                <div class="col-md-6  ">
                                                                    <div class="panel">
                                                                        <div class="panel-body bio-desk">
                                                                            <br><br><br>
                                                                            <h4>Pièces consommées:<br> </h4>
                                                                            <div>
                                                                                @foreach ($rps as $rp)
                                                                                    @if ($rp->repair_id == $repair->id)
                                                                                        @foreach ($designations as $designation)
                                                                                            @foreach ($marks as $mark)
                                                                                                @if ($rp->type == $designation->id && $rp->marque == $mark->id)
                                                                                                    <div
                                                                                                        class="sidenav">

                                                                                                        <button
                                                                                                            class="dropdown-btn">Marque:{{ $designation->name }}</b>
                                                                                                            <i
                                                                                                                class="fa fa-caret-down"></i>
                                                                                                        </button>
                                                                                                        <div
                                                                                                            class="dropdown-container">
                                                                                                            <table
                                                                                                                style=" width: 90%;border-collapse: collapse;">
                                                                                                                <tr>
                                                                                                                    <th>
                                                                                                                        <h4>Reference:{{ $rp->reference }}
                                                                                                                        </h4>


                                                                                                                    </th>
                                                                                                                    <th>
                                                                                                                        <h4> Quantite:
                                                                                                                            {{ $rp->quantity }}
                                                                                                                        </h4>
                                                                                                                    </th>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <th>
                                                                                                                        <h4>prix:
                                                                                                                            {{ $rp->price }}
                                                                                                                        </h4>
                                                                                                                    </th>
                                                                                                                    <th>
                                                                                                                        <h4>Prix
                                                                                                                            total:
                                                                                                                            {{ $rp->full_price }}
                                                                                                                        </h4>
                                                                                                                    </th>
                                                                                                                </tr>
                                                                                                            </table>



                                                                                                        </div>
                                                                                                    </div>
                                                                                                @endif
                                                                                            @endforeach
                                                                                        @endforeach
                                                                                    @endif
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                @endif
                                            @endforeach

                                            @foreach ($externals as $external)
                                                @if ($maintenance->id == $external->dt_code)
                                                    <div class="sidenav">
                                                        @php
                                                            $e = $e + 1;
                                                        @endphp
                                                        <button class="dropdown-btn">Maintenance externe: Num
                                                            {{ $e }}
                                                            <i class="fa fa-caret-down"></i>
                                                        </button>
                                                        <div class="sidenav">

                                                            <div class="row">
                                                                <div class="col-md-6  ">
                                                                    <div class="panel">
                                                                        <div class="panel-body bio-chart">
                                                                            <h4 style="display: inline; ">Contrat:
                                                                            </h4>
                                                                            <h5 style="display: inline;">
                                                                                {{ $external->contract }} </h5>
                                                                            <br>
                                                                            @foreach ($garanties as $guaranti)
                                                                                @if ($external->supplier_id == $guaranti->id)
                                                                                    <h4 style="display: inline;">
                                                                                        fournisseur: </h4>
                                                                                    <h5 style="display: inline;">
                                                                                        {{ $guaranti->name_vendor }}
                                                                                    </h5>
                                                                                @endif
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6  ">
                                                                    <div class="panel">
                                                                        <div class="panel-body bio-desk">
                                                                            <h4 style="display: inline;">Date
                                                                                d'entrée:
                                                                            </h4>
                                                                            <h5 style="display: inline;">
                                                                                {{ $external->start_date }}
                                                                            </h5>
                                                                            <br>
                                                                            <h4 style="display: inline;">Date de
                                                                                sortie:
                                                                            </h4>
                                                                            <h5 style="display: inline;">
                                                                                {{ $external->end_date }}
                                                                            </h5>

                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6  ">
                                                                    <div class="panel">
                                                                        <div class="panel-body bio-chart">
                                                                            <h4 style="display: inline; ">Type de
                                                                                panne:
                                                                            </h4>
                                                                            <h5 style="display: inline;">
                                                                                {{ $external->panne_type }}
                                                                            </h5>
                                                                            <br>
                                                                            <h4 style="display: inline;">Pièces
                                                                                rechangées:
                                                                            </h4>
                                                                            <h5 style="display: inline;">
                                                                                {{ $external->changed_piece }} </h5>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6  ">
                                                                    <div class="panel">
                                                                        <div class="panel-body bio-chart">
                                                                            <h4 style="display: inline; ">Coût:
                                                                            </h4>
                                                                            <h5 style="display: inline;">
                                                                                {{ $external->price }}
                                                                            </h5>

                                                                        </div>
                                                                    </div>
                                                                </div>




                                                            </div>

                                                        </div>


                                                    </div>
                                                @endif
                                            @endforeach


                                            @foreach ($maintenances as $m)
                                                @if ($maintenance->id == $m->dt_code)
                                                    <div class="sidenav">
                                                        @php
                                                            $f = $f + 1;
                                                        @endphp
                                                        <button class="dropdown-btn">Entretien {{ $f }}:
                                                            déclaré le
                                                            {{ $m->created_at }}
                                                            <i class="fa fa-caret-down"></i>
                                                        </button>
                                                        <div class="sidenav">

                                                            <div class="row">
                                                                <div class="col-md-6  ">
                                                                    <div class="panel">
                                                                        <div class="panel-body bio-chart">
                                                                            <h4 style="display: inline; ">Désignation:
                                                                            </h4>
                                                                            <h5 style="display: inline;">
                                                                                {{ $m->designation }} </h5>
                                                                            <br>
                                                                            <h4 style="display: inline;">KM: </h4>
                                                                            <h5 style="display: inline;">
                                                                                {{ $m->km }} </h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6  ">
                                                                    <div class="panel">
                                                                        <div class="panel-body bio-desk">
                                                                            <h4 style="display: inline;">Personne(s)
                                                                                intervenante(s):
                                                                            </h4>
                                                                            <h5 style="display: inline;">
                                                                                @foreach ($maintenance_staffs as $maintenance_staff)
                                                                                    @foreach ($staffs as $staff)
                                                                                        @if ($maintenance_staff->staff_id == $staff->id && $maintenance_staff->maintenance_id == $m->id)
                                                                                            {{ $staff->name }}
                                                                                            {{ $staff->last_name }} ,
                                                                                        @endif
                                                                                    @endforeach
                                                                                @endforeach
                                                                            </h5>
                                                                            <br>
                                                                            <h4 style="display: inline;">Liquide
                                                                                consommés:
                                                                            </h4>
                                                                            <h5 style="display: inline;">
                                                                                {{ $m->liquid }}
                                                                            </h5>

                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6  ">
                                                                    <div class="panel">
                                                                        <div class="panel-body bio-chart">
                                                                            <h4 style="display: inline; ">Lubrifiant
                                                                                consommés:
                                                                            </h4>
                                                                            <h5 style="display: inline;">
                                                                                {{ $m->lubricant }}
                                                                            </h5>
                                                                            <br>

                                                                            @foreach ($staffs as $staff)
                                                                                @if ($staff->id == $m->driver_id)
                                                                                    <h4 style="display: inline;">
                                                                                        Conducteur
                                                                                        (sortie)
                                                                                        :
                                                                                    </h4>
                                                                                    <h5 style="display: inline;">
                                                                                        {{ $staff->name }}
                                                                                        {{ $staff->last_name }} </h5>
                                                                                @endif
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>




                                                            </div>


                                                        </div>

                                                    </div>
                                                @endif
                                            @endforeach


                                        </div>
                                    </div>







                                </div>
                            @endforeach


                        @endif

                    </div>
                </div>
            </div>
            <br> <button id="button" class="btn btn-warning btn-round"><span class="fa fa-print  "
                    style="color: #000000">
                </span> Imprimer</button>


            <style>
                body {
                    font-family: "Lato", sans-serif;
                }



                /* Style the sidenav links and the dropdown button */
                .sidenav a,
                .dropdown-btn {
                    padding: 6px 8px 6px 16px;
                    text-decoration: none;
                    font-size: 20px;
                    color: #818181;
                    display: block;
                    border: none;
                    background: none;
                    width: 100%;
                    text-align: left;
                    cursor: pointer;
                    outline: none;
                }



                /* Main content */
                .main {
                    margin-left: 200px;
                    /* Same as the width of the sidenav */
                    font-size: 20px;
                    /* Increased text to enable scrolling */
                    padding: 0px 10px;
                }



                /* Dropdown container (hidden by default). Optional: add a lighter background color and some left padding to change the design of the dropdown content */
                .dropdown-container {
                    display: none;

                    padding-left: 8px;
                }



                /* Some media queries for responsiveness */
                @media screen and (max-height: 450px) {
                    .sidenav {
                        padding-top: 15px;




                        .sidenav a {
                            font-size: 18px;
                        }
                    }
            </style>

            <script>
                /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
                var dropdown = document.getElementsByClassName("dropdown-btn");
                var i;

                for (i = 0; i < dropdown.length; i++) {
                    dropdown[i].addEventListener("click", function() {
                        this.classList.toggle("active");
                        var dropdownContent = this.nextElementSibling;
                        if (dropdownContent.style.display === "block") {
                            dropdownContent.style.display = "none";
                        } else {
                            dropdownContent.style.display = "block";
                        }
                    });
                }
            </script>

            @include('layouts.footerForIndexx')
    </div>




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
