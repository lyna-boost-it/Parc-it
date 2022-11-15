@if(Auth::user()->type=='Gestionnaire parc' ||Auth::user()->type=='Utilisateur'   )

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
                                <form action="{{route('ParkManager.repairsM.storeRepairs',$repair->id)}}" method="post">

    @csrf

                    <div class="card">



                        <div class="card-header">
                            <h3 class="title">{{ __('Créer une réparations ') }}</h3>
                        </div>

                    <div class="card-header">
                            <h4 class="title">{{ __(' N° de la Demande de Travaux (DT):') }} {{ $dt->code_dt }}</h4>
                        </div>

                        <div class="card-header">
                            <h5 class="title">{{ __('Matériel motorisé:') }} {{ $material->code }}</h5>
                        </div>

                        <div class="card-body" >
                            <div class="row">
                                <label class="col-md-3 col-form-label">{{ __('Date d’intervention') }}</label>
                                <div class="col-md-9" >
                                    <div class="form-group">
                                        <input type="date"
                                        name="intervention_date"
                                        class="form-control"

                                        placeholder="Date d’intervention"
                                        value="{{ $repair->intervention_date }}" required>
                                    </div>
                                    @if ($errors->has('intervention_date'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('intervention_date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>








                        <div class="card-body" >
                            <div class="row">
                                <label class="col-md-3 col-form-label">{{ __(' Personne(s) intervenante(s)') }}</label>
                                <div class="col-md-9" for="conducteur_field_for_absence">
                                    <div class="form-group">
                                        <select  name="staff[]" class="selectpicker"  placeholder="  Nom et prénom de l\'absent"
                                         class="form-control"
                                            id="staff_id" multiple>
                                            @foreach ($staffs as $staff)

                                            <option value="{{ $staff->id }}"
                                            >
                                             {{ $staff->name }} {{ $staff->last_name }}</option>
                                            @endforeach

                                        </select></div>

                                </div>
                            </div>
                        </div>



                        <div class="card-body" >
                            <div class="row">
                                <label class="col-md-3 col-form-label">{{ __(' Pannes réparées') }}</label>
                                <div class="col-md-9" >
                                    <div class="form-group">
                                        <input type="text"
                                         name="repaired_breakdowns"
                                         class="form-control"
                                         placeholder="Pannes réparées"
                                          value="{{ $repair->repaired_breakdowns}}" required>
                                    </div>
                                    @if ($errors->has('repaired_breakdowns'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('repaired_breakdowns') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>



                        <input type="hidden" id="mm_id" name="mm_id" value="{{ $material->id }}">
                        <input type="hidden" id="dt_code" name="dt_code" value="{{ $dt->id }}">



                        <div class="card-body" >
                            <div class="row">
                                <label class="col-md-3 col-form-label">{{ __('Date  de sortie') }}</label>
                                <div class="col-md-9" >
                                    <div class="form-group">
                                        <input type="date"
                                        name="end_date"
                                        class="form-control"

                                        placeholder="Date de sortie"
                                        value="{{ $repair->end_date }}" required>
                                    </div>
                                    @if ($errors->has('end_date'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('end_date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>



                        <div class="card-body" >
                            <div class="row">
                                <label class="col-md-3 col-form-label">{{ __('Heure de sortie') }}</label>
                                <div class="col-md-9" >
                                    <div class="form-group">
                                        <input type="time"
                                        name="end_time"
                                        class="form-control"

                                        placeholder="Heure de sorti"
                                        value="{{ $repair->end_time }}" required>
                                    </div>
                                    @if ($errors->has('end_time'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('end_time') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>




                        <div class="card-body" >
                            <div class="row">
                                <label class="col-md-3 col-form-label">{{ __(' Observation') }}</label>
                                <div class="col-md-9" >
                                    <div class="form-group">
                                        <input type="text"
                                         name="observation"
                                         class="form-control"
                                         placeholder="Observation"
                                          value="{{ $repair->observation }}" required>
                                    </div>
                                    @if ($errors->has('observation'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('observation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>



                        <div class="card-body">

                            <div class="card">


                                <div class="card-body">
                                    <table class="table" id="Pieces_table">
                                        <thead>
                                            <tr><th>Code</th>
                                                <th>Désignation</th>
                                                <th>Réf</th>
                                                <th>Qte</th>
                                                <th>Prix</th>
                                                <th>N° bon de sortie</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <td>
                                                <input type="text" name="codes[]"
                                                    class="form-control"
                                                  />
                                            </td>
                                            <tr id="product0">
                                                <td>
                                                    <select name="designations[]" class="form-control">
                                                        <option value="">Choisissez une Désignation</option>
                                                    @foreach ($designations as $designation )
                                                    <option value="{{ $designation->id }}">{{ $designation->name }}</option>

                                                    @endforeach

                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" name="references[]"
                                                        class="form-control"
                                                      />
                                                </td>
                                                <td>
                                                    <input type="number" name="quantities[]"
                                                        class="form-control"
                                                      />
                                                </td>
                                                <td>
                                                    <input type="number" name="prices[]"
                                                        class="form-control"
                                                      />
                                                </td>
                                                <td>
                                                    <input type="number" name="receip[]"
                                                        class="form-control"
                                                      />
                                                </td>





                                            </tr>
                                            <tr id="product1"></tr>
                                        </tbody>
                                    </table>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <button id="add_row" class="btn btn-success pull-left">+</button>
                                            <button id='delete_row' class="pull-right btn btn-danger">-</button>
                                        </div>
                                    </div>
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
    @include('layouts.footerForIndexx')

    <script>
        $(document).ready(function() {
            let row_number = {{ count(old('pieces', [''])) }};
            $("#add_row").click(function(e) {
                e.preventDefault();
                let new_row_number = row_number - 1;
                $('#product' + row_number).html($('#product' + new_row_number).html()).find(
                    'td:first-child');
                $('#Pieces_table').append('<tr id="product' + (row_number + 1) + '"></tr>');
                row_number++;
            });

            $("#delete_row").click(function(e) {
                e.preventDefault();
                if (row_number > 1) {
                    $("#product" + (row_number - 1)).html('');
                    row_number--;
                }
            });
        });
    </script>

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
