@if (Auth::user()->type == 'Gestionnaire parc' ||
    Auth::user()->type == 'Utilisateur' ||
    Auth::user()->type == 'Gestionnaire Sup')


    <!DOCTYPE html>
    <html>
    @include('layouts.headForindexx')

    <body>

        @include('layouts.header-bar')
        @include('layouts.navbar')

        <div class="mobile-menu-overlay"></div>

        <div class="main-container">
            <div class="row">
                <div class="col-md-4">


                </div>
                <div class="col-md-12 text-center">
                    <form action="{{ route('ParkManager.vehicules.update', $vehicule->id) }}" method="post">

                        @csrf {{ method_field('PUT') }}


                        <div class="card">



                            <div class="card-header">
                                <h5 class="title">{{ __('Modifier un véhicule ') }}</h5>
                            </div><br><br>
                            <div class="card-body">
                                <fieldset>
                                    <legend>Information de la carse Grise:</legend>
                                    <br><br>
                                    <div class="row">

                                        <div class="col-md-4">
                                            <label>{{ __('Genre') }}</label>
                                            <div class="form-group">
                                                <input type="text" name="genre" class="form-control"
                                                    placeholder="Genre de véhicule" value="{{ $vehicule->genre }}"
                                                    required>
                                            </div>

                                        </div>

                                        <div class="col-md-4">
                                            <label>{{ __('Marque de véhicule') }}</label>
                                            <div class="form-group">
                                                <input type="text" name="mark" class="form-control"
                                                    placeholder="Marque de véhicule" value="{{ $vehicule->mark }}"
                                                    required>
                                            </div>

                                        </div>
                                        <div class="col-md-4">
                                            <label>{{ __('Type de véhicule') }}</label>
                                            <div class="form-group">
                                                <input type="text" name="type" class="form-control"
                                                    placeholder="Type de véhicule" value="{{ $vehicule->type }}"
                                                    required>
                                            </div>

                                        </div>
                                    </div>



                                    <div class="row">

                                        <div class="col-md-4">
                                            <label>{{ __('Carrosserie') }}</label>
                                            <div class="form-group">
                                                <input type="text" name="crosserie" class="form-control"
                                                    placeholder="Carrosserie de véhicule"
                                                    value="{{ $vehicule->crosserie }}" required>
                                            </div>

                                        </div>
                                        <div class="col-md-4">
                                            <label>{{ __('Energie de véhicule') }}</label>
                                            <div class="form-group">
                                                <select id="type_of_fuel" type="text"
                                                    class="form-control select2 @error('type_of_fuel') is-invalid @enderror"
                                                    name="type_of_fuel" required autocomplete="type_of_fuel" autofocus>
                                                    <option value="" disabled selected>Type du Carburant</option>
                                                    <option value="Essence"
                                                        {{ old('type_of_fuel', $vehicule->type_of_fuel) === 'Essence' ? 'selected' : '' }}>
                                                        Essence</option>
                                                    <option value="Gazole"
                                                        {{ old('type_of_fuel', $vehicule->type_of_fuel) === 'Gazole' ? 'selected' : '' }}>
                                                        Gazole</option>
                                                    <option value="GLP"
                                                        {{ old('type_of_fuel', $vehicule->type_of_fuel) === 'GLP' ? 'selected' : '' }}>
                                                        GPL</option>


                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-md-4">
                                            <label>{{ __('Puissance de véhicule') }}</label>
                                            <div class="form-group">
                                                <input type="text" name="power" class="form-control"
                                                    placeholder="Puissance de véhicule" value="{{ $vehicule->power }}"
                                                    required>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-md-4">
                                            <label>{{ __('Places assises') }}</label>
                                            <div class="form-group">
                                                <input type="text" name="places" class="form-control"
                                                    placeholder="Places assises" value="{{ $vehicule->places }}"
                                                    required>
                                            </div>

                                        </div>

                                        <div class="col-md-4">
                                            <label>{{ __('Poids total en charge') }}</label>
                                            <div class="form-group">
                                                <input type="text" name="weight" step="0.01" class="form-control"
                                                    placeholder="Poids total en charge" value="{{ $vehicule->weight }}"
                                                    required>
                                            </div>

                                        </div>
                                        <div class="col-md-4">
                                            <label>{{ __('Charge utile') }}</label>
                                            <div class="form-group">
                                                <input type="text" name="charge" class="form-control"
                                                    placeholder="Charge utile" value="{{ $vehicule->charge }}"
                                                    required>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-md-4">
                                            <label>{{ __('N D\'imatriculation') }}</label>
                                            <div class="form-group">
                                                <input type="text" name="marticule" class="form-control"
                                                    placeholder="N D\'imatriculation"
                                                    value="{{ $vehicule->marticule }}" required>
                                            </div>

                                        </div>

                                        <div class="col-md-4">
                                            <label>{{ __('Precedent numero') }}</label>
                                            <div class="form-group">
                                                <input type="text" name="precedent" class="form-control"
                                                    placeholder="Precedent numero" value="{{ $vehicule->precedent }}"
                                                    required>
                                            </div>

                                        </div>
                                        <div class="col-md-4">
                                            <label>{{ __('Annee de premiere mise en circulation') }}</label>
                                            <div class="form-group">
                                                <input type="date" name="moving_year" class="form-control"
                                                    placeholder="Annee de premiere mise en circulation"
                                                    value="{{ $vehicule->moving_year }}" required>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <label
                                                class="col-md-3 col-form-label">{{ __('Information de la carte grise') }}</label>


                                            <input type="file" id="docpicker" name="path"
                                                accept=".doc,.xml,.pdf">

                                        </div>
                                    </div>
                            </div>

                            </fieldset>

                            <div class="card-body">
                                <fieldset>
                                    <legend>Information technique du véhicule:</legend>

                                    <div class="row">


                                        <div class="col-md-4">
                                            <label>{{ __('Code de véhicule') }}</label>
                                            <div class="form-group">
                                                <input type="text" name="code" class="form-control"
                                                    placeholder="Code de véhicule" value="{{ $vehicule->code }}"
                                                    required>
                                            </div>

                                        </div>

                                        <div class="col-md-4">
                                            <label>{{ __('Numéro de Série') }}</label>
                                            <div class="form-group">
                                                <input type="text" name="serial_numbers" class="form-control"
                                                    placeholder=" Numéro de Série"
                                                    value="{{ $vehicule->serial_numbers }}" required>
                                            </div>

                                        </div>
                                        <div class="col-md-4">
                                            <label>{{ __('Catégorie de véhicule') }}</label>
                                            <div class="form-group">
                                                <select id="vehicle_type" type="text"
                                                    class="form-control select2 @error('vehicle_type') is-invalid @enderror"
                                                    name="vehicle_type" required autocomplete="vehicle_type"
                                                    autofocus>
                                                    <option value="Camion-citerne"
                                                        {{ old('vehicle_type', $vehicule->vehicle_type) === 'Camion-citerne' ? 'selected' : '' }}>
                                                        Camion-citerne</option>
                                                    <option value="Camion benne"
                                                        {{ old('vehicle_type', $vehicule->vehicle_type) === 'Camion benne' ? 'selected' : '' }}>
                                                        Camion benne</option>
                                                    <option value="Autobus"
                                                        {{ old('vehicle_type', $vehicule->vehicle_type) === 'Autobus' ? 'selected' : '' }}>
                                                        Autobus </option>
                                                    <option value="Automobile"
                                                        {{ old('vehicle_type', $vehicule->vehicle_type) === 'Automobile' ? 'selected' : '' }}>
                                                        Automobile </option>
                                                    <option value="Voiture"
                                                        {{ old('vehicle_type', $vehicule->vehicle_type) === 'Voiture' ? 'selected' : '' }}>
                                                        Voiture </option>
                                                </select>
                                            </div>

                                        </div>


                                    </div>



                                    <div class="row">


                                        <div class="col-md-4">
                                            <label>{{ __('Année Mise en Service') }}</label>
                                            <div class="form-group">
                                                <input type="date" name="year_commissioned" class="form-control"
                                                    placeholder=" Année Mise en
                                                                         Service"
                                                    value="{{ $vehicule->year_commissioned }}" required>
                                            </div>

                                        </div>
                                        <div class="col-md-4">
                                            <label>{{ __('Capacité réservoir') }}</label>
                                            <div class="form-group">
                                                <input type="number" name="tank_capacity" class="form-control"
                                                    placeholder="Capacité réservoir en littre"
                                                    value="{{ $vehicule->tank_capacity }}" required>
                                            </div>

                                        </div>
                                        <div class="col-md-4">
                                            <label>{{ __('LTR / 100Km') }}</label>
                                            <input type="number"step="0.01" name="litter_by_100km"
                                                class="form-control" placeholder="LTR / 100Km"
                                                value="{{ $vehicule->litter_by_100km }}" required>
                                        </div>

                                    </div>


                                    <div class="row">


                                        <div class="col-md-4">
                                            <label>{{ __('Dimensions pneus') }}</label>
                                            <div class="form-group">
                                                <input type="text" name="tire_size" class="form-control"
                                                    placeholder="Dimensions pneus" value="{{ $vehicule->tire_size }}"
                                                    required>
                                            </div>

                                        </div>
                                        <div class="col-md-4">
                                            <label>{{ __('Pressions Av et Ar') }}</label>
                                            <div class="form-group">
                                                <input type="number" step="0.01" name="pressure_forward"
                                                    class="form-control" placeholder="Pressions Av"
                                                    value="{{ $vehicule->pressure_forward }}" required>
                                                <input type="number" name="pressure_back" class="form-control"
                                                    placeholder="Pressions Ar" value="{{ $vehicule->pressure_back }}"
                                                    required>
                                            </div>

                                        </div>
                                        <div class="col-md-4">
                                            <label>{{ __('Type de Batterie') }}</label>
                                            <div class="form-group">
                                                <select id="battery_type" type="text"
                                                    class="form-control select2 @error('battery_type') is-invalid
                                                          @enderror"
                                                    name="battery_type" required autocomplete="battery_type"
                                                    autofocus>
                                                    <option value="" disabled selected>Type de Batterie
                                                    </option>
                                                    <option value="Batteries à plomb-acide"
                                                        {{ old('battery_type', $vehicule->battery_type) === 'Batteries à plomb-acide' ? 'selected' : '' }}>
                                                        Batteries à plomb-acide</option>
                                                    <option value="Batteries AGM"
                                                        {{ old('battery_type', $vehicule->battery_type) === 'Batteries AGM' ? 'selected' : '' }}>
                                                        Batteries AGM</option>
                                                    <option value="Piles EFB"
                                                        {{ old('Piles EFB', $vehicule->battery_type) === 'Piles EFB' ? 'selected' : '' }}>
                                                        Piles EFB</option>
                                                    <option value="Piles GEL"
                                                        {{ old('battery_type', $vehicule->battery_type) === 'Piles GEL' ? 'selected' : '' }}>
                                                        Piles GEL</option>
                                                    <option value="Piles au lithium-ion"
                                                        {{ old('battery_type', $vehicule->battery_type) === 'Piles au lithium-ion' ? 'selected' : '' }}>
                                                        Piles au lithium-ion
                                                    </option>


                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">


                                        <div class="col-md-4">
                                            <label>{{ __('Date d’acquisition') }}</label>
                                            <div class="form-group">
                                                <input type="date" name="acquisition_date" class="form-control"
                                                    placeholder="Date d’acquisition"
                                                    value="{{ $vehicule->acquisition_date }}" required>
                                            </div>

                                        </div>
                                        <div class="col-md-4">
                                            <label>{{ __('GPS') }}</label>
                                            <div class="form-group">
                                                <select id="registration" type="text"
                                                    class="form-control select2 @error('registration') is-invalid
                                                         @enderror"
                                                    name="registration" required autocomplete="battery_type"
                                                    autofocus>
                                                    <option value="" disabled selected>le vehicule a-t-il un
                                                        gps?
                                                    </option>
                                                    <option value="Oui"
                                                        {{ old('registration', $vehicule->registration) === 'Oui' ? 'selected' : '' }}>
                                                        Oui</option>
                                                    <option value="Non"
                                                        {{ old('registration', $vehicule->registration) === 'Non' ? 'selected' : '' }}>
                                                        Non</option>
                                                    </option>


                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-md-4">
                                            <label>{{ __('Affectation') }}</label>
                                            <div class="form-group">
                                                <select id="unit_id" type="text"
                                                    class="form-control select2 @error('unit_id') is-invalid
                                                 @enderror"
                                                    name="unit_id" required autocomplete="battery_type" autofocus>
                                                    <option value="" disabled selected>choisissez une unité
                                                    </option>
                                                    @foreach ($units as $unit)
                                                        <option value="{{ $unit->id }}">
                                                            {{ $unit->name }}</option>
                                                    @endforeach

                                                    </option>


                                                </select>
                                            </div>

                                        </div>
                                    </div>
                            </div>




                            </fieldset>




                        </div>





                        <div class="card-footer ">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn  btn-round"
                                        style="background:#EE643A;color:#ffffff;">{{ __('Modifier') }}</button>
                                </div>
                            </div>
                        </div>
                </div>
                </form>

            </div>
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
