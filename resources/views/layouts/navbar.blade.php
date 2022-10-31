<div class="left-side-bar" style="font-size: 14px" >
    <div class="brand-logo">
        <a href="{{ route('home') }}" style="background: white">
            <img src="{{ URL('assets/vendors/images/parc_logo_white.png') }}" alt="" class="dark-logo" />

        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div style="margin-top:22px;" class="sidebar-menu">
            <ul id="accordion-menu">
                <li>
                    <a href="{{ route('home') }}" class="dropdown-toggle no-arrow" style="font-size: 14px">
                        <span class="micon fa fa-dashboard"></span><span class="mtext"><b>Tableau de bord</b></span>
                    </a>
                </li>
                @if (Auth::user()->type == 'Gestionnaire parc' ||
                    Auth::user()->type == 'Utilisateur' ||
                    Auth::user()->type == 'Gestionnaire Sup')
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle" style="font-size: 14px">
                            <span class="micon fi-info"></span><b>Gest. des Informations</b>
                        </a>
                        <ul class="submenu" style="backgound:#1f3141; !important">
                            <div style=" display: inline-block;" >
                                <li>


                                    <a style="right: 50px;font-size: 14px" href="{{ route('ParkManager.staffs.index') }}">

                                     Gest. du Personnel </a>
                                </li>
                            </div>


                            <div style=" display: inline-block;">

                                <button
                                    style=" position: absolute;
                            right: 20px; top: 14px; background-color: transparent;
                            border-color: transparent; "
                                    onclick="location.href=' {{ route('ParkManager.staffs.create') }}'"><i
                                        style="color:  white; " class="fa fa-plus" aria-hidden="true"></i>
                                </button>

                            </div>


                            <div style=" display: inline-block;">
                                <div style=" display: inline-block;">
                                    <li>

                                        <a style="right: 50px;" href="{{ route('ParkManager.units.index') }}">


                                            Gest. des Unités </a>
                                    </li>
                                </div>
                                <div style=" display: inline-block;">

                                    <button
                                        style=" position: absolute;
                                right: 20px; top:65px; background-color: transparent;
                                border-color: transparent; "
                                        onclick="location.href=' {{ route('ParkManager.units.create') }}'"><i
                                            style="color:  white; " class="fa fa-plus" aria-hidden="true"></i>
                                    </button>

                                </div>

                                <div style=" display: inline-block;">
                                    <li>

                                        <a style="right: 50px;" href="{{ route('ParkManager.vehicules.index') }}">
                                           Gest. des Véhicules</a>
                                    </li>
                                </div>
                                <div style=" display: inline-block;">

                                    <button
                                        style=" position: absolute;
                            right: 20px; top:116px; background-color: transparent;
                            border-color: transparent; "
                                        onclick="location.href=' {{ route('ParkManager.vehicules.create') }}'"><i
                                            style="color:  white; " class="fa fa-plus" aria-hidden="true"></i>
                                    </button>

                                </div>
                                <div style=" display: inline-block;">
                                    <li>

                                        <a style="right: 50px;"
                                            href="{{ route('ParkManager.materialsmanager.index') }}">


                                           Gest. Matériels motorisés</a>
                                    </li>
                                </div>
                                <div style=" display: inline-block;">
                                    <button
                                        style=" position: absolute;
                        right: 20px; top:167px; background-color: transparent;
                        border-color: transparent; "
                                        onclick="location.href=' {{ route('ParkManager.materialsmanager.create') }}'"><i
                                            style="color:  white; " class="fa fa-plus" aria-hidden="true"></i>
                                    </button>
                                </div>
                        </ul>
                    </li>
                @endif
                @if (Auth::user()->type == 'Gestionnaire parc' ||
                    Auth::user()->type == 'Utilisateur' ||
                    Auth::user()->type == 'Gestionnaire Sup')
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle" style="font-size: 14px">
                            <span class="micon fa fa-file"></span><span class="mtext"> <b>Suivi des Documents</b></span>
                        </a>
                        <ul class="submenu">
                            <li>

                                <a style="right: 50px;" href="{{ route('ParkManager.insurances.index') }}">


                                    Suivi des Assurances</a>
                            </li>

                            <li>

                                <a style="right: 50px;" href="{{ route('ParkManager.stickers.index') }}">


                                   Suivi des Vignettes</a>
                            </li>
                            <li>

                                <a style="right: 50px;" href="{{ route('ParkManager.technicalcontrols.index') }}">

                                   Contrôles
                                    techniques </a>
                            </li>
                            <li>

                                <a style="right: 50px;" href="{{ route('ParkManager.licences.index') }}">


                                    Permis de circulation</a>
                            </li>
                            <li>

                                <a style="right: 50px;" href="{{ route('ParkManager.guarantis.index') }}">

                                    Garantis et SAV</a>
                            </li>
                            <li>

                                <a style="right: 50px;" href="{{ route('ParkManager.accidents.index') }}">


                                    Déclarations des
                                    Accidents</a>
                            </li>
                        </ul>
                    </li>
                @endif

                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle" style="font-size: 14px">
                        <span class="micon fa fa-toolbox"></span><span class="mtext">
                           <b> Centre de Maintenance</b></span>
                    </a>
                    <ul class="submenu">
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle"style="font-size: 14px">
                                <b>Maintenance des Vehicules</b>
                            </a>
                            <ul class="submenu">
                                <div style=" display: inline-block;">
                                    <li>

                                        <a style="right: 50px;" style="right: 60px;"
                                            href="{{ route('ParkManager.dts.index') }}">


                                            Demandes de travaux (DT)</a>
                                    </li>
                                </div>
                                <div style=" display: inline-block;">
                                    <button
                                        style=" position: absolute;
                                right: 20px; top:14px; background-color: transparent;
                                border-color: transparent; "
                                        onclick="location.href=' {{ route('ParkManager.dts.create') }}'"><i
                                            style="color:  white; " class="fa fa-plus" aria-hidden="true"></i>
                                    </button>
                                </div>
                                @if (Auth::user()->type == 'Gestionnaire parc' ||
                                    Auth::user()->type == 'Utilisateur' ||
                                    Auth::user()->type == 'Gestionnaire Sup')

                                    <li>

                                        <a style="right: 50px;" href="{{ route('ParkManager.repairs.index') }}">


                                            Gérer les Réparations</a>
                                    </li>
                                    <li>

                                        <a style="right: 50px;"
                                            href="{{ route('ParkManager.maintenances.indexMaintenance') }}">


                                          Gérer les Entretiens</a>

                                    </li>
                                    <li>

                                        <a style="right: 50px;" href="{{ route('ParkManager.externals.index') }}">


                                            Maintenance externe</a>
                                    </li>
                                @endif

                            </ul>
                        </li>


                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle"style="font-size: 14px">
                               <b> Maint. Matériels Motorisés </b>
                            </a>
                            <ul class="submenu">
                                <div style="right: 50px;" style=" display: inline-block;">
                                    <li>

                                        <a style="right: 50px;" href="{{ route('ParkManager.dtsM.index') }}">


                                            Demandes de travaux
                                            (DT)</a>
                                    </li>
                                </div>
                                <div style=" display: inline-block;">
                                    <button
                                        style=" position: absolute;
                                right: 20px; top:14px; background-color: transparent;
                                border-color: transparent; "
                                        onclick="location.href=' {{ route('ParkManager.dtsM.create') }}'"><i
                                            style="color:  white; " class="fa fa-plus" aria-hidden="true"></i>
                                    </button>
                                </div>
                                @if (Auth::user()->type == 'Gestionnaire parc' ||
                                    Auth::user()->type == 'Utilisateur' ||
                                    Auth::user()->type == 'Gestionnaire Sup')
                                    <li>

                                        <a style="right: 50px;" href="{{ route('ParkManager.repairsM.index') }}">


                                            Gérer les Réparations</a>
                                    </li>
                                    <li>

                                        <a style="right: 50px;" href="{{ route('ParkManager.externalsM.index') }}">

                                            Maintenances externes</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                        @if (Auth::user()->type == 'Gestionnaire parc' ||
                            Auth::user()->type == 'Utilisateur' ||
                            Auth::user()->type == 'Gestionnaire Sup')
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle" style="font-size: 14px">
									<b> Gest. Pièces de Rechange</b>
                                </a>
                                <ul class="submenu">

                                    <div style=" display: inline-block;">
                                        <li>

                                            <a style="right: 50px;" style="right: 60px;"
                                                href="{{ route('ParkManager.cps.index') }}">


                                                Pieces Consommés </a>
                                        </li>
                                    </div>
                                    <div style=" display: inline-block;">
                                        <button
                                            style=" position: absolute;
                                right: 20px; top:116px; background-color: transparent;
                                border-color: transparent; "
                                            onclick="location.href=' {{ route('ParkManager.cps.create') }}'"><i
                                                style="color:  white; " class="fa fa-plus" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <li>

                                        <a style="right: 50px;" href="{{ route('ParkManager.liquids.index') }}">


                                            Liquides et Lubrifiants</a>
                                    </li>

                                </ul>
                            </li>
                        @endif



                    </ul>
                </li>
                @if (Auth::user()->type == 'Gestionnaire parc' ||
                Auth::user()->type == 'Utilisateur' ||
                Auth::user()->type == 'Gestionnaire Sup')
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle"style="font-size: 14px">
                        <span class="micon fa fa-gas-pump"></span><span class="mtext">
                          <b>  Conso. Carburant</b></span>
                    </a>
                    <ul class="submenu">
                        <div style=" display: inline-block;">
                            <li>

                                <a style="right: 50px;" href="{{ route('ParkManager.gasVehicules.index') }}">

                                     Gest. de Carb. Véhicule </a>
                            </li>
                        </div>
                        <div style=" display: inline-block;">
                            <button
                                style=" position: absolute;
                                right: 20px; top:14px; background-color: transparent;
                                border-color: transparent; "
                                onclick="location.href=' {{ route('ParkManager.gasVehicules.create') }}'"><i
                                    style="color:  white; " class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                        </div>
                        <div style=" display: inline-block;">
                            <li>

                                <a style="right: 50px;" href="{{ route('ParkManager.gasPipes.index') }}">

                                        Gest. de Carb. Unité </a>
                            </li>
                        </div>
                        <div style=" display: inline-block;">
                            <button
                                style=" position: absolute;
                                right: 20px; top:65px; background-color: transparent;
                                border-color: transparent; "
                                onclick="location.href=' {{ route('ParkManager.gasPipes.create') }}'"><i
                                    style="color:  white; " class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                        </div>
                    </ul>
                </li>
