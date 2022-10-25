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
        <div class="sidebar-menu">
            <ul id="accordion-menu">
                <li>
                    <a href="{{ route('home') }}" class="dropdown-toggle no-arrow" style="font-size: 14px">
                        <span class="micon fa fa-dashboard"></span><span class="mtext">Tableau de bord</span>
                    </a>
                </li>
                @if (Auth::user()->type == 'Gestionnaire parc' ||
                    Auth::user()->type == 'Utilisateur' ||
                    Auth::user()->type == 'Gestionnaire Sup')
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle"style="font-size: 14px">
                            <span class="micon fi-info"></span>INFORMATIONS
                        </a>
                        <ul class="submenu">
                            <div style=" display: inline-block;">
                                <li>


                                    <a style="right: 60px;font-size: 14px" href="{{ route('ParkManager.staffs.index') }}">

                                        Personnel </a>
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

                                        <a style="right: 60px;" href="{{ route('ParkManager.units.index') }}">


                                            Unités </a>
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

                                        <a style="right: 60px;" href="{{ route('ParkManager.vehicules.index') }}">
                                            Véhicules</a>
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

                                        <a style="right: 60px;"
                                            href="{{ route('ParkManager.materialsmanager.index') }}">


                                            Matériel motorisé</a>
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
                            <span class="micon fa fa-mortar-board"></span><span class="mtext"> SUIVI DES
                                DOCS</span>
                        </a>
                        <ul class="submenu">
                            <li>

                                <a style="right: 60px;" href="{{ route('ParkManager.insurances.index') }}">


                                    Assurances</a>
                            </li>

                            <li>

                                <a style="right: 60px;" href="{{ route('ParkManager.stickers.index') }}">


                                    Vignettes</a>
                            </li>
                            <li>

                                <a style="right: 60px;" href="{{ route('ParkManager.technicalcontrols.index') }}">

                                    Contrôles
                                    techniques </a>
                            </li>
                            <li>

                                <a style="right: 60px;" href="{{ route('ParkManager.licences.index') }}">


                                    Permis de circulation</a>
                            </li>
                            <li>

                                <a style="right: 60px;" href="{{ route('ParkManager.guarantis.index') }}">

                                    Service après-vente et Garantis</a>
                            </li>
                            <li>

                                <a style="right: 60px;" href="{{ route('ParkManager.accidents.index') }}">


                                    Déclarations des
                                    accidents</a>
                            </li>
                        </ul>
                    </li>
                @endif

                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle" style="font-size: 14px">
                        <span class="micon fa fa-toolbox"></span><span class="mtext">
                            MAINTENANCES</span>
                    </a>
                    <ul class="submenu">
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle"style="font-size: 14px">
                                VEHICULES
                            </a>
                            <ul class="submenu">
                                <div style=" display: inline-block;">
                                    <li>

                                        <a style="right: 60px;" style="right: 60px;"
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

                                        <a style="right: 60px;" href="{{ route('ParkManager.repairs.index') }}">


                                            Réparations</a>
                                    </li>
                                    <li>

                                        <a style="right: 60px;"
                                            href="{{ route('ParkManager.maintenances.indexMaintenance') }}">


                                           Entretiens</a>

                                    </li>
                                    <li>

                                        <a style="right: 60px;" href="{{ route('ParkManager.externals.index') }}">


                                            Maintenance externe</a>
                                    </li>
                                @endif

                            </ul>
                        </li>


                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle"style="font-size: 14px">
                                MATERIELS MOTORISÉS
                            </a>
                            <ul class="submenu">
                                <div style="right: 60px;" style=" display: inline-block;">
                                    <li>

                                        <a style="right: 60px;" href="{{ route('ParkManager.dtsM.index') }}">


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

                                        <a style="right: 60px;" href="{{ route('ParkManager.repairsM.index') }}">


                                            Réparations</a>
                                    </li>
                                    <li>

                                        <a style="right: 60px;" href="{{ route('ParkManager.externalsM.index') }}">

                                            Maintenance externe</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                        @if (Auth::user()->type == 'Gestionnaire parc' ||
                            Auth::user()->type == 'Utilisateur' ||
                            Auth::user()->type == 'Gestionnaire Sup')
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle" style="font-size: 14px">
                                    PIECÈS DE RECHANGE
                                </a>
                                <ul class="submenu">
                                    <div style=" display: inline-block;">
                                        <li>

                                            <a style="right: 60px;" style="right: 60px;"
                                                href="{{ route('ParkManager.piecesMaterial.index') }}">


                                               Pièces
                                                consommées Machine</a>
                                        </li>
                                    </div>
                                    <div style=" display: inline-block;">
                                        <button
                                            style=" position: absolute;
                                right: 20px; top:14px; background-color: transparent;
                                border-color: transparent; "
                                            onclick="location.href=' {{ route('ParkManager.piecesMaterial.create') }}'"><i
                                                style="color:  white; " class="fa fa-plus" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <div style=" display: inline-block;">
                                        <li>

                                            <a style="right: 60px;" style="right: 60px;"
                                                href="{{ route('ParkManager.cps.index') }}">


                                                Pièces consommées Vehicule</a>
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

                                        <a style="right: 60px;" href="{{ route('ParkManager.liquids.index') }}">


                                            Liquide et Lubrifiant</a>
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
                            CONSOMMATIONS<br> DE
                            CARBURANT</span>
                    </a>
                    <ul class="submenu">
                        <div style=" display: inline-block;">
                            <li>

                                <a style="right: 60px;" href="{{ route('ParkManager.gasVehicules.index') }}">

                                    Carb. Véhicule </a>
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

                                <a style="right: 60px;" href="{{ route('ParkManager.gasPipes.index') }}">

                                        Carb. Unité </a>
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
                        <span class="micon fa fa-clipboard-user"></span><span class="mtext">POINTAGES<br> ET
                            ABSENCES</span>
                    </a>
                    <ul class="submenu">

                        <li>

                                <a style="right: 60px;" href="{{ route('ParkManager.attendances.index') }}">

                            Pointage </a>
                        </li>
                        <li>

                                <a style="right: 60px;" href="{{ route('ParkManager.absences.index') }}">

                            Absences</a>
                        </li>

                    </ul>
                </li>
