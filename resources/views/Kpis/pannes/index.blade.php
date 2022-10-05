@if(Auth::user()->type=='Gestionnaire parc' ||Auth::user()->type=='Gestionnaire Sup')


<!DOCTYPE html>
<html>
@include('layouts.headforKPIindex')


<body>

    @include('layouts.header-bar')
    @include('layouts.navbar')


    <div class="mobile-menu-overlay"></div>

    <div class="main-container">
        <button class="btn btn-warning btn-round"> <a href="javascript:generatePDF()">Télécharger le PDF</a></button>

        <div id="test">

            <div class="xs-pd-20-10 pd-ltr-20">
                <div class="card-box pd-20 height-100-p mb-30">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <img src="{{ URL('assets/vendors/images/panne.png') }}"; alt="" />
                        </div>
                        <div class="col-md-8">
                            <h4 class="font-20 weight-500 mb-10 text-capitalize">

                                <div class="weight-600 font-30 text-blue"> Bienvenue</div>
                            </h4>

                            <p class="font-18 max-width-600">
                                Dans cette section vous trouverez les statistiques des Pannes, des Demandes de Travaux
                                et des Réparation leurs types et tout ce
                                qui les concerne. <b>Le {{ $date }}</b>
                            </p>
                        </div>
                    </div>
                </div>
            </div>


            <div class="xs-pd-20-10 pd-ltr-20">
                <div class="card-box pd-20 height-100-p mb-30">
                    <div class="row align-items-center">
                        <div class="weight-600 font-30 text-grey">Taux des DT (Demandes de Traveux) traitées
                            dans:
                        </div>
                        <div class="col-md-8">
                            <form action="{{ route('Kpis.pannes.create') }}" method="get">
                                @csrf

                                <div class="form-group" style=" display: inline-block;" id="specificDiv">

                                    <div class="form-group" style=" display: inline-block;">
                                        <select id="monthDT" type="text"
                                            class="form-control select2 @error('monthDT')
                                                is-invalid @enderror"
                                            name="monthDT" required autocomplete="monthDT" autofocus>
                                            <option value="" disabled selected>mois</option>
                                            <option value="1">Janvier </option>
                                            <option value="2">Février </option>
                                            <option value="3">Mars</option>
                                            <option value="4">Avril</option>
                                            <option value="5">Mai</option>
                                            <option value="6">Juin </option>
                                            <option value="7">Juillet </option>
                                            <option value="8">Aout </option>
                                            <option value="9">Septembre </option>
                                            <option value="10">Octobre </option>
                                            <option value="11">Novembre </option>
                                            <option value="12">Décembre </option>


                                        </select>
                                    </div>
                                    <div class="form-group" style=" display: inline-block;">
                                        <input type="number" max="2090" min="2000" name="yearDT"
                                            class="form-control" placeholder="année">
                                    </div>
                                    <button type="submit"
                                        class="btn btn-info btn-round">{{ __('Rechercher') }}</button>



                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <div class="xs-pd-20-10 pd-ltr-20">
                <div class="card-box pd-20 height-100-p mb-30">
                    <div class="row align-items-center">
                        <div class="weight-600 font-30 text-grey">Classement des pannes et des reparations par type
                            dans:
                        </div>
                        <div class="col-md-8">
                            <form action="{{ route('Kpis.pannes.create') }}" method="get">
                                @csrf

                                <div class="form-group" style=" display: inline-block;" id="specificDiv">

                                    <div class="form-group" style=" display: inline-block;">
                                        <select id="month" type="text"
                                            class="form-control select2 @error('month')
                                                is-invalid @enderror"
                                            name="month" required autocomplete="month" autofocus>
                                            <option value="" disabled selected>mois</option>
                                            <option value="1">Janvier </option>
                                            <option value="2">Février </option>
                                            <option value="3">Mars</option>
                                            <option value="4">Avril</option>
                                            <option value="5">Mai</option>
                                            <option value="6">Juin </option>
                                            <option value="7">Juillet </option>
                                            <option value="8">Aout </option>
                                            <option value="9">Septembre </option>
                                            <option value="10">Octobre </option>
                                            <option value="11">Novembre </option>
                                            <option value="12">Décembre </option>


                                        </select>
                                    </div>
                                    <div class="form-group" style=" display: inline-block;">
                                        <input type="number" max="2090" min="2000" name="year"
                                            class="form-control" placeholder="année">
                                    </div>
                                    <button type="submit"
                                        class="btn btn-info btn-round">{{ __('Rechercher') }}</button>



                            </form>
                        </div>
                    </div>
                </div>
            </div>




            <div style="text-align:right; margin:0px auto 0px auto;">


                <div class="col-md-6 mb-20">
                    <div class="card-box height-100-p pd-20">

                        <div id="myChart" class="chart--container">

                        </div>
                    </div>
                </div>


            </div>




        </div>
    </div>

    </div>
    <div style="position:absolute;right:20px;">
        <div class="card-box pd-20 height-100-p mb-30">
            <main>
                <h4 class="font-20 weight-500 mb-10 text-capitalize text-orange">Statistique </h4>

                <input id="tab1" type="radio" name="tabs" checked>
                <label for="tab1">Vehicules</label>
                <input id="tab2" type="radio" name="tabs">
                <label for="tab2">Machines</label>
                <input id="tab3" type="radio" name="tabs">
                <label for="tab3">Personnes</label>
                <section id="content1">
                    <table class="table nowrap hover data-table-export">
                        <thead>
                            <tr>
                                <th>Numero</th>
                                <th>ID</th>

                                <th> Numéro de Série</th>
                                <th>Action</th>


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
                                    <td>{{ $vehicule->id }}</td>

                                    <td>{{ $vehicule->serial_numbers }} </td>

                                    <td style="color: orange;">
                                        <div class="dropdown">
                                            <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                href="#" role="button" data-toggle="dropdown">
                                                <i class="dw dw-more"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
                                                style="width: 400px;">

                                                <form style=" left:-10%;"
                                                    action="{{ route('Kpis.pannes.show', $vehicule->id) }}"
                                                    method="get" class="dropdown-item">
                                                    @csrf
                                                    <button " type="submit"
                                                        class="btn btn-outline-primary btn-round">{{ __('Temps moyen entre pannes') }}</button>


                                                    <div class="form-group" style=" display: inline-block;">
                                                        <input type="number" max="2090" min="2000"
                                                            name="MTBFyear" class="form-control"
                                                            placeholder="année">
                                                    </div>


                                                    <input type="hidden" value="Vehicule"
                                                    id="option_type" name="option_type">

                                                </form>


                                                <form style=" left:-10%;"
                                                    action="{{ route('Kpis.pannes.show', $vehicule->id) }}"
                                                    method="get" class="dropdown-item">
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn btn-outline-primary btn-round">{{ __('Taux de défaillance') }}</button>

                                                    <div class="form-group"
                                                        style=" display: inline-block;">
                                                        <select id="monthTF" type="text"
                                                            class="form-control select2 @error('monthTF')
                                                                            is-invalid @enderror"
                                                            name="monthTF" required autocomplete="monthTF"
                                                            autofocus>
                                                            <option value="" disabled selected>
                                                                mois
                                                            </option>
                                                            <option value="1">Ja </option>
                                                            <option value="2">Fév </option>
                                                            <option value="3">Mar</option>
                                                            <option value="4">Avr</option>
                                                            <option value="5">Mai</option>
                                                            <option value="6">Jun </option>
                                                            <option value="7">Jul </option>
                                                            <option value="8">Aou </option>
                                                            <option value="9">Sep </option>
                                                            <option value="10">Oct </option>
                                                            <option value="11">Nov </option>
                                                            <option value="12">Déc </option>


                                                        </select>
                                                    </div>
                                                    <div class="form-group"
                                                        style=" display: inline-block;">
                                                        <input type="number" max="2090"
                                                            min="2000" name="yearTF"
                                                            class="form-control" placeholder="année">
                                                    </div>

                                                    <input type="hidden" value="TDVehicule"
                                                        id="action_type" name="action_type">
                                                        <input type="hidden" value="Vehicule"
                                                        id="option_type" name="option_type">

                                                </form>
                                                <form style=" left:-10%;"
                                                    action="{{ route('Kpis.pannes.show', $vehicule->id) }}"
                                                    method="get" class="dropdown-item">
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn btn-outline-primary btn-round">{{ __('Taux de réparation') }}</button>

                                                    <div class="form-group"
                                                        style=" display: inline-block;">
                                                        <select id="monthTR" type="text"
                                                            class="form-control select2 @error('monthTR')
                                                                        is-invalid @enderror"
                                                            name="monthTR" required autocomplete="monthTR"
                                                            autofocus>
                                                            <option value="" disabled selected>
                                                                mois
                                                            </option>
                                                            <option value="1">Ja </option>
                                                            <option value="2">Fév </option>
                                                            <option value="3">Mar</option>
                                                            <option value="4">Avr</option>
                                                            <option value="5">Mai</option>
                                                            <option value="6">Jun </option>
                                                            <option value="7">Jul </option>
                                                            <option value="8">Aou </option>
                                                            <option value="9">Sep </option>
                                                            <option value="10">Oct </option>
                                                            <option value="11">Nov </option>
                                                            <option value="12">Déc </option>


                                                        </select>
                                                    </div>
                                                    <div class="form-group"
                                                        style=" display: inline-block;">
                                                        <input type="number" max="2090"
                                                            min="2000" name="yearTR"
                                                            class="form-control" placeholder="année">
                                                    </div>

                                                    <input type="hidden" value="TRVehicule"
                                                        id="action_type" name="action_type">
                                                        <input type="hidden" value="Vehicule"
                                                        id="option_type" name="option_type">

                                                </form>
                                                <form style=" left:-10%;"
                                                    action="{{ route('Kpis.pannes.show', $vehicule->id) }}"
                                                    method="get" class="dropdown-item">
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn btn-outline-primary btn-round">{{ __('Moyenne de pannes') }}</button>


                                                    <div class="form-group"
                                                        style=" display: inline-block;">
                                                        <input type="number" max="2090"
                                                            min="2000" name="yearMP"
                                                            class="form-control" placeholder="année">
                                                    </div>

                                                    <input type="hidden" value="MPVehicule"
                                                        id="action_type" name="action_type">
                                                        <input type="hidden" value="Vehicule"
                                                        id="option_type" name="option_type">

                                                </form>
                                                <form style=" left:-10%;"
                                                    action="{{ route('Kpis.pannes.show', $vehicule->id) }}"
                                                    method="get" class="dropdown-item">
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn btn-outline-primary btn-round">{{ __('Temps moyen pour réparer') }}</button>

                                                    <div class="form-group"
                                                        style=" display: inline-block;">
                                                        <select id="month" type="text"
                                                            class="form-control select2 @error('MTTRmonth')
                                                                    is-invalid @enderror"
                                                            name="MTTRmonth" required autocomplete="MTTRmonth"
                                                            autofocus>
                                                            <option value="" disabled selected>
                                                                mois
                                                            </option>
                                                            <option value="1">Ja </option>
                                                            <option value="2">Fév </option>
                                                            <option value="3">Mar</option>
                                                            <option value="4">Avr</option>
                                                            <option value="5">Mai</option>
                                                            <option value="6">Jun </option>
                                                            <option value="7">Jul </option>
                                                            <option value="8">Aou </option>
                                                            <option value="9">Sep </option>
                                                            <option value="10">Oct </option>
                                                            <option value="11">Nov </option>
                                                            <option value="12">Déc </option>


                                                        </select>
                                                    </div>
                                                    <div class="form-group"
                                                        style=" display: inline-block;">
                                                        <input type="number" max="2090"
                                                            min="2000" name="MTTRyear"
                                                            class="form-control" placeholder="année">
                                                    </div>

                                                    <input type="hidden" value="MTTRVehicule"
                                                        id="action_type" name="action_type">
                                                        <input type="hidden" value="Vehicule"
                                                        id="option_type" name="option_type">

                                                </form>
                                            </div>
                                        </div>




                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </section>
                <section id="content2">
                    <table class="table nowrap hover data-table-export">
                        <thead>
                            <tr>
                                <th>Numero</th>
                                <th>ID</th>

                                <th>Réf d’achat</th>
                                <th>Action</th>


                            </tr>
                        </thead>

                        @php
                            $i = 0;

                        @endphp


                        <tbody>

                            @foreach ($materials as $machine)
                                @php
                                    $i = $i + 1;
                                @endphp

                                <tr>
                                    <td> {{ $i }}</td>
                                    <td>{{ $machine->id }}</td>

                                    <td>{{ $machine->ref }} </td>

                                    <td style="color: orange;">
                                        <div class="dropdown">
                                            <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                href="#" role="button" data-toggle="dropdown">
                                                <i class="dw dw-more"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
                                                style="width: 400px;">

                                                <form style=" left:-10%;"
                                                    action="{{ route('Kpis.pannes.show', $machine->id) }}"
                                                    method="get" class="dropdown-item">
                                                    @csrf
                                                    <button " type="submit"
                                                        class="btn btn-outline-primary btn-round">{{ __('Temps moyen entre pannes') }}</button>


                                                    <div class="form-group" style=" display: inline-block;">
                                                        <input type="number" max="2090" min="2000"
                                                            name="MTBFyear" class="form-control"
                                                            placeholder="année">
                                                    </div>


                                                        <input type="hidden" value="Machine"
                                                        id="option_type" name="option_type">

                                                </form>


                                                <form style=" left:-10%;"
                                                    action="{{ route('Kpis.pannes.show', $machine->id) }}"
                                                    method="get" class="dropdown-item">
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn btn-outline-primary btn-round">{{ __('Taux de défaillance') }}</button>

                                                    <div class="form-group"
                                                        style=" display: inline-block;">
                                                        <select id="month" type="text"
                                                            class="form-control select2 @error('month')
                                                                            is-invalid @enderror"
                                                            name="month" required autocomplete="month"
                                                            autofocus>
                                                            <option value="" disabled selected>
                                                                mois
                                                            </option>
                                                            <option value="1">Ja </option>
                                                            <option value="2">Fév </option>
                                                            <option value="3">Mar</option>
                                                            <option value="4">Avr</option>
                                                            <option value="5">Mai</option>
                                                            <option value="6">Jun </option>
                                                            <option value="7">Jul </option>
                                                            <option value="8">Aou </option>
                                                            <option value="9">Sep </option>
                                                            <option value="10">Oct </option>
                                                            <option value="11">Nov </option>
                                                            <option value="12">Déc </option>


                                                        </select>
                                                    </div>
                                                    <div class="form-group"
                                                        style=" display: inline-block;">
                                                        <input type="number" max="2090"
                                                            min="2000" name="year"
                                                            class="form-control" placeholder="année">
                                                            <input type="hidden" value="Machine"
                                                            id="option_type" name="option_type">
                                                    </div>

                                                    <input type="hidden" value="TDMachine"
                                                        id="action_type" name="action_type">

                                                </form>
                                                <form style=" left:-10%;"
                                                    action="{{ route('Kpis.pannes.show', $machine->id) }}"
                                                    method="get" class="dropdown-item">
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn btn-outline-primary btn-round">{{ __('Taux de réparation') }}</button>

                                                    <div class="form-group"
                                                        style=" display: inline-block;">
                                                        <select id="monthTR" type="text"
                                                            class="form-control select2 @error('monthTR')
                                                                        is-invalid @enderror"
                                                            name="monthTR" required autocomplete="monthTR"
                                                            autofocus>
                                                            <option value="" disabled selected>
                                                                mois
                                                            </option>
                                                            <option value="1">Ja </option>
                                                            <option value="2">Fév </option>
                                                            <option value="3">Mar</option>
                                                            <option value="4">Avr</option>
                                                            <option value="5">Mai</option>
                                                            <option value="6">Jun </option>
                                                            <option value="7">Jul </option>
                                                            <option value="8">Aou </option>
                                                            <option value="9">Sep </option>
                                                            <option value="10">Oct </option>
                                                            <option value="11">Nov </option>
                                                            <option value="12">Déc </option>


                                                        </select>
                                                    </div>
                                                    <div class="form-group"
                                                        style=" display: inline-block;">
                                                        <input type="number" max="2090"
                                                            min="2000" name="yearTR"
                                                            class="form-control" placeholder="année">
                                                    </div>

                                                    <input type="hidden" value="TRMachine"
                                                        id="action_type" name="action_type">
                                                        <input type="hidden" value="Machine"
                                                        id="option_type" name="option_type">

                                                </form>
                                                <form style=" left:-10%;"
                                                    action="{{ route('Kpis.pannes.show', $machine->id) }}"
                                                    method="get" class="dropdown-item">
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn btn-outline-primary btn-round">{{ __('Moyenne de pannes') }}</button>


                                                    <div class="form-group"
                                                        style=" display: inline-block;">
                                                        <input type="number" max="2090"
                                                            min="2000" name="yearMP"
                                                            class="form-control" placeholder="année">
                                                    </div>

                                                    <input type="hidden" value="MPMachine"
                                                        id="action_type" name="action_type">
                                                        <input type="hidden" value="Machine"
                                                        id="option_type" name="option_type">

                                                </form>
                                                <form style=" left:-10%;"
                                                    action="{{ route('Kpis.pannes.show', $machine->id) }}"
                                                    method="get" class="dropdown-item">
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn btn-outline-primary btn-round">{{ __('Temps moyen pour réparer') }}</button>

                                                    <div class="form-group"
                                                        style=" display: inline-block;">
                                                        <select id="MTTRmonth" type="text"
                                                            class="form-control select2 @error('MTTRmonth')
                                                                    is-invalid @enderror"
                                                            name="MTTRmonth" required autocomplete="MTTRmonth"
                                                            autofocus>
                                                            <option value="" disabled selected>
                                                                mois
                                                            </option>
                                                            <option value="1">Ja </option>
                                                            <option value="2">Fév </option>
                                                            <option value="3">Mar</option>
                                                            <option value="4">Avr</option>
                                                            <option value="5">Mai</option>
                                                            <option value="6">Jun </option>
                                                            <option value="7">Jul </option>
                                                            <option value="8">Aou </option>
                                                            <option value="9">Sep </option>
                                                            <option value="10">Oct </option>
                                                            <option value="11">Nov </option>
                                                            <option value="12">Déc </option>


                                                        </select>
                                                    </div>
                                                    <div class="form-group"
                                                        style=" display: inline-block;">
                                                        <input type="number" max="2090"
                                                            min="2000" name="MTTRyear"
                                                            class="form-control" placeholder="année">
                                                    </div>

                                                    <input type="hidden" value="MTTRMachine"
                                                        id="action_type" name="action_type">
                                                        <input type="hidden" value="Machine"
                                                        id="option_type" name="option_type">

                                                </form>
                                            </div>
                                        </div>




                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </section>
                <section id="content3">
                    <table class="table nowrap hover data-table-export">
                        <thead>
                            <tr>
                                <th>Numero</th>
                                <th>ID</th>

                                <th>Nome et Prénom</th>
                                <th>Action</th>


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

                                    <td>{{ $staff->name }} {{ $staff->last_name }} </td>

                                    <td style="color: orange;">
                                        <div class="dropdown">
                                            <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                href="#" role="button" data-toggle="dropdown">
                                                <i class="dw dw-more"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
                                                style="width: 400px;">


                                                <form style=" left:-10%;"
                                                    action="{{ route('Kpis.pannes.show', $staff->id) }}"
                                                    method="get" class="dropdown-item">
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn btn-outline-primary btn-round">{{ __('Taux de réparation') }}</button>

                                                    <div class="form-group"
                                                        style=" display: inline-block;">
                                                        <select id="monthTR" type="text"
                                                            class="form-control select2 @error('monthTR')
                                                                        is-invalid @enderror"
                                                            name="monthTR" required autocomplete="monthTR"
                                                            autofocus>
                                                            <option value="" disabled selected>
                                                                mois
                                                            </option>
                                                            <option value="1">Ja </option>
                                                            <option value="2">Fév </option>
                                                            <option value="3">Mar</option>
                                                            <option value="4">Avr</option>
                                                            <option value="5">Mai</option>
                                                            <option value="6">Jun </option>
                                                            <option value="7">Jul </option>
                                                            <option value="8">Aou </option>
                                                            <option value="9">Sep </option>
                                                            <option value="10">Oct </option>
                                                            <option value="11">Nov </option>
                                                            <option value="12">Déc </option>


                                                        </select>
                                                    </div>
                                                    <div class="form-group"
                                                        style=" display: inline-block;">
                                                        <input type="number" max="2090"
                                                            min="2000" name="yearTR"
                                                            class="form-control" placeholder="année">
                                                    </div>

                                                    <input type="hidden" value="TRStaff"
                                                        id="action_type" name="action_type">
                                                        <input type="hidden" value="Staff"
                                                        id="option_type" name="option_type">

                                                </form>

                                                <form style=" left:-10%;"
                                                    action="{{ route('Kpis.pannes.show', $staff->id) }}"
                                                    method="get" class="dropdown-item">
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn btn-outline-primary btn-round">{{ __('Temps moyen pour réparer') }}</button>

                                                    <div class="form-group"
                                                        style=" display: inline-block;">
                                                        <select id="MTTRmonth" type="text"
                                                            class="form-control select2 @error('MTTRmonth')
                                                                    is-invalid @enderror"
                                                            name="MTTRmonth" required autocomplete="MTTRmonth"
                                                            autofocus>
                                                            <option value="" disabled selected>
                                                                mois
                                                            </option>
                                                            <option value="1">Ja </option>
                                                            <option value="2">Fév </option>
                                                            <option value="3">Mar</option>
                                                            <option value="4">Avr</option>
                                                            <option value="5">Mai</option>
                                                            <option value="6">Jun </option>
                                                            <option value="7">Jul </option>
                                                            <option value="8">Aou </option>
                                                            <option value="9">Sep </option>
                                                            <option value="10">Oct </option>
                                                            <option value="11">Nov </option>
                                                            <option value="12">Déc </option>


                                                        </select>
                                                    </div>
                                                    <div class="form-group"
                                                        style=" display: inline-block;">
                                                        <input type="number" max="2090"
                                                            min="2000" name="MTTRyear"
                                                            class="form-control" placeholder="année">
                                                    </div>

                                                    <input type="hidden" value="MTTRStaff"
                                                        id="action_type" name="action_type">
                                                        <input type="hidden" value="Staff"
                                                        id="option_type" name="option_type">

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
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <input type="hidden" value="{{ $lourde }} " id="lourde">
    <input type="hidden" value="{{ $moyene }} " id="moyene">
    <input type="hidden" value="{{ $legere }} " id="legere">



    @include('layouts.footerforKPIindex')


