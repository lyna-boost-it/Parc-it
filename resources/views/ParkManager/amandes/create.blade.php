@if (Auth::user()->type == 'Gestionnaire parc' || Auth::user()->type == 'Utilisateur' ||
Auth::user()->type == 'Technicien')

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
                    <form action="{{ route('ParkManager.amandes.store', $amande->id) }}" method="post">

                        @csrf

                        <div class="card">



                            <div class="card-header">
                                <h5 class="title">{{ __('Créer une amende ') }}</h5>
                            </div>




                            <div class="card-body">
                                <div class="row">
                                    <label
                                        class="col-md-3 col-form-label">{{ __('  Nom et prénom du conducteur') }}<span class="ob">*</span></label>
                                    <div class="col-md-6" for="conducteur_field_for_absence">
                                        <div class="form-group">
                                            <select style="width: 300px" id="selectField" class="vh"
                                                name="driver_id" placeholder="  Nom et prénom de l\'absent"
                                                value="{{ old('driver_id'), $amande->driver_id }}"class="form-control"
                                                id="staff_type">
                                                <option></option>
                                                @foreach ($drivers as $driver)
                                                    <option value="{{ $driver->id }}"
                                                        {{ old('driver_id', $amande->driver_id) === 'driver_id' ? 'selected' : '' }}>
                                                        {{ $driver->name }} {{ $driver->last_name }}</option>
                                                @endforeach

                                            </select>
                                        </div>

                                        <div style="  position: relative;">


                                            @foreach ($drivers as $driver)
                                                <div style="width: 50%; float: left; padding: 20px;position: absolute; "
                                                    id="{{ $driver->id }}" class="content">
                                                    <h1>Fonction: {{ $driver->function }}</h1>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br><br><br>
                            <div class="card-body">
                                <div class="row">
                                    <label
                                        class="col-md-3 col-form-label">{{ __(' Date d\'infraction (amende)  ') }}<span class="ob">*</span></label>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <input type="date" name="date" class="form-control"
                                                placeholder="Date d\'infraction (amande)" value="{{ $amande->p_name }}"
                                                required>
                                        </div>
                                        @if ($errors->has('date'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <div class="card-body">
                                <div class="row">
                                    <label class="col-md-3 col-form-label">{{ __('Infraction') }}<span class="ob">*</span></label>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <input type="text" name="infraction" class="form-control"
                                                placeholder="Infraction"
                                                value="{{ $amande->infraction }}" required>
                                        </div>
                                        @if ($errors->has('infraction'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('infraction') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>












                            <div class="card-body">
                                <div class="row">
                                    <label class="col-md-3 col-form-label">{{ __('Motif ') }}<span class="ob">*</span></label>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <input type="text" name="motive" class="form-control"
                                                placeholder="Motif " value="{{ $amande->motive }}" required>
                                        </div>
                                        @if ($errors->has('motive'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('motive') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>





                            <div class="card-body">
                                <div class="row">
                                    <label class="col-md-3 col-form-label">{{ __('Sanction ') }}<span class="ob">*</span></label>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <input type="text" name="sanction" class="form-control"
                                                placeholder="Sanction" value="{{ $amande->sanction }}" required>
                                        </div>
                                        @if ($errors->has('sanction'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('sanction') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>





                            <div class="card-body">
                                <div class="row">
                                    <label class="col-md-3 col-form-label">{{ __('Période de la sanction ') }}<span class="ob">*</span></label>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <input type="text" name="period" class="form-control"
                                                placeholder="Période de la sanction (Juurs)" value="{{ $amande->period }}"
                                                required>
                                        </div>
                                        @if ($errors->has('period'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('period') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>







                            <div class="card-footer ">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn  btn-round"
                                            style="background:#EE643A;color:#ffffff;">{{ __('Ajouter') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <script>
            $("#destination_type").change(function() {
                if ($(this).val() == "Destination (A->B)") {
                    $('#AB_Div').show();
                    $('#AB').attr('required', '');
                    $('#AB').attr('data-error', 'This field is required.');
                } else {
                    $('#AB_Div').hide();
                    $('#AB').removeAttr('required');
                    $('#AB').removeAttr('data-error');
                }
            });
            $("#destination_type").trigger("change");
        </script>

        <script>
            $("#destination_type").change(function() {
                if ($(this).val() == "Territoire") {
                    $('#Territoire_Div').show();
                    $('#Territoire').attr('required', '');
                    $('#Territoire').attr('data-error', 'This field is required.');
                } else {
                    $('#Territoire_Div').hide();
                    $('#Territoire').removeAttr('required');
                    $('#Territoire').removeAttr('data-error');
                }
            });
            $("#destination_type").trigger("change");
        </script>
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