@endif
@if (Auth::user()->type == 'Gestionnaire parc' ||
Auth::user()->type == 'Utilisateur' ||
Auth::user()->type == 'Gestionnaire Sup')
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle"style="font-size: 14px">
                        <span class="micon fa fa-clipboard-user"></span><span class="mtext"><b>Pointage & Absences</b></span>
                    </a>
                    <ul class="submenu">

                        <li>

                                <a style="right: 50px;" href="{{ route('ParkManager.attendances.index') }}">

                            Gest. des Pointages </a>
                        </li>
                        <li>

                                <a style="right: 50px;" href="{{ route('ParkManager.absences.index') }}">

                            Gest. des Absences</a>
                        </li>

                    </ul>
                </li>
@endif
                @if (Auth::user()->type == 'Gestionnaire parc' ||
                Auth::user()->type == 'Utilisateur' ||
                Auth::user()->type == 'Gestionnaire Sup')
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle"style="font-size: 14px">
                        <span class="micon fa fa-car"></span><span class="mtext"><b>Gest. des Déplacements</b> </span>
                    </a>
                    <ul class="submenu">
                        <div style=" display: inline-block;">
                            <li>

                                    <a style="right: 50px;" href="{{ route('ParkManager.missions.index') }}">

                             Gérer les Déplacements</a>
                            </li>
                        </div>
                        <div style=" display: inline-block;">
                            <button
                                style=" position: absolute;
                        right: 20px; top:14px; background-color: transparent;
                        border-color: transparent; "
                                onclick="location.href=' {{ route('ParkManager.missions.create') }}'"><i
                                    style="color:  white; " class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                        </div>
                    </ul>
                </li>
                @endif
                <li>
                    <div class="dropdown-divider"></div>
                </li>
                <li>
                    <div class="sidebar-small-cap" style="color: grey"><b>Autre</b></div>
                </li>

                @if (Auth::user()->type == 'Gestionnaire parc' ||
                Auth::user()->type == 'Utilisateur' ||
                Auth::user()->type == 'Gestionnaire Sup')
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle" style="font-size: 14px">
                        <span class="micon fa fa-bar-chart"></span><span class="mtext"><b>Statistiques/ KPI's</b></span>
                    </a>
                    <ul class="submenu">
                        <li>

                                <a style="right: 50px;" href="{{ route('Kpis.gas.index') }}">

                          <b>  KPI's Carburant</b></b></a>
                        </li>

                        <li>

                                <a style="right: 50px;" href="{{ route('Kpis.liquids.index') }}">


                            <b> KPI's Liquide & Lubrifiant</b> </a>
                        </li>
                        <li>

                                <a style="right: 50px;" href="{{ route('Kpis.pieces.index') }}">


                            <b> KPI's Pieces</b> </a>
                        </li>
                        <li>

                                <a style="right: 50px;" href="{{ route('Kpis.vehicules.index') }}">


                           <b>  KPI's Véhicules</b></a>
                        </li>
                        <li>

                                <a style="right: 50px;" href="{{ route('Kpis.materials.index') }}">


                            <b> KPI's Matériels Motorisés</b></a>
                        </li>
                        <li>

                                <a style="right: 50px;" href="{{ route('Kpis.pannes.index') }}">


                           <b>  KPI's Maintenances</b></a>
                        </li>

                        <li>

                                <a style="right: 50px;" href="{{ route('Kpis.staff.index') }}">


                           <b>  KPI's Personnels </b></a>
                        </li>


                    </ul>
                </li>

