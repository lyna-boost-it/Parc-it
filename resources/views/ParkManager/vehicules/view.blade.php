
                            @if(Auth::user()->type=='Gestionnaire parc' ||Auth::user()->type=='Utilisateur'||Auth::user()->type=='Gestionnaire Sup'  )


                            <!DOCTYPE html>
<html>
	@include('layouts.headForindexx')

	<body>

        @include('layouts.header-bar')
        @include('layouts.navbar')



		<div class="main-container">
			<div class="xs-pd-20-10 pd-ltr-20">

                <div id="test">
                    <div class="page-header">
                        <div class="row">
                                <div class="title">
                                    <h3>Fiche Technique: </h3>
                                </div>

                        </div>
                    </div>




                    <div class="page-header">
                        <div class="row">
                                <div class="title">
                                    <h4 style="color:brown">Information de Vihicule:  </h4>
                                </div>

                        </div>
                    </div>



                                    <div class="row">




                                        <div class="col-md-6  ">
                                            <div class="panel">
                                                <div class="panel-body bio-chart"  >
                                                        <h4  style="display: inline;color:rgb(42, 165, 124)">ID: </h4>
                                                        <h5  style="display: inline;">{{ $vehicule->code }}</h5>
                                                        <br>
                                                        <h4 style="display: inline;" > Numéro de Série: </h4>
                                                        <h5 style="display: inline;">{{ $vehicule->serial_numbers }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6  ">
                                            <div class="panel">
                                                <div class="panel-body bio-desk">
                                                        <h4   style="display: inline;">Année Mise en Service: </h4>
                                                        <h5 style="display: inline;">{{ $vehicule->year_commissioned }}</h5>
                                                        <br>
                                                        <h4  style="display: inline; ">Type du Carburant: </h4>
                                                        <h5 style="display: inline;">{{ $vehicule->type_of_fuel }}</h5>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-6  ">
                                            <div class="panel">
                                                <div class="panel-body bio-chart">
                                                    <h4  style="display: inline;" >Capacité réservoir: </h4>
                                                    <h5 style="display: inline;">{{$vehicule->tank_capacity }}</h5>
                                                    <br>
                                                    <h4  style="display: inline;" >LTR / 100Km:</h4>
                                                    <h5 style="display: inline;">{{ $vehicule->litter_by_100km }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6  ">
                                            <div class="panel">
                                                <div class="panel-body bio-desk">
                                                    <h4  style="display: inline;" >Type de véhicule: </h4>
                                                    <h5 style="display: inline;">{{ $vehicule->vehicle_type }}</h5>
                                                    <br>
                                                    <h4  style="display: inline;" >Dimensions pneus:</h4>
                                                    <h5 style="display: inline;">{{ $vehicule->tire_size }}</h5>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-6  ">
                                            <div class="panel">
                                                <div class="panel-body bio-chart">
                                                    <h4 style="display: inline;" >Pressions Av: </h4>
                                                    <h5 style="display: inline;"> {{ $vehicule->pressure_forward }}</h5>
                                                    <br>
                                                    <h4  style="display: inline;">Pressions Ar: </h4>
                                                    <h5 style="display: inline;">{{ $vehicule->pressure_back }}</h5>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-md-6  ">
                                            <div class="panel">
                                                <div class="panel-body bio-desk">
                                                    <h4  style="display: inline;" >Les informations de la CARTE GRISE:</h4>
                                                    <h5 style="display: inline;"> <a  href="/files/carteGrise_files/{{ $vehicule->path }}" >


                                                        <span class="fa fa-eye  " style="color: #7e3dbb"> </span>

                                                    </a></h5>
                                                    <br>
                                                    <h4  style="display: inline;" >Date d'acquisition:</h4>
                                                    <h5 style="display: inline;">{{ $vehicule->acquisition_date }}</h5>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-6  ">
                                            <div class="panel">
                                                <div class="panel-body bio-chart">
                                                    <h4  style="display: inline;" >Etat GPS: </h4>
                                                    <h5 style="display: inline;">{{ $vehicule->registration }}</h5>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6  ">
                                            <div class="panel">
                                                <div class="panel-body bio-desk">
                                                    <h4  style="display: inline;" >Affectation: </h4>
                                                    <h5 style="display: inline;">{{ $unit->name }}</h5>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="page-header">
                                        <div class="row">
                                                <div class="title">
                                                    <h4 style="color:brown">Assurances:  </h4>
                                                </div>

                                        </div>
                                    </div>

                            @foreach ($inssurances as $inssurance)
                                    <div class="row">




                                        <div class="col-md-6  ">
                                            <div class="panel">
                                                <div class="panel-body bio-chart"  >
                                                        <h4  style="display: inline;color:rgb(42, 165, 124)">ID: </h4>
                                                        <h5  style="display: inline;">{{ $inssurance->id }}</h5>
                                                        <br>
                                                        <h4 style="display: inline;" > Numéro de police d'Assurance: </h4>
                                                        <h5 style="display: inline;">{{ $inssurance->police_number }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6  ">
                                            <div class="panel">
                                                <div class="panel-body bio-desk">
                                                        <h4   style="display: inline;">Date d'effet: </h4>
                                                        <h5 style="display: inline;">{{ $inssurance->effective_date }}</h5>
                                                        <br>
                                                        <h4  style="display: inline; ">Nom de la compagnie: </h4>
                                                        <h5 style="display: inline;">{{ $inssurance->company_name }}</h5>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-6  ">
                                            <div class="panel">
                                                <div class="panel-body bio-chart">
                                                    <h4  style="display: inline;" >Type d'assurance: </h4>
                                                    <h5 style="display: inline;">{{$inssurance->agency_code }}</h5>
                                                    <br>
                                                    <h4  style="display: inline;" >Adresse de l'agence:</h4>
                                                    <h5 style="display: inline;">{{ $inssurance->insurance_type }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6  ">
                                            <div class="panel">
                                                <div class="panel-body bio-desk">
                                                    <h4  style="display: inline;" >Code de l'Agence: </h4>
                                                    <h5 style="display: inline;">{{$inssurance->agency_code }}</h5>

                                                </div>
                                            </div>
                                        </div>


                                    </div>
                            @endforeach
                            <div class="page-header">
                                <div class="row">
                                        <div class="title">
                                            <h4 style="color:brown">Déclarations des accidents:  </h4>
                                        </div>

                                </div>
                            </div>
                            @foreach ($accicents as $accident)

                                    <div class="row">




                                        <div class="col-md-6  ">
                                            <div class="panel">
                                                <div class="panel-body bio-chart"  >
                                                        <h4  style="display: inline;color:rgb(42, 165, 124)">ID: </h4>
                                                        <h5  style="display: inline;">{{ $accident->id }}</h5>
                                                        <br>
                                                        <h4 style="display: inline;" > Type d'accident: </h4>
                                                        <h5 style="display: inline;">{{ $accident->accident_type }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6  ">
                                            <div class="panel">
                                                <div class="panel-body bio-desk">
                                                        <h4   style="display: inline;">Conséquences : </h4>
                                                        <h5 style="display: inline;">{{ $accident->result }}</h5>
                                                        <br>
                                                        <h4  style="display: inline; ">Date de déclaration : </h4>
                                                        <h5 style="display: inline;">{{ $accident->declaration_date }}</h5>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-6  ">
                                            <div class="panel">
                                                <div class="panel-body bio-chart">
                                                    <h4  style="display: inline;" >Conducteur adversaire: </h4>
                                                    <h5 style="display: inline;">{{$accident->opponent_driver_name }} {{$accident->opponent_driver_last_name }}</h5>
                                                    <br>
                                                    <h4  style="display: inline;" >Conducteur EDEVAL:</h4>
                                                    <h5 style="display: inline;"> @foreach ($drivers as $driver )
                                                        @if($driver->id== $accident->driver_id)
                                                        {{$driver->name }} {{$driver->last_name }}
                                                        @endif
                                                        @endforeach</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6  ">
                                            <div class="panel">
                                                <div class="panel-body bio-desk">
                                                    <h4  style="display: inline;" >Assurance du B: </h4>
                                                    <h5 style="display: inline;">{{$accident->opponent_insurance }}</h5>
                                                    <br>
                                                    <h4  style="display: inline; ">Documents de l'adversaire: </h4>
                                                    <h5 style="display: inline;">

                                                        <span class="fa fa-eye  " style="color: #3d5fbb"><a  href="/files/accidents_files/{{ $accident->path }}"  > </span>

                                                    </a></h5>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6  ">
                                            <div class="panel">
                                                <div class="panel-body bio-chart"  >
                                                        <h4  style="display: inline;">N° de l'assurance de l'adversaire: </h4>
                                                        <h5  style="display: inline;">{{$accident->opponent_number_insurance }}</h5>
                                                        <br>
                                                        <h4 style="display: inline;" >Adresse de l'agence de l'assurance adversaire: </h4>
                                                        <h5 style="display: inline;">{{$accident->opponent_insurance_address }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6  ">
                                            <div class="panel">
                                                <div class="panel-body bio-desk">
                                                        <h4   style="display: inline;">Date de l'expertise: </h4>
                                                        <h5 style="display: inline;">{{$accident->expertise_date }}</h5>
                                                        <br>
                                                        <h4  style="display: inline; ">État d'avancement du dossier: </h4>
                                                        <h5 style="display: inline;">{{$accident->state }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6  ">
                                            <div class="panel">
                                                <div class="panel-body bio-chart"  >
                                                        <h4  style="display: inline;">Causes d'accident: </h4>
                                                        <h5  style="display: inline;">{{$accident->cause }}</h5>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            @endforeach

                            <div class="page-header">
                                <div class="row">
                                        <div class="title">
                                            <h4 style="color:brown">Vignettes:  </h4>
                                        </div>

                                </div>
                            </div>
                            @foreach ($stickers as $sticker)

                                     <div class="row">




                                        <div class="col-md-6  ">
                                            <div class="panel">
                                                <div class="panel-body bio-chart"  >
                                                        <h4  style="display: inline;color:rgb(42, 165, 124)">ID: </h4>
                                                        <h5  style="display: inline;">{{ $sticker->id }}</h5>
                                                        <br>
                                                        <h4 style="display: inline;" > Année (en cours): </h4>
                                                        <h5 style="display: inline;">{{ $sticker->year }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6  ">
                                            <div class="panel">
                                                <div class="panel-body bio-desk">
                                                        <h4   style="display: inline;">Validité: </h4>
                                                        <h5 style="display: inline;">{{ $sticker->validity }}</h5>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                            @endforeach
                            <div class="page-header">
                                <div class="row">
                                        <div class="title">
                                            <h4 style="color:brown">Contrôles techniques:  </h4>
                                        </div>

                                </div>
                            </div>
                            @foreach ($technicalcontrolls as $technicalcontroll)

                                    <div class="row">




                                        <div class="col-md-6  ">
                                            <div class="panel">
                                                <div class="panel-body bio-chart"  >
                                                        <h4  style="display: inline;color:rgb(42, 165, 124)">ID: </h4>
                                                        <h5  style="display: inline;">{{ $technicalcontroll->id }}</h5>
                                                        <br>
                                                        <h4 style="display: inline;" > Date d'effet: </h4>
                                                        <h5 style="display: inline;">{{ $technicalcontroll->effective_date }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6  ">
                                            <div class="panel">
                                                <div class="panel-body bio-desk">
                                                        <h4   style="display: inline;">Date limite: </h4>
                                                        <h5 style="display: inline;">{{ $technicalcontroll->expiration_date }}</h5>
                                                        <br>
                                                        <h4 style="display: inline;" >Réserve: </h4>
                                                        <h5 style="display: inline;">{{ $technicalcontroll->reserve }}</h5>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6  ">
                                            <div class="panel">
                                                <div class="panel-body bio-chart"  >
                                                        <h4  style="display: inline; ">Numéro du contrôle Technique: </h4>
                                                        <h5  style="display: inline;">{{ $technicalcontroll->technical_control_number }}</h5>
                                                        <br>
                                                        <h4 style="display: inline;" >L'organisme émetteur: </h4>
                                                        <h5 style="display: inline;">{{ $technicalcontroll->transmitter }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6  ">
                                            <div class="panel">
                                                <div class="panel-body bio-desk">
                                                        <h4   style="display: inline;">Observation: </h4>
                                                        <h5 style="display: inline;">{{ $technicalcontroll->observation }}</h5>
                                                        <br>
                                                        <h4 style="display: inline;" >Contrôle technique SirGaz: </h4>
                                                        <h5 style="display: inline;">{{ $technicalcontroll->SirGaz }}</h5>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            @endforeach


                            <div class="page-header">
                                <div class="row">
                                        <div class="title">
                                            <h4 style="color:brown">Permis de circulation:  </h4>
                                        </div>

                                </div>
                            </div>
                            @foreach ($licences as $licence)

                                    <div class="row">




                                        <div class="col-md-6  ">
                                            <div class="panel">
                                                <div class="panel-body bio-chart"  >
                                                        <h4  style="display: inline;color:rgb(42, 165, 124)">ID: </h4>
                                                        <h5  style="display: inline;">{{ $licence->id }}</h5>
                                                        <br>
                                                        <h4 style="display: inline;" >Durée: </h4>
                                                        <h5 style="display: inline;">{{ $licence->duration }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6  ">
                                            <div class="panel">
                                                <div class="panel-body bio-desk">
                                                        <h4   style="display: inline;">Date debut: </h4>
                                                        <h5 style="display: inline;">{{ $licence->start_date }}</h5>
                                                        <br>
                                                        <h4 style="display: inline;" >Date fin: </h4>
                                                        <h5 style="display: inline;">{{ $licence->end_date }}</h5>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            @endforeach

                            <div class="page-header">
                                <div class="row">
                                        <div class="title">
                                            <h4 style="color:brown">Garantis:  </h4>
                                        </div>

                                </div>
                            </div>

                            @foreach ($garanties as $garantie)

                            <div class="row">




                                <div class="col-md-6  ">
                                    <div class="panel">
                                        <div class="panel-body bio-chart"  >
                                                <h4  style="display: inline;color:rgb(42, 165, 124)">ID: </h4>
                                                <h5  style="display: inline;">{{ $garantie->id }}</h5>
                                                <br>
                                                <h4 style="display: inline;" >Réf de la garantie: </h4>
                                                <h5 style="display: inline;">{{ $garantie->ref_garanti }}</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6  ">
                                    <div class="panel">
                                        <div class="panel-body bio-desk">
                                                <h4   style="display: inline;">Durée de la Garantie(par Km ou par Année): </h4>
                                                <h5 style="display: inline;">
                                                    @if($garantie->year!='')
                                                    {{ $garantie->year }} <b>Année</b>
                                                    @else
                                                    {{ $garantie->km }} <b>KM</b></h5>
                                                    @endif
                                                <br>
                                                <h4 style="display: inline;" >Type de garantie: </h4>
                                                <h5 style="display: inline;">{{ $garantie->garanti_type }}</h5>

                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-6  ">
                                    <div class="panel">
                                        <div class="panel-body bio-chart"  >
                                                <h4  style="display: inline; ">Réf du fournisseur:: </h4>
                                                <h5  style="display: inline;">{{ $garantie->ref_vendor }}</h5>
                                                <br>
                                                <h4 style="display: inline;" >Infos du Fournisseur: </h4>
                                                <h5 style="display: inline;"><b> Nom fournisser</b> {{ $garantie->name_vendor }}
                                                    <b>Adresse</b>{{ $garantie->address_vendor }} </h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6  ">
                                    <div class="panel">
                                        <div class="panel-body bio-desk">
                                                <h4   style="display: inline;">Service Après-Vente: </h4>
                                                <h5 style="display: inline;">{{ $garantie->after_sold_service }}  </h5>


                                        </div>
                                    </div>
                                </div>
                            </div>
                    @endforeach



                </div>
            </div>
            <button class="btn btn-warning btn-round"> <a href="javascript:generatePDF()">Télécharger le PDF</a></button>
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
