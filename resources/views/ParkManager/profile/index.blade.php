

    <!DOCTYPE html>
    <html>
    @include('layouts.headForindexx')
    <script>
        function verifyPassword() {
          var pw = document.getElementById("password").value;
          var pw1 = document.getElementById("remember_token").value;
          //check empty password field
          if(pw == "") {
             document.getElementById("message").innerHTML = "*Remplissez le mot de passe s'il vous plaît!";
             return false;
          }
          if(pw !=pw1) {
             document.getElementById("message").innerHTML = "*Les mot de passe ne correspond pas!";
             return false;
          }else {
             alert("Le mot de passe est correct");
          }




        }
        function myFunction() {
            var x = document.getElementById("password");
            var y = document.getElementById("remember_token");
            if (x.type === "password") {
            x.type = "text";
            y.type = "text";
            } else {
            x.type = "password";
            y.type = "password";
             }
}
        </script>
    <body>
        @include('layouts.header-bar')
        @include('layouts.navbar')

            <div class="mobile-menu-overlay"></div>

                <div class="main-container">
                    <div id="makepdf">
                        <div class="xs-pd-20-10 pd-ltr-20">
                            <div class="page-header" style="background-color:#ffffff">
                                <div class="profile-photo">
                                    <img class="avatar border-gray" src="{{ URL('assets/vendors/images/maintenance.png') }}"alt="...">
                                </div>
                                <h5 class="text-center h5 mb-0">{{ $user->username }} </h5>
                                <p class="text-center text-muted font-14">{{ $user->type }}</p>
                                <div class="page-header">
                                    <div class="row">
                                        <div class="title">
											@if($user->unit_id!=0)
                                            <h4>Affectation:{{ $unit->name }} </h4>
											@else
											<h4>Affectation:Administration </h4>
											@endif
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <div class="col-md-12 text-center">
                                            <form action="{{ route('ParkManager.profile.update',$user->id) }}" method="post" onsubmit ="return verifyPassword()">


                                                @csrf      {{method_field('PUT')}}
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="title">{{ __('Changer le mot de passe') }}</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <label class="col-md-3 col-form-label">{{ __('Mot de passe') }}<span
                                                                    class="ob">*</span></label>
                                                            <div class="col-md-9">
                                                                <div class="form-group">
                                                                    <input type="password" id="password"  name="password" class="form-control" placeholder="Mot de passe"
                                                                        value="" required> <span id = "message" style="color:red"> </span>
                                                                </div>
                                                                @if ($errors->has('password'))
                                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                                        <strong>{{ $errors->first('password') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="card-body">
                                                        <div class="row">
                                                            <label class="col-md-3 col-form-label">{{ __('Retaper le mot de passe ') }}<span
                                                                    class="ob">*</span></label>
                                                            <div class="col-md-9">
                                                                <div class="form-group">
                                                                    <input type="password" id="remember_token" name="remember_token" class="form-control"
                                                                        placeholder="Retaper le mot de passe " value=""
                                                                        required> <span id = "message" style="color:red"> </span>
                                                                </div>
                                                                @if ($errors->has('remember_token'))
                                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                                        <strong>{{ $errors->first('remember_token') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <input type="checkbox" onclick="myFunction()">Afficher le mot de passe


                                                    <div class="card-footer ">
                                                        <div class="row">
                                                            <div class="col-md-12 text-center">
                                                                <button type="submit" value = "Submit"
                                                                    class="btn   btn-round"style="background:#EE643A;color:#ffffff;">{{ __('Mise à jour') }}</button>
                                                                    <button type = "reset" class="btn   btn-round"style="background:#EE643A;color:#ffffff;" value = "Reset" >Réinitialiser</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>



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



                    <br> <button id="button" class="btn btn-warning btn-round"><span class="fa fa-print  "
                            style="color: #000000"> </span> Imprimer</button>
                            <br> <br> <br>
                    @include('layouts.footerForIndexx')

    </body>

    </html>