</body>

</html>
<script>
    var lourde = parseInt($("#lourde").val());
    var moyene = parseInt($("#moyene").val());
    var legere = parseInt($("#legere").val());


    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "b55b025e438fa8a98e32482b5f768ff5"];
    let chartConfig = {
        type: 'ring',
        legend: {
            align: 'center',
            borderWidth: '0px',
            item: {
                cursor: 'pointer',
                fontSize: '15px',
                offsetX: '-5px',
            },
            layout: 'vertical',
            marker: {
                type: 'circle',
                cursor: 'pointer',
                size: '10px',
            },
            toggleAction: 'remove', // remove plot so it re-calculates percentage
            verticalAlign: 'middle',
        },
        plot: {
            tooltip: {
                visible: false,
            },
            detached: false, // turn off click on slices
            slice: 150, // set hole size in middle of chart
        },
        series: [{
                text: 'Lourde',
                values: [lourde],
                backgroundColor: '#553939',
            },
            {
                text: 'Moyenne',
                values: [moyene],
                backgroundColor: '#FA9494',
            },
            {
                text: 'Légère',
                values: [legere],
                backgroundColor: '#A5F1E9',
            },

        ],
    };

    zingchart.render({
        id: 'myChart',
        data: chartConfig,
        height: '100%',
        width: '100%',
    });

    /*
     * Every 35 milliseconds we will update the chart
     * angle by 1.5 degress so it simulates rotatition
     * animation!
     */
    let angle = 0;
    setInterval(function() {
        angle = angle + 1.5;
        zingchart.exec('myChart', 'modify', {
            object: 'plot',
            data: {
                refAngle: angle % 360,
            },
        });
    }, 35);