@endif
@if (Auth::user()->type == 'Gestionnaire parc' || Auth::user()->type == 'Utilisateur')
                <li>

                        <a href="{{ URL('/history') }}" class="dropdown-toggle no-arrow"  style="font-size: 14px">




							<span class="micon fa fa-history"></span><span class="mtext"><b>Historique</b></span>
                    </a>
                </li>
@endif
@if (Auth::user()->type == 'Gestionnaire parc' ||
Auth::user()->type == 'Utilisateur' ||
Auth::user()->type == 'Gestionnaire Sup')
                <li>

                        <a href="{{ route('ParkManager.users.index') }}" class="dropdown-toggle no-arrow "style="font-size: 14px">




                    <span class="micon fa fa-user"></span><span class="mtext"><b> Utilisateurs</b></span>
                    </a>
                </li>

@endif



            </ul>
        </div>
    </div>
</div>



<style>
    .isDisabled {
        color: currentColor;
        cursor: not-allowed;
        opacity: 0.5;
        text-decoration: none;
    }
</style>



<script>
    (function(w, d, s, l, i) {
        w[l] = w[l] || [];
        w[l].push({
            "gtm.start": new Date().getTime(),
            event: "gtm.js"
        });
        var f = d.getElementsByTagName(s)[0],
            j = d.createElement(s),
            dl = l != "dataLayer" ? "&l=" + l : "";
        j.async = true;
        j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
        f.parentNode.insertBefore(j, f);
    })(window, document, "script", "dataLayer", "GTM-NXZMQSS");
</script>
