@if (Auth::user()->type == 'Gestionnaire parc' || Auth::user()->type == 'Utilisateur')

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
                    <form action="{{ route('ParkManager.staffs.store', $staff->id) }}" method="post">

                        @csrf

                        <div class="card">



                            <div class="card-header">
                                <h5 class="title">{{ __('Créer un personnel ') }}</h5>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <label class="col-md-3 col-form-label">{{ __('Type Personnel') }}</label>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <select name="person_type"
                                                value="{{ old('person_type'), $staff->person_type }}"class="form-control"
                                                id="staff_type">
                                                <option value="Conducteur">Conducteur</option>
                                                <option value="Personnel du centre de maintenance">Personnel du centre
                                                    de
                                                    maintenance</option>
                                                <option value="Personnel du parc">Personnel du parc</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                                <div id="conducteur_fieldDiv">

                                    <div style=" display: inline-block;">
                                        <div class="card-body">
                                            <div class="row">
                                                <label
                                                    class="col-md-3 col-form-label">{{ __(' N° Permis de conduire') }}</label>
                                                <div class="col-md-9" for="conducteur_field">
                                                    <div class="form-group">
                                                        <input type="number" id="conducteur_field"
                                                            name="driver_license_number" class="form-control"
                                                            placeholder=" N° Permis de conduire"
                                                            value="{{ $staff->driver_license_number }}">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-body">
                                            <div class="row">
                                                <label
                                                    class="col-md-3 col-form-label">{{ __('Catégorie du permis') }}</label>
                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <select name="driver_license_type"
                                                            value="{{ old('driver_license_type'), $staff->driver_license_type }}"class="form-control"
                                                            id="staff_type">
                                                            <option value="AM"
                                                                {{ old('driver_license_type', $staff->driver_license_type) === 'AM' ? 'selected' : '' }}>
                                                                pas de permis de conduire</option>
                                                            <option value="AM"
                                                                {{ old('driver_license_type', $staff->driver_license_type) === 'AM' ? 'selected' : '' }}>
                                                                AM</option>
                                                            <option value="A1"
                                                                {{ old('driver_license_type', $staff->driver_license_type) === 'A1' ? 'selected' : '' }}>
                                                                A1</option>
                                                            <option value="A2"
                                                                {{ old('driver_license_type', $staff->driver_license_type) === 'A2' ? 'selected' : '' }}>
                                                                A2</option>
                                                            <option value="A"
                                                                {{ old('driver_license_type', $staff->driver_license_type) === 'A' ? 'selected' : '' }}>
                                                                A</option>
                                                            <option value="B"
                                                                {{ old('driver_license_type', $staff->driver_license_type) === 'B' ? 'selected' : '' }}>
                                                                B</option>
                                                            <option value="B1"
                                                                {{ old('driver_license_type', $staff->driver_license_type) === 'B1' ? 'selected' : '' }}>
                                                                B1</option>
                                                            <option value="BE"
                                                                {{ old('driver_license_type', $staff->driver_license_type) === 'BE' ? 'selected' : '' }}>
                                                                BE</option>
                                                            <option value="C"
                                                                {{ old('driver_license_type', $staff->driver_license_type) === 'C' ? 'selected' : '' }}>
                                                                C</option>
                                                            <option value="CE"
                                                                {{ old('driver_license_type', $staff->driver_license_type) === 'CE' ? 'selected' : '' }}>
                                                                CE</option>
                                                            <option value="C1"
                                                                {{ old('driver_license_type', $staff->driver_license_type) === 'C1' ? 'selected' : '' }}>
                                                                C1</option>
                                                            <option value="C1E"
                                                                {{ old('driver_license_type', $staff->driver_license_type) === 'C1E' ? 'selected' : '' }}>
                                                                C1E</option>
                                                            <option value="D"
                                                                {{ old('driver_license_type', $staff->driver_license_type) === 'D' ? 'selected' : '' }}>
                                                                D</option>
                                                            <option value="DE"
                                                                {{ old('driver_license_type', $staff->driver_license_type) === 'DE' ? 'selected' : '' }}>
                                                                DE</option>
                                                            <option value="D1"
                                                                {{ old('driver_license_type', $staff->driver_license_type) === 'D1' ? 'selected' : '' }}>
                                                                D1</option>
                                                            <option value="D1E"
                                                                {{ old('driver_license_type', $staff->driver_license_type) === 'D1E' ? 'selected' : '' }}>
                                                                D1E</option>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div style=" display: inline-block;">
                                        <div class="card-body">
                                            <div class="row">
                                                <label
                                                    class="col-md-3 col-form-label">{{ __(' Date du Permis ') }}</label>
                                                <div class="col-md-9" for="conducteur_field">
                                                    <div class="form-group">
                                                        <input type="date" id="conducteur_field"
                                                            name="driver_license_date" class="form-control"
                                                            placeholder=" Date du Permis "
                                                            value="{{ $staff->driver_license_date }}">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>




                                        <div class="card-body">
                                            <div class="row">
                                                <label
                                                    class="col-md-3 col-form-label">{{ __(' Diplôme pour les conducteurs d\'engins') }}</label>
                                                <div class="col-md-9" for="conducteur_field">
                                                    <div class="form-group">
                                                        <input type="number" id="conducteur_field" name="diploma"
                                                            class="form-control" placeholder="Diplôme"
                                                            value="{{ $staff->diploma }}">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>




                                <div id="Mstaff_fieldDiv">



                                    <div class="card-body" style=" display: inline-block;">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label">{{ __('  Diplôme') }}</label>
                                            <div class="col-md-9" for="Mstaff_field">
                                                <div class="form-group">
                                                    <input type="text" id="Mstaff_field" name="diploma"
                                                        class="form-control" placeholder="Diplôme"
                                                        value="{{ $staff->diploma }}">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body" style=" display: inline-block;">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label">{{ __('Fonction') }}</label>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <select name="function1"
                                                        value="{{ old('function'), $staff->function }}"
                                                        class="form-control" id="function1">
                                                        <option value="Électricien">Électricien</option>
                                                        <option value="Mécanicien">Mécanicien</option>
                                                        <option value="Tolier">Tolier</option>
                                                        <option value="Vulgarisateur">Vulgarisateur</option>
                                                        <option value="Mécanicien spécialisé">Mécanicien spécialisé
                                                            (matériel motorisé)
                                                        </option>   <option value="Autre">Autre
                                                        </option>


                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <div id="staff_fieldDiv">



                                    <div class="card-body" style=" display: inline-block;">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label">{{ __('  Fonction') }}</label>
                                            <div class="col-md-9" for="staff_field">
                                                <div class="form-group">
                                                    <input type="text" id="Mstaff_field" name="function2"
                                                        class="form-control" placeholder="Fonction"
                                                        value="{{ $staff->function }}">
                                                </div>

                                            </div>
                                        </div>
                                    </div>


                                </div>










                                <div class="card-body">
                                    <div class="row">
                                        <label class="col-md-3 col-form-label">{{ __(' Nom') }}</label>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <input type="text" name="name" class="form-control"
                                                    placeholder="Nom" value="{{ $staff->name }}" required>
                                            </div>
                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" style="display: block;"
                                                    role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>


                                <div class="card-body">
                                    <div class="row">
                                        <label class="col-md-3 col-form-label">{{ __(' Prénom') }}</label>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <input type="text" name="last_name" class="form-control"
                                                    placeholder="Prénom" value="{{ $staff->last_name }}" required>
                                            </div>
                                            @if ($errors->has('last_name'))
                                                <span class="invalid-feedback" style="display: block;"
                                                    role="alert">
                                                    <strong>{{ $errors->first('last_name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <label class="col-md-3 col-form-label">{{ __(' Matricule') }}</label>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <input type="number" name="serial_numbers" class="form-control"
                                                    placeholder="  Matricule" value="{{ $staff->serial_numbers }}"
                                                    required>
                                            </div>
                                            @if ($errors->has('serial_numbers'))
                                                <span class="invalid-feedback" style="display: block;"
                                                    role="alert">
                                                    <strong>{{ $errors->first('serial_numbers') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>





                                <div class="card-body">
                                    <div class="row">
                                        <label class="col-md-3 col-form-label">{{ __(' N SS') }}</label>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <input type="number" name="number_ss" class="form-control"
                                                    placeholder="  N SS" value="{{ $staff->number_ss }}" required>
                                            </div>
                                            @if ($errors->has('number_ss'))
                                                <span class="invalid-feedback" style="display: block;"
                                                    role="alert">
                                                    <strong>{{ $errors->first('number_ss') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <label class="col-md-3 col-form-label">{{ __('Sexe') }}</label>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <select name="sex"
                                                    value="{{ old('sex'), $staff->sex }}"class="form-control"
                                                    id="sex">
                                                    <option value="Homme">Homme </option>
                                                    <option value="Femme ">Femme</option>


                                                </select>
                                            </div>
                                        </div>
                                    </div></div>


                                    <div class="card-body">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label">{{ __(' Date de naissance ') }}</label>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <input type="date" id="date_of_birth" name="date_of_birth"
                                                        class="form-control" placeholder=" Date de naissance "
                                                        value="{{ $staff->date_of_birth }}" required>
                                                </div>
                                                @if ($errors->has('date_of_birth'))
                                                    <span class="invalid-feedback" style="display: block;"
                                                        role="alert">
                                                        <strong>{{ $errors->first('date_of_birth') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <label
                                                class="col-md-3 col-form-label">{{ __('Lieu de naissance') }}</label>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <input type="place_of_birth" name="place_of_birth"
                                                        class="form-control" placeholder=" Lieu de naissance"
                                                        value="{{ $staff->place_of_birth }}" required>
                                                </div>
                                                @if ($errors->has('place_of_birth'))
                                                    <span class="invalid-feedback" style="display: block;"
                                                        role="alert">
                                                        <strong>{{ $errors->first('place_of_birth') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>


                                    <div class="card-body">
                                        <div class="row">
                                            <label
                                                class="col-md-3 col-form-label">{{ __(' Situation Familiale') }}</label>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <select name="family_situation"
                                                        value="{{ old('family_situation'), $staff->family_situation }}"
                                                        class="form-control" id="family_situation">
                                                        <option value="Marié">Marié</option>
                                                        <option value="Célibataire">Célibataire</option>
                                                        <option value="Autre">Autre</option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="card-body">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label">{{ __(' Adresse') }}</label>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <input type="address" name="address" class="form-control"
                                                        placeholder=" Adresse" value="{{ $staff->address }}"
                                                        required>
                                                </div>
                                                @if ($errors->has('address'))
                                                    <span class="invalid-feedback" style="display: block;"
                                                        role="alert">
                                                        <strong>{{ $errors->first('address') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>


                                <div class="card-body">
                                    <div class="row">
                                        <label
                                            class="col-md-3 col-form-label">{{ __(' Date de recrutement ') }}</label>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <input type="date" id="date_of_recruitment"
                                                    name="date_of_recruitment" class="form-control"
                                                    placeholder=" Date de date_of_recruitment "
                                                    value="{{ $staff->date_of_recruitment }}" required>
                                            </div>
                                            @if ($errors->has('date_of_recruitment'))
                                                <span class="invalid-feedback" style="display: block;"
                                                    role="alert">
                                                    <strong>{{ $errors->first('date_of_recruitment') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>



                                <div class="card-body">
                                    <div class="row">
                                        <label class="col-md-3 col-form-label">{{ __('Affectation') }}</label>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <select id="unit_id" name="unit_id"
                                                    class="form-control {{ $staff->unit_id === true ? 'select2' : '' }} @error('unit_id') is-invalid @enderror"
                                                    onchange="update_type_vehicle()"
                                                    {{ $staff->unit_id === true ? 'readonly' : '' }}>
                                                    <option disabled selected>Choisissez une unité</option>
                                                    @foreach ($units as $unit)
                                                        <option value="{{ $unit->id }}"
                                                            data-type="{{ $unit->name }}"
                                                            {{ old('unit_id', $staff->unit_id) == $unit->id ? 'selected' : '' }}>
                                                            {{ $unit->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @if ($errors->has('registration'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('registration') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <label class="col-md-3 col-form-label">{{ __(' N° du Téléphone') }}</label>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <input type="phone" name="phone" class="form-control"
                                                    maxlength="10" minlength="10" placeholder="N° du Téléphone"
                                                    value="{{ $staff->number_ss }}" required>
                                            </div>
                                            @if ($errors->has('phone'))
                                                <span class="invalid-feedback" style="display: block;"
                                                    role="alert">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>



                                <div class="card-footer ">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <button type="submit"
                                                class="btn  btn-round" style="background:#EE643A;color:#ffffff;">{{ __('Ajouter') }}</button>
                                        </div>
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
    <style>
        Body
        {
            font-weight: bold;
            color: #000000;
        }

        </style>
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
                $('#staff_fieldDiv').show();
                $('#staff_field').attr('required', '');
                $('#staff_field').attr('data-error', 'This field is required.');
            } else {
                $('#staff_fieldDiv').hide();
                $('#staff_field').removeAttr('required');
                $('#staff_field').removeAttr('data-error');
            }

        });
        $("#staff_type").trigger("change");
    </script>

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