@endif
                @if (Auth::user()->type == 'Gestionnaire parc' ||
                Auth::user()->type == 'Utilisateur' ||
                Auth::user()->type == 'Gestionnaire Sup')
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle"style="font-size: 14px">
                        <span class="micon fa fa-car"></span><span class="mtext">MISSIONS <br>ET DEPLACEMENTS </span>
                    </a>
                    <ul class="submenu">
                        <div style=" display: inline-block;">
                            <li>

                                    <a style="right: 60px;" href="{{ route('ParkManager.missions.index') }}">

                                Déplacements</a>
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
                <li>
                    <div class="dropdown-divider"></div>
                </li>
                @if (Auth::user()->type == 'Gestionnaire parc' ||
                Auth::user()->type == 'Utilisateur' ||
                Auth::user()->type == 'Gestionnaire Sup')
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle" style="font-size: 14px">
                        <span class="micon fa fa-bar-chart"></span><span class="mtext">Statistiques</span>
                    </a>
                    <ul class="submenu">
                        <li>

                                <a style="right: 60px;" href="{{ route('Kpis.gas.index') }}">

                            Carburant</a>
                        </li>

                        <li>

                                <a style="right: 60px;" href="{{ route('Kpis.liquids.index') }}">


                            Liquide et Lubrifiant </a>
                        </li>
                        <li>

                                <a style="right: 60px;" href="{{ route('Kpis.pieces.index') }}">


                            Pieces </a>
                        </li>
                        <li>

                                <a style="right: 60px;" href="{{ route('Kpis.vehicules.index') }}">


                            Véhicules</a>
                        </li>
                        <li>

                                <a style="right: 60px;" href="{{ route('Kpis.materials.index') }}">


                            MATÉRIELS MOTORISÉS</a>
                        </li>
                        <li>

                                <a style="right: 60px;" href="{{ route('Kpis.pannes.index') }}">


                            Maintenances</a>
                        </li>

                        <li>

                                <a style="right: 60px;" href="{{ route('Kpis.staff.index') }}">


                            Personnels</a>
                        </li>


                    </ul>
                </li>

@endif
@if (Auth::user()->type == 'Gestionnaire parc' || Auth::user()->type == 'Utilisateur')
                <li>

                        <a href="{{ URL('/history') }}" class="dropdown-toggle no-arrow"  style="font-size: 14px">




                    <span class="micon fa fa-history"></span><span class="mtext">Historique</span>
                    </a>
                </li>
@endif
@if (Auth::user()->type == 'Gestionnaire parc' ||
Auth::user()->type == 'Utilisateur' ||
Auth::user()->type == 'Gestionnaire Sup')
                <li>

                        <a href="{{ route('ParkManager.users.index') }}" class="dropdown-toggle no-arrow "style="font-size: 14px">




                    <span class="micon fa fa-user"></span><span class="mtext">Gestion Utilisateurs</span>
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
