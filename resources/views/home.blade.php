<!DOCTYPE html>
<html>
@include('layouts.headForHome')

<body>
    {{-- <div class="pre-loader">
            <div class="pre-loader-box">
                <div class="loader-logo">
                    <img src="{{URL('assets/vendors/images/logo-10.png')}}"; alt="" />
                </div>
                <div class="loader-progress" id="progress_div">
                    <div class="bar" id="bar1"></div>
                </div>
                <div class="percent" id="percent1">0%</div>
                <div class="loading-text">Chargement...</div>
            </div>
        </div> --}}
    @include('layouts.header-bar')
    @include('layouts.navbar')

    <div class="mobile-menu-overlay"></div>

    <div class="main-container">
        <div class="xs-pd-20-10 pd-ltr-20">



{{ Absence_cheker() }}




            <div class="card-box pd-20 height-100-p mb-30">
                <div class="row align-items-center">
                    <div class="col-md-2">
                        <img src="{{ URL('assets/vendors/images/edeval.png') }}"; alt="" />
                    </div>
                    <div class="col-md-8">
                        <h4 class="font-20 weight-500 mb-10 text-capitalize">

                            <div class="weight-600 font-30 text-green">EPIC EDEVAL</div>
                        </h4>
                        <p class="font-18 max-width-600">
                            Bienvenue sur le tableau de bord Parc'it
                        </p>
                    </div>
                </div>
            </div>
            <div class="row pb-10">
                <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                    <div class="card-box height-100-p widget-style3">
                        <div class="d-flex flex-wrap">
                            <div class="widget-data">
                                <div class="weight-700 font-24 text-dark"><h3>{{ DB::table('vehicules')->count() }}</h3></div>
                                <div class="font-14 text-secondary weight-500">
                                   <h3>  Véhicules</h3>
                                </div>
                            </div>
                            <div class="widget-icon">
                                <div class="icon" data-color="#00eccf">
                                    <i class="icon-copy dw dw-car"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                    <div class="card-box height-100-p widget-style3">
                        <div class="d-flex flex-wrap">
                            <div class="widget-data">
                                <div class="weight-700 font-24 text-dark"><h3>{{ DB::table('staff')->where('person_type', '=', 'Conducteur')->count() }}</h3></div>
                                <div class="font-14 text-secondary weight-500">
                                    <h3>  Conducteurs</h3>
                                </div>
                            </div>
                            <div class="widget-icon">
                                <div class="icon" data-color="#ff5b5b">
                                    <i class="fas fa-user"></i>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                    <div class="card-box height-100-p widget-style3">
                        <div class="d-flex flex-wrap">
                            <div class="widget-data">
                                <div class="weight-700 font-24 text-dark"><h3> {{ DB::table('materials')->count() }}</h3></div>
                                <div class="font-14 text-secondary weight-500">
                                    <h3>  Matériels Motorisés</h3>
                                </div>
                            </div>
                            <div class="widget-icon">
                                <div class="icon">
                                    <i class="fas fa-truck-monster"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                    <div class="card-box height-100-p widget-style3">
                        <div class="d-flex flex-wrap">
                            <div class="widget-data">
                                <div class="weight-700 font-24 text-dark"><h3> {{ DB::table('staff')->count() }}</h3></div>
                                <div class="font-14 text-secondary weight-500">  <h3>Personnels<h3></div>
                            </div>
                            <div class="widget-icon">
                                <div class="icon" data-color="#09cc06">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>











            <div>
                <input type="hidden"
                    value="{{ DB::table('missions')->whereMonth('created_at', '01')->where('mission_state', '=', 'en cours')->count() }} "
                    id="jan">

                <input type="hidden"
                    value="{{ DB::table('missions')->whereMonth('created_at', '02')->where('mission_state', '=', 'en cours')->count() }} "
                    id="feb">

                <input type="hidden"
                    value="{{ DB::table('missions')->whereMonth('created_at', '03')->where('mission_state', '=', 'en cours')->count() }} "
                    id="mar">

                <input type="hidden"
                    value="{{ DB::table('missions')->whereMonth('created_at', '04')->where('mission_state', '=', 'en cours')->count() }} "
                    id="apr">

                <input type="hidden"
                    value="{{ DB::table('missions')->whereMonth('created_at', '05')->where('mission_state', '=', 'en cours')->count() }} "
                    id="may">

                <input type="hidden"
                    value="{{ DB::table('missions')->whereMonth('created_at', '06')->where('mission_state', '=', 'en cours')->count() }} "
                    id="jun">
                <input type="hidden"
                    value="{{ DB::table('missions')->whereMonth('created_at', '07')->where('mission_state', '=', 'en cours')->count() }} "
                    id="jul">

                <input type="hidden"
                    value="{{ DB::table('missions')->whereMonth('created_at', '08')->where('mission_state', '=', 'en cours')->count() }} "
                    id="aug">

                <input type="hidden"
                    value="{{ DB::table('missions')->whereMonth('created_at', '09')->where('mission_state', '=', 'en cours')->count() }} "
                    id="sep">

                <input type="hidden"
                    value="{{ DB::table('missions')->whereMonth('created_at', '10')->where('mission_state', '=', 'en cours')->count() }} "
                    id="oct">

                <input type="hidden"
                    value="{{ DB::table('missions')->whereMonth('created_at', '11')->where('mission_state', '=', 'en cours')->count() }} "
                    id="nov">

                <input type="hidden"
                    value="{{ DB::table('missions')->whereMonth('created_at', '12')->where('mission_state', '=', 'en cours')->count() }} "
                    id="dec">





                <input type="hidden"
                    value="{{ DB::table('missions')->whereMonth('created_at', '01')->where('mission_state', '=', 'fait')->count() }} "
                    id="jan1">

                <input type="hidden"
                    value="{{ DB::table('missions')->whereMonth('created_at', '02')->where('mission_state', '=', 'fait')->count() }} "
                    id="feb1">

                <input type="hidden"
                    value="{{ DB::table('missions')->whereMonth('created_at', '03')->where('mission_state', '=', 'fait')->count() }} "
                    id="mar1">

                <input type="hidden"
                    value="{{ DB::table('missions')->whereMonth('created_at', '04')->where('mission_state', '=', 'fait')->count() }} "
                    id="apr1">

                <input type="hidden"
                    value="{{ DB::table('missions')->whereMonth('created_at', '05')->where('mission_state', '=', 'fait')->count() }} "
                    id="may1">

                <input type="hidden"
                    value="{{ DB::table('missions')->whereMonth('created_at', '06')->where('mission_state', '=', 'fait')->count() }} "
                    id="jun1">
                <input type="hidden"
                    value="{{ DB::table('missions')->whereMonth('created_at', '07')->where('mission_state', '=', 'fait')->count() }} "
                    id="jul1">

                <input type="hidden"
                    value="{{ DB::table('missions')->whereMonth('created_at', '08')->where('mission_state', '=', 'fait')->count() }} "
                    id="aug1">

                <input type="hidden"
                    value="{{ DB::table('missions')->whereMonth('created_at', '09')->where('mission_state', '=', 'fait')->count() }} "
                    id="sep1">

                <input type="hidden"
                    value="{{ DB::table('missions')->whereMonth('created_at', '10')->where('mission_state', '=', 'fait')->count() }} "
                    id="oct1">

                <input type="hidden"
                    value="{{ DB::table('missions')->whereMonth('created_at', '11')->where('mission_state', '=', 'fait')->count() }} "
                    id="nov1">

                <input type="hidden"
                    value="{{ DB::table('missions')->whereMonth('created_at', '12')->where('mission_state', '=', 'fait')->count() }} "
                    id="dec1">
            </div>





        </div>

        <div class="row">


            <div class="col-md-6 mb-20">
                <div class="card-box height-100-p pd-20">
                    <div class="card-box min-height-200px pd-20 mb-20" data-bgcolor="#455a64"
                        style=" display: flex;">

                        <div class="icon h1 text-white"
                            style="border-right: 50px solid transparent;border-left: 140px solid transparent;">
                            <i class="icon-copy fa fa-vcard" aria-hidden="true"></i>
                            <div class="font-14">Conducteurs <br> en mission</div>
                            <div class="font-24 weight-500">
                                {{ DB::table('staff')->where('staff_state', '=', 'en mission')->count() }}</div>

                        </div>

                        <div class="icon h1 text-white"
                            style="border-right: 50px solid transparent;border-left: 50px solid transparent;">
                            <i class="icon-copy fa fa-car" aria-hidden="true"></i>
                            <div class="font-14">Véhicules <br> en mission</div>
                            <div class="font-24 weight-500">
                                {{ DB::table('vehicules')->where('vehicle_state', '=', 'en mission')->count() }}</div>

                        </div>

                    </div>










                    <div class="card-box min-height-200px pd-20" data-bgcolor="#265ed7" style=" display: flex;">
                        <div class="icon h1 text-white"
                            style="border-right: 50px solid transparent;border-left: 140px solid transparent;">
                            <i class="icon-copy fa fa-vcard" aria-hidden="true"></i>
                            <div class="font-14">Conducteurs <br> disponible</div>
                            <div class="font-24 weight-500">
                                {{ DB::table('staff')->where('staff_state', '=', 'au travail')->count() }}</div>

                        </div>

                        <div class="icon h1 text-white"
                            style="border-right: 50px solid transparent;border-left: 50px solid transparent;">
                            <i class="icon-copy fa fa-car" aria-hidden="true"></i>
                            <div class="font-14">Véhicules <br> disponible</div>
                            <div class="font-24 weight-500">
                                {{ DB::table('vehicules')->where('vehicle_state', '=', 'Libre')->count() }}</div>

                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-6 mb-20">
                <div class="card-box height-100-p pd-20">
                    <div class="d-flex flex-wrap justify-content-between align-items-center pb-0 pb-md-3">
                        <div class="h5 mb-md-0">Déplacements</div>

                    </div>
                    <div id="activities-chart"></div>
                </div>
            </div>

        </div>











        <div class="row">


            <div class="card-box col-md-6 mb-20">



                    <main>
                        <h4 class="font-20 weight-500 mb-10 text-capitalize text-orange">Nombre d'accidents</h4>
                        <input id="tab1" type="radio" name="tabs" checked>
                        <label for="tab1">Unité</label>

                        <input id="tab2" type="radio" name="tabs">
                        <label for="tab2">Age</label>

                        <input id="tab3" type="radio" name="tabs">
                        <label for="tab3">Personne</label>



                        <section id="content1">
                            <table class="table nowrap hover data-table-export">
                                <thead>
                                    <tr>
                                        <th style="width:70%">Num</th>
                                        <th style="width:40%"> Nom</th>
                                        <th style="width:70%"><b> %</b></th>
                                    </tr>
                                </thead>
                                @php
                                    $i = 0;
                                @endphp
                                <tbody>
                                    @foreach ($units as $unit)
                                        @php
                                            $i = $i + 1;
                                        @endphp
                                        @php
                                            $c = 0;
                                        @endphp
                                        <tr>
                                            <td style="width:70%"> {{ $i }}</td>

                                            <td style="width:40%">{{ $unit->name }}</td>
                                            @foreach ($vehicules as $vehicule)
                                                @foreach ($accidents as $accident)
                                                    @if ($vehicule->unit_id == $unit->id && $accident->vehicle_id == $vehicule->id)
                                                        @php
                                                            $c = $c + 1;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                            @endforeach
                                            <td style="color: orange;width:70%">
                                                {{ ($c / DB::table('accidents')->count()) * 100 }}%</td>

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </section>

                        <section id="content2">
                            <table class="table nowrap hover data-table-export">
                                <thead>
                                    <tr>
                                        <th>Numéro</th>

                                        <th>Intervale d'age</th>
                                        <th>Pourcentage</th>


                                    </tr>
                                </thead>

                                @php
                                    $i = 0;

                                @endphp


                                <tbody>

                                    <tr>
                                        <td>1</td>
                                        <td>18-20</td>
                                        <td style="color: orange;">{{ ($aage / DB::table('accidents')->count()) * 100 }}%
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>2</td>
                                        <td>20-25</td>
                                        <td style="color: orange;">{{ ($bage / DB::table('accidents')->count()) * 100 }}%
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>25-30</td>
                                        <td style="color: orange;">{{ ($cage / DB::table('accidents')->count()) * 100 }}%
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>30-35</td>
                                        <td style="color: orange;">{{ ($dage / DB::table('accidents')->count()) * 100 }}%
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>35-40</td>
                                        <td style="color: orange;">{{ ($eage / DB::table('accidents')->count()) * 100 }}%
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>45-50</td>
                                        <td style="color: orange;">{{ ($fage / DB::table('accidents')->count()) * 100 }}%
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>55-60</td>
                                        <td style="color: orange;">{{ ($gage / DB::table('accidents')->count()) * 100 }}%
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </section>

                        <section id="content3">
                            <table class="table nowrap hover data-table-export">
                                <thead>
                                    <tr>
                                        <th>Numéro</th>
                                        <th>ID</th>

                                        <th> Nom Et Prénom</th>
                                        <th>Pourcentage</th>


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
                                            <td>{{ $staff->id }}</td>

                                            <td>{{ $staff->name }} {{ $staff->last_name }}</td>
                                            @foreach ($accidents as $accident)
                                                @if ($accident->driver_id == $staff->id)
                                                @endif
                                            @endforeach
                                            <td style="color: orange;">
                                                {{ (DB::table('accidents')->where('driver_id', '=', $staff->id)->count() /DB::table('accidents')->count()) *100 }}%
                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </section>



                    </main>







            </div>


            <div class=" card-box  col-md-6 mb-20">

                    <main>
                        <h4 class="font-20 weight-500 mb-10 text-capitalize text-orange">Nombre d'interventions de
                            réparation</h4>
                        <input id="tab4" type="radio" name="tabsd" checked>
                        <label for="tab4">Véhicule</label>

                        <input id="tab5" type="radio" name="tabsd">
                        <label for="tab5">Personne</label>

                        <input id="tab6" type="radio" name="tabsd">
                        <label for="tab6">Unité</label>



                        <section id="content4">

                            <table class="table nowrap hover data-table-export">

                                <thead>
                                    <tr>
                                        <th>Numéro</th>
                                        <th>Véhicule</th>
                                        <th><b>%</b></th>
                                    </tr>
                                </thead>
                                @php
                                    $i = 0;
                                @endphp
                                <tbody>
                                    @foreach ($vehicules as $vehicule)
                                        @php
                                            $i = $i + 1;
                                        @endphp
                                        <tr>
                                            <td> {{ $i }}</td>
                                            <td>{{ $vehicule->marticule }}</td>
                                            <td style="color: orange;">
                                                @if (DB::table('repairs')->count() != 0)
                                                    {{ number_format((float) (DB::table('repairs')->where('vehicule_id', '=', $vehicule->id)->count() /DB::table('repairs')->count()) *100, 2, '.', '')}}
                                                @else
                                                    0
                                                @endif%
                                            </td>

                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </section>

                        <section id="content5">
                            <table class="table nowrap hover data-table-export">
                                <thead>
                                    <tr>
                                        <th>Numero</th>

                                        <th> Nom Et Prénom</th>
                                        <th><b>%</b></th>


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
                                            @foreach ($repair_staffs as $repair_staff)
                                                @if ($repair_staff->staff_id == $staff->id)
                                                @endif
                                            @endforeach
                                            <td style="color: orange;">
												@if(DB::table('repair__staff')->count()==0)
												0%
												@else
												 {{ number_format((float)(DB::table('repair__staff')->where('staff_id', '=', $staff->id)->count() /DB::table('repair__staff')->count()) *100, 2, '.', '') }}%
												@endif

                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </section>

                        <section id="content6">
                            <table class="table nowrap hover data-table-export">
                                <thead>
                                    <tr>
                                        <th>Num</th>

                                        <th style="width:30%">Unité</th>
                                        <th style="width:30%"><b>%</b></th>


                                    </tr>
                                </thead>

                                @php
                                    $i = 0;

                                @endphp


                                <tbody>

                                    @foreach ($units as $unit)
                                        @php
                                            $i = $i + 1;
                                        @endphp
                                        @php
                                            $c = 0;
                                        @endphp
                                        <tr>
                                            <td> {{ $i }}</td>

                                            <td style="width:30%;font-size: 11px">{{ $unit->name }}</td>
                                            @foreach ($vehicules as $vehicule)
                                                @foreach ($repairs as $repair)
                                                    @if ($vehicule->unit_id == $unit->id && $repair->vehicule_id == $vehicule->id)
                                                        @php
                                                            $c = $c + 1;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                            @endforeach
                                            <td style="color: orange;width:30%">
                                                @if (DB::table('repairs')->count() != 0)
                                                    {{ number_format((float)($c / DB::table('repairs')->count()) * 100, 2, '.', '') }}
                                                @else
                                                    0
                                                @endif%
                                            </td>

                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </section>



                    </main>

            </div>

        </div>















        @include('layouts.footerForHome')


</body>

</html>


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
        padding: 15px 20px;
        font-weight: 550;
        text-align: center;
        color: #bbb;
        border: 1px solid transparent;
        font-size: 1em;
    }

    label:before {
        font-family: fontawesome;
        font-weight: normal;
        margin-right: 8px;
        font-size: 1em;
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