</script>
<script>
    var aage = JSON.parse($("#aage").val());
    var bage = JSON.parse($("#bage").val());
    var cage = JSON.parse($("#cage").val());
    var dage = JSON.parse($("#dage").val());
    var eage = JSON.parse($("#eage").val());
    var fage = JSON.parse($("#fage").val());


    Highcharts.chart('bars', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Nombre d\'equipement selon la tranche d\'age'
        },

        xAxis: {
            categories: [
                'Moin de 2ans',
                'Entre 2 et 4 ans',
                'Entre 4 et 6 ans',
                'Entre 6 et 8 ans',
                'Entre 8 et 10 ans',
                'Plues de 10 ans '
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'MACHINE (M)'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} M</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            color: '#87A2FB',
            name: 'Age',
            data: [
                aage,
                bage,
                cage,
                dage,
                eage,
                fage
            ]

        }]
    });
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
  <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1000 1000" enable-background="new 0 0 1000 1000" xml:space="preserve" class="whistle">
<metadata> Svg Vector Icons : http://www.onlinewebfonts.com/icon </metadata>
<g><g transform="translate(0.000000,511.000000) scale(0.100000,-0.100000)">
<path d="M4295.8,3963.2c-113-57.4-122.5-107.2-116.8-622.3l5.7-461.4l63.2-55.5c72.8-65.1,178.1-74.7,250.8-24.9c86.2,61.3,97.6,128.3,97.6,584c0,474.8-11.5,526.5-124.5,580.1C4393.4,4001.5,4372.4,4001.5,4295.8,3963.2z"/><path d="M3053.1,3134.2c-68.9-42.1-111-143.6-93.8-216.4c7.7-26.8,216.4-250.8,476.8-509.3c417.4-417.4,469.1-463.4,526.5-463.4c128.3,0,212.5,88.1,212.5,224c0,67-26.8,97.6-434.6,509.3c-241.2,241.2-459.5,449.9-488.2,465.3C3181.4,3180.1,3124,3178.2,3053.1,3134.2z"/><path d="M2653,1529.7C1644,1445.4,765.1,850,345.8-32.7C62.4-628.2,22.2-1317.4,234.8-1960.8C451.1-2621.3,947-3186.2,1584.6-3500.2c1018.6-501.6,2228.7-296.8,3040.5,515.1c317.8,317.8,561,723.7,670.1,1120.1c101.5,369.5,158.9,455.7,360,553.3c114.9,57.4,170.4,65.1,1487.7,229.8c752.5,93.8,1392,181.9,1420.7,193.4C8628.7-857.9,9900,1250.1,9900,1328.6c0,84.3-67,172.3-147.4,195.3c-51.7,15.3-790.8,19.1-2558,15.3l-2487.2-5.7l-55.5-63.2l-55.5-61.3v-344.6V719.8h-411.7h-411.7v325.5c0,509.3,11.5,499.7-616.5,494C2921,1537.3,2695.1,1533.5,2653,1529.7z"/></g></g>
</svg>
</use>
<h1>403</h1>
<h2>VOUS N'AVEZ PAS ACCÈS À CETTE PAGE!</h2>
</body>
</html>
<style>* {
    margin:0;
    padding: 0;
  }
  body{
    background: #233142;

  }
  .whistle{
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
    0%{
      transform: rotate(3deg);
    }
    50%{
      transform: rotate(0deg);
    }
    100%{
      transform: rotate(3deg);
    }
  }
  h1{
    margin-top: -100px;
    margin-bottom: 20px;
    color: #facf5a;
    text-align: center;
    font-family: 'Raleway';
    font-size: 90px;
    font-weight: 800;
  }
  h2{
    color: #455d7a;
    text-align: center;
    font-family: 'Raleway';
    font-size: 30px;
    text-transform: uppercase;
  }</style>
                            @endif
