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

                            </div>
                        </div>

                        <div class="page-header" style="background-color:#ffffff">
                            <h4 style="color:#f06431;">information de la carte grise du Véhicule: </h4>


                                <table style=" width: 90%;border-collapse: collapse;">
                                    <tr>
                                        <th>
                                            <h4 style="display: inline;color:#000000 ">Genre: </h4>
                                            <h5 style="display: inline;">{{ $vehicule->genre }}</h5>
                                        </th>


                                        <th>
                                            <h4 style="display: inline;color:#000000 ">Marque de véhicule: </h4>
                                            <h5 style="display: inline;">{{ $vehicule->mark }}</h5>
                                        </th>



                                    </tr>

                                    <tr>
                                        <th>
                                            <h4 style="display: inline;color:#000000 ">Type de véhicule: </h4>
                                            <h5 style="display: inline;">{{ $vehicule->type }}</h5>
                                        </th>


                                        <th>
                                            <h4 style="display: inline; color:#000000">Carrosserie: </h4>
                                            <h5 style="display: inline;">{{ $vehicule->crosserie }}</h5>
                                        </th>



                                    </tr>
                                    <tr>
                                        <th>
                                            <h4 style="display: inline;color:#000000 ">Energie de véhicule: </h4>
                                            <h5 style="display: inline;">{{ $vehicule->type_of_fuel }}</h5>
                                        </th>


                                        <th>
                                            <h4 style="display: inline; color:#000000">Puissance de véhicule: </h4>
                                            <h5 style="display: inline;">{{ $vehicule->power }}</h5>
                                        </th>



                                    </tr>
                                    <tr>
                                        <th>
                                            <h4 style="display: inline; color:#000000">Places assises: </h4>
                                            <h5 style="display: inline;">{{ $vehicule->places }}</h5>
                                        </th>


                                        <th>
                                            <h4 style="display: inline;color:#000000">Poids total en charge: </h4>
                                            <h5 style="display: inline;">{{ $vehicule->weight }}</h5>
                                        </th>



                                    </tr>
                                    <tr>
                                        <th>
                                            <h4 style="display: inline; color:#000000">Charge utile: </h4>
                                            <h5 style="display: inline;">{{ $vehicule->charge }}</h5>
                                        </th>


                                        <th>
                                            <h4 style="display: inline;color:#000000">N D\'imatriculation: </h4>
                                            <h5 style="display: inline;">{{ $vehicule->marticule }}</h5>
                                        </th>



                                    </tr>
                                    <tr>
                                        <th>
                                            <h4 style="display: inline; color:#000000">Precedent numero: </h4>
                                            <h5 style="display: inline;">{{ $vehicule->precedent }}</h5>
                                        </th>


                                        <th>
                                            <h4 style="display: inline;color:#000000">Annee de premiere mise en
                                                circulation: </h4>
                                            <h5 style="display: inline;">{{ $vehicule->moving_year }}</h5>
                                        </th>



                                    </tr>


                                </table>
                            </div>

                        <div class="page-header" style="background-color:#ffffff">


                            <h4 style="color:#f06431;">Information du Véhicule: </h4>

                            <table style=" width: 90%;border-collapse: collapse;">
                                <tr>
                                    <th>
                                        <h4 style="display: inline;color:rgb(165, 42, 69)">ID: </h4>
                                        <h5 style="display: inline;">{{ $vehicule->code }}</h5>
                                    </th>


                                    <th>
                                        <h4 style="display: inline;color:#000000"> Numéro de Série: </h4>
                                        <h5 style="display: inline;color:#000000">{{ $vehicule->serial_numbers }}
                                        </h5>
                                    </th>
                                </tr>
                                <tr>
                                    <th>
                                        <h4>Marque: </h4>
                                        <h5 style="display: inline;">{{ $vehicule->mark }}</h5>
                                    </th>


                                    <th>
                                        <h4 style="display: inline;color:#000000"> Marticule: </h4>
                                        <h5 style="display: inline;color:#000000">{{ $vehicule->marticule }}
                                        </h5>
                                    </th>
                                </tr>

                                <tr>
                                    <th>


                                        <h4 style="display: inline;color:#000000">Année Mise en Service: </h4>
                                        <h5 style="display: inline;color:#000000">
                                            {{ $vehicule->year_commissioned }}
                                        </h5>
                                    </th>
                                    <th>

                                        <h4 style="display: inline;color:#000000 ">Type du Carburant: </h4>
                                        <h5 style="display: inline;color:#000000">{{ $vehicule->type_of_fuel }}
                                        </h5>
                                    </th>
                                </tr>

                                <tr>
                                    <th>
                                        <br>
                                        <h4 style="display: inline;color:#000000">Capacité réservoir: </h4>
                                        <h5 style="display: inline;color:#000000">{{ $vehicule->tank_capacity }}
                                        </h5>
                                    </th>

                                    <th>

                                        <h4 style="display: inline;color:#000000">LTR / 100Km:</h4>
                                        <h5 style="display: inline;color:#000000">{{ $vehicule->litter_by_100km }}
                                        </h5>
                                    </th>
                                </tr>
                                <tr>
                                    <th>
                                        <h4 style="display: inline;color:#000000">Type de véhicule: </h4>
                                        <h5 style="display: inline;color:#000000">{{ $vehicule->vehicle_type }}
                                        </h5>
                                    </th>
                                    <th>
                                        <h4 style="display: inline;color:#000000">Dimensions pneus:</h4>
                                        <h5 style="display: inline;color:#000000">{{ $vehicule->tire_size }}</h5>
                                    </th>
                                </tr>

                                <tr>
                                    <th>
                                        <h4 style="display: inline;color:#000000">Pressions Av: </h4>
                                        <h5 style="display: inline;color:#000000">
                                            {{ $vehicule->pressure_forward }}
                                        </h5>
                                    </th>
                                    <th>
                                        <h4 style="display: inline;color:#000000">Pressions Ar: </h4>
                                        <h5 style="display: inline;color:#000000">{{ $vehicule->pressure_back }}
                                        </h5>
                                    </th>
                                </tr>
                                <tr>
                                    <th>
                                        <h4 style="display: inline;color:#000000">Les informations de la CARTE
                                            GRISE:
                                        </h4>
                                        <h5 style="display: inline;color:#000000"> <a
                                                href="https://parcit.edeval.dz/public/files/carteGrise_files/{{ $vehicule->path }}">


                                                <span class="fa fa-eye  " style="color: #7e3dbb"> </span>

                                            </a></h5>
                                    </th>
                                    <th>
                                        <h4 style="display: inline;color:#000000">Date d'acquisition:</h4>
                                        <h5 style="display: inline;color:#000000">{{ $vehicule->acquisition_date }}
                                        </h5>
                                    </th>
                                </tr>
                                <tr>
                                    <th>
                                        <h4 style="display: inline;color:#000000">Etat GPS: </h4>
                                        <h5 style="display: inline;color:#000000">{{ $vehicule->registration }}
                                        </h5>
                                    </th>
                                    <th>
                                        <h4 style="display: inline;color:#000000">Affectation: </h4>
                                        <h5 style="display: inline;color:#000000">{{ $unit->name }}</h5>
                                    </th>
                                </tr>
                            </table>


                        </div>



                        <div class="page-header" style="background-color:#ffffff">

                            <h4 style="color:#f06431;">Assurances:</h4>

                            @php
                                $i = 0;
                            @endphp
                            @foreach ($inssurances as $inssurance)
                                @php
                                    $i = $i + 1;
                                @endphp
                                <div class="sidenav">

                                    <button class="dropdown-btn"> Assurances {{ $i }} : début le
                                        {{ $inssurance->effective_date }}</b>
                                        <i class="fa fa-caret-down"></i>
                                    </button>
                                    <div class="dropdown-container">
                                        <table style=" width: 90%;border-collapse: collapse;">
                                            <tr>
                                                <th>
                                                    <h4 style="display: inline;color:rgb(42, 165, 124)">ID: </h4>
                                                    <h5 style="display: inline;color:#000000">{{ $inssurance->id }}
                                                    </h5>
                                                </th>
                                                <th>
                                                    <h4 style="display: inline;color:#000000"> Numéro de police
                                                        d'Assurance:
                                                    </h4>
                                                    <h5 style="display: inline;color:#000000">
                                                        {{ $inssurance->police_number }}
                                                    </h5>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <h4 style="display: inline;color:#000000">Date d'effet: </h4>
                                                    <h5 style="display: inline;color:#000000">
                                                    </h5>
                                                </th>
                                                <th>
                                                    <h4 style="display: inline;color:#000000 ">Nom de la compagnie:
                                                    </h4>
                                                    <h5 style="display: inline;color:#000000">
                                                        {{ $inssurance->company_name }}
                                                    </h5>
                                                </th>
                                            </tr>

                                            <tr>
                                                <th>
                                                    <h4 style="display: inline;color:#000000">Type d'assurance:
                                                    </h4>
                                                    <h5 style="display: inline;color:#000000">
                                                        {{ $inssurance->agency_code }}
                                                    </h5>
                                                </th>

                                                <th>
                                                    <h4 style="display: inline;color:#000000">Adresse de l'agence:
                                                    </h4>
                                                    <h5 style="display: inline;color:#000000">
                                                        {{ $inssurance->insurance_type }}
                                                    </h5>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <h4 style="display: inline;color:#000000">Code de l'Agence:
                                                    </h4>
                                                    <h5 style="display: inline;color:#000000">
                                                        {{ $inssurance->agency_code }}
                                                    </h5>
                                                </th>


                                        </table>
                                    </div>

                                </div>
                            @endforeach

                        </div>


                        <div class="page-header" style="background-color:#ffffff">
                            <h4 style="color:#f06431;">Déclarations des accidents:</h4>


                            @php
                                $i = 0;
                            @endphp


                            @foreach ($accicents as $accident)
                                @php
                                    $i = $i + 1;
                                @endphp
                                <div class="sidenav">

                                    <button class="dropdown-btn">Accident {{ $i }}: déclaré le
                                        {{ $accident->declaration_date }}
                                        <i class="fa fa-caret-down"></i>
                                    </button>
                                    <div class="dropdown-container">
                                        <table style=" width: 90%;border-collapse: collapse;">
                                            <tr>
                                                <th>
                                                    <h4 style="display: inline;color:rgb(42, 165, 124)">ID: </h4>
                                                    <h5 style="display: inline;color:#000000">{{ $accident->id }}
                                                    </h5>
                                                </th>
                                                <th>
                                                    <h4 style="display: inline;color:#000000"> Type d'accident:
                                                    </h4>
                                                    <h5 style="display: inline;color:#000000">
                                                        {{ $accident->accident_type }}
                                                    </h5>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <h4 style="display: inline;color:#000000">Conséquences : </h4>
                                                    <h5 style="display: inline;color:#000000">
                                                        {{ $accident->result }}
                                                    </h5>
                                                </th>

                                            </tr>

                                            <tr>
                                                <th>
                                                    <h4 style="display: inline;color:#000000">Conducteur
                                                        adversaire:
                                                    </h4>
                                                    <h5 style="display: inline;color:#000000">
                                                        {{ $accident->opponent_driver_name }}
                                                        {{ $accident->opponent_driver_last_name }}</h5>
                                                </th>

                                                <th>
                                                    <h4 style="display: inline;color:#000000">Conducteur EDEVAL:
                                                    </h4>
                                                    <h5 style="display: inline;color:#000000">
                                                        @foreach ($drivers as $driver)
                                                            @if ($driver->id == $accident->driver_id)
                                                                {{ $driver->name }} {{ $driver->last_name }}
                                                            @endif
                                                        @endforeach
                                                    </h5>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <h4 style="display: inline;color:#000000">Assurance du B: </h4>
                                                    <h5 style="display: inline;color:#000000">
                                                        {{ $accident->opponent_insurance }}</h5>
                                                </th>
                                                <th>
                                                    <h4 style="display: inline;color:#000000 ">Documents de
                                                        l'adversaire:
                                                    </h4>
                                                    <h5 style="display: inline;color:#000000">

                                                        <span class="fa fa-eye  " style="color: #3d5fbb"><a
                                                                href="https://parcit.edeval.dz/public/files/accidents_files/{{ $accident->path }}">

                                                        </span>

                                                        </a>
                                                    </h5>
                                                </th>
                                            </tr>

                                            <tr>
                                                <th>
                                                    <h4 style="display: inline;color:#000000">N° de l'assurance de
                                                        l'adversaire:
                                                    </h4>
                                                    <h5 style="display: inline;color:#000000">
                                                        {{ $accident->opponent_number_insurance }}</h5>
                                                </th>
                                                <th>
                                                    <h4 style="display: inline;color:#000000">Adresse de l'agence
                                                        de
                                                        l'assurance
                                                        adversaire:
                                                    </h4>
                                                    <h5 style="display: inline;color:#000000">
                                                        {{ $accident->opponent_insurance_address }}</h5>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <h4 style="display: inline;color:#000000">Date de l'expertise:
                                                    </h4>
                                                    <h5 style="display: inline;color:#000000">
                                                        {{ $accident->expertise_date }}
                                                    </h5>
                                                </th>
                                                <th>
                                                    <h4 style="display: inline;color:#000000 ">État d'avancement du
                                                        dossier:
                                                    </h4>
                                                    <h5 style="display: inline;color:#000000">
                                                        {{ $accident->state }}
                                                    </h5>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <h4 style="display: inline;color:#000000">Causes d'accident:
                                                    </h4>
                                                    <h5 style="display: inline;color:#000000">
                                                        {{ $accident->cause }}
                                                    </h5>
                                                </th>
                                                <th>

                                                </th>
                                            </tr>
                                        </table>
                                    </div>

                                </div>
                            @endforeach


                        </div>
                        <div class="page-header" style="background-color:#ffffff">
                            <h4 style="color:#f06431;">Vignettes:</h4>

                            @php
                                $i = 0;
                            @endphp


                            @foreach ($stickers as $sticker)
                                <div class="sidenav">

                                    @php
                                        $i = $i + 1;
                                    @endphp
                                    <p class="dropdown-btn">Vignettes {{ $i }}: Année
                                        {{ $sticker->year }}
                                        {{ $sticker->validity }}.

                                    </p>


                                </div>
                            @endforeach

                        </div>
                        <div class="page-header" style="background-color:#ffffff">
                            <h4 style="color:#f06431;">Contrôles techniques:</h4>
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($technicalcontrolls as $technicalcontroll)
                                <div class="sidenav">

                                    @php
                                        $i = $i + 1;
                                    @endphp
                                    <button class="dropdown-btn">Contrôles techniques {{ $i }}: de
                                        {{ $technicalcontroll->effective_date }} à
                                        {{ $technicalcontroll->expiration_date }}.
                                        <i class="fa fa-caret-down"></i>
                                    </button>
                                    <div class="dropdown-container">
                                        <table style=" width: 90%;border-collapse: collapse;">
                                            <tr>
                                                <th>
                                                    <h4 style="display: inline;color:rgb(42, 165, 124)">ID: </h4>
                                                    <h5 style="display: inline;color:#000000">
                                                        {{ $technicalcontroll->id }}
                                                    </h5>
                                                </th>

                                            </tr>
                                            <tr>

                                                <th>
                                                    <h4 style="display: inline;color:#000000">Réserve: </h4>
                                                    <h5 style="display: inline;color:#000000">
                                                        {{ $technicalcontroll->reserve }}</h5>
                                                </th>
                                            </tr>

                                            <tr>
                                                <th>
                                                    <h4 style="display: inline;color:#000000 ">Numéro du contrôle
                                                        Technique:
                                                    </h4>
                                                    <h5 style="display: inline;color:#000000">
                                                        {{ $technicalcontroll->technical_control_number }}</h5>
                                                </th>
                                                <th>
                                                    <h4 style="display: inline;color:#000000">L'organisme émetteur:
                                                    </h4>
                                                    <h5 style="display: inline;color:#000000">
                                                        {{ $technicalcontroll->transmitter }}
                                                    </h5>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <h4 style="display: inline;color:#000000">Observation: </h4>
                                                    <h5 style="display: inline;color:#000000">
                                                        {{ $technicalcontroll->observation }}
                                                    </h5>
                                                </th>
                                                <th>
                                                    <h4 style="display: inline;color:#000000">Contrôle technique
                                                        SirGaz:
                                                    </h4>
                                                    <h5 style="display: inline;color:#000000">
                                                        {{ $technicalcontroll->SirGaz }}
                                                    </h5>

                                                </th>
                                            </tr>
                                        </table>
                                    </div>

                                </div>
                            @endforeach

                        </div>
                        <div class="page-header" style="background-color:#ffffff">
                            <h4 style="color:#f06431;">Permis de circulation: </h4>

                            @php
                                $i = 0;
                            @endphp
                            @foreach ($licences as $licence)
                                <div class="sidenav">

                                    @php
                                        $i = $i + 1;
                                    @endphp
                                    <p class="dropdown-btn">Permis de circulation {{ $i }}: de
                                        {{ $licence->start_date }} à {{ $licence->end_date }}.

                                    </p>


                                </div>
                            @endforeach

                        </div>
                        <div class="page-header" style="background-color:#ffffff">
                            <h4 style="color:#f06431;">Garantis:</h4>

                            @php
                                $i = 0;
                            @endphp
                            @foreach ($garanties as $garantie)
                                <div class="sidenav">

                                    @php
                                        $i = $i + 1;
                                    @endphp
                                    <button class="dropdown-btn">Garantis {{ $i }}:
                                        <i class="fa fa-caret-down"></i>
                                    </button>
                                    <div class="dropdown-container">

                                        <table style=" width: 90%;border-collapse: collapse;">
                                            <tr>
                                                <th>
                                                    <h4 style="display: inline;color:rgb(42, 165, 124)">ID: </h4>
                                                    <h5 style="display: inline;color:#000000">{{ $garantie->id }}
                                                    </h5>
                                                </th>
                                                <th>

                                                    <h4 style="display: inline;color:#000000">Réf de la garantie:
                                                    </h4>
                                                    <h5 style="display: inline;color:#000000">
                                                        {{ $garantie->ref_garanti }}
                                                    </h5>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <h4 style="display: inline;color:#000000">Durée de la Garantie:
                                                    </h4>
                                                    <h5 style="display: inline;color:#000000">
                                                        @if ($garantie->year != '')
                                                            {{ $garantie->year }} <b>Année</b>
                                                        @else
                                                            {{ $garantie->km }} <b>KM</b>
                                                        @endif
                                                    </h5>
                                                </th>
                                                <th>
                                                    <h4 style="display: inline;color:#000000">Type de garantie:
                                                    </h4>
                                                    <h5 style="display: inline;color:#000000">
                                                        {{ $garantie->garanti_type }}
                                                    </h5>

                                                </th>
                                            </tr>

                                            <tr>
                                                <th>
                                                    <h4 style="display: inline;color:#000000 ">Réf du fournisseur::
                                                    </h4>
                                                    <h5 style="display: inline;color:#000000">
                                                        {{ $garantie->ref_vendor }}
                                                    </h5>
                                                </th>

                                                <th>
                                                    <h4 style="display: inline;color:#000000">Infos du Fournisseur:
                                                    </h4>
                                                    <h5 style="display: inline;color:#000000"><b> Nom
                                                            fournisser</b>
                                                        {{ $garantie->name_vendor }} </h5>


                                                </th>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <h4 style="display: inline;color:#000000">Adresse </h4>
                                                    <h5 style="display: inline;color:#000000">
                                                        {{ $garantie->address_vendor }} </h5>

                                                </th>

                                                <th>
                                                    <h4 style="display: inline;color:#000000">Service Après-Vente:
                                                    </h4>
                                                    <h5 style="display: inline;color:#000000">
                                                        {{ $garantie->after_sold_service }} </h5>

                                                </th>

                                            </tr>


                                        </table>
                                    </div>

                                </div>
                            @endforeach

                        </div>













                        <div class="page-header" style="background-color:#ffffff">
                            <h4 style="color:#f06431;">Consomation du carburant :</h4>

                            @php
                                $i = 0;
                            @endphp
                            @foreach ($gases as $gase)
                                <div class="sidenav">

                                    @php
                                        $i = $i + 1;
                                    @endphp
                                    <button class="dropdown-btn">Consomation {{ $i }}:
                                        <i class="fa fa-caret-down"></i>
                                    </button>
                                    <div class="dropdown-container">

                                        <table style=" width: 90%;border-collapse: collapse;">
                                            <tr>
                                                <th>
                                                    <h4 style="display: inline;color:rgb(42, 165, 124)">ID: </h4>
                                                    <h5 style="display: inline;color:#000000">{{ $gase->id }}
                                                    </h5>
                                                </th>
                                                <th>

                                                    <h4 style="display: inline;color:#000000">Nom et prénom du conducteur:
                                                    </h4>
                                                    @foreach ($drivers as $driver)
                                                        @if($driver->id==$gase->driver_id)
                                                        <h5 style="display: inline;color:#000000">
                                                            {{ $driver->name }} {{ $driver->last_name }}
                                                        </h5>
                                                        @endif
                                                    @endforeach

                                                </th>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <h4 style="display: inline;color:#000000"> Agent remplisseur:
                                                    </h4>
                                                    @foreach ($staffs as $driver)
                                                        @if($driver->id==$gase->staff_id)
                                                        <h5 style="display: inline;color:#000000">
                                                            {{ $driver->name }} {{ $driver->last_name }}
                                                        </h5>
                                                        @endif
                                                    @endforeach
                                                </th>
                                                <th>
                                                    <h4 style="display: inline;color:#000000">Date:
                                                    </h4>
                                                    <h5 style="display: inline;color:#000000">
                                                        {{ $gase->date }}
                                                    </h5>

                                                </th>
                                            </tr>

                                            <tr>
                                                <th>
                                                    <h4 style="display: inline;color:#000000 ">KM:
                                                    </h4>
                                                    <h5 style="display: inline;color:#000000">
                                                        {{ $gase->km }}
                                                    </h5>
                                                </th>

                                                <th>
                                                    <h4 style="display: inline;color:#000000">Type du Carburant:
                                                    </h4>
                                                    <h5 style="display: inline;color:#000000"><b> Nom
                                                            fournisser</b>
                                                        {{ $gase->type }} </h5>


                                                </th>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <h4 style="display: inline;color:#000000">N du ticket: </h4>
                                                    <h5 style="display: inline;color:#000000">
                                                        {{ $gase->ticket }} </h5>

                                                </th>

                                                <th>
                                                    <h4 style="display: inline;color:#000000">Coût:
                                                    </h4>
                                                    <h5 style="display: inline;color:#000000">
                                                        {{ $gase->price }} </h5>

                                                </th>

                                            </tr>

                                            <tr>
                                                <th>
                                                    <h4 style="display: inline;color:#000000">Litre: </h4>
                                                    <h5 style="display: inline;color:#000000">
                                                        {{ $gase->litter }} </h5>

                                                </th>



                                            </tr>
                                        </table>
                                    </div>

                                </div>
                            @endforeach

                        </div>












                    </div>
                </div>
            </div>
            <br> <button id="button" class="btn btn-warning btn-round"><span class="fa fa-print  "
                    style="color: #000000"> </span> Imprimer</button>


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
                    }

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
