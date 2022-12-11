<div class="left-side-bar" style="font-size: 14px">
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
                    <a href="{{ route('home') }}"
                        class="dropdown-toggle no-arrow {{ Request::is('home') ? 'active' : '' }}"
                        style="font-size: 14px">
                        <span class="micon fa fa-dashboard"></span><span class="mtext"><b>Tableau de bord</b></span>
                    </a>
                </li>
                @if (Auth::user()->type == 'Gestionnaire parc' ||
                    Auth::user()->type == 'Gestionnaire Sup')
                    <li class="dropdown">
                        <a href="javascript:;"
                            class="dropdown-toggle {{ Request::is('ParkManager/staffs') ? 'collapse active' : 'collapsed' }}"
                            style="font-size: 14px">
                            <span class="micon fi-info"></span><b>Gest. des Informations</b>
                        </a>
                        <ul class="submenu">

                            <li>


                                <a class="  {{ Request::is('*ParkManager/staffs*') ? 'active' : '' }}"
                                    style="right: 50px;font-size: 14px" href="{{ route('ParkManager.staffs.index') }}">

                                    Gest. du Personnel </a>
                            </li>







                            <li>

                                <a class="  {{ Request::is('*ParkManager/units*') ? 'active' : '' }}" style="right: 50px;"
                                    href="{{ route('ParkManager.units.index') }}">


                                    Gest. des Unités </a>
                            </li>



                            <li>

                                <a class="  {{ Request::is('*ParkManager/vehicules*') ? 'active' : '' }}"
                                    style="right: 50px;" href="{{ route('ParkManager.vehicules.index') }}">
                                    Gest. des Véhicules</a>
                            </li>





                            <li>

                                <a class="  {{ Request::is('*ParkManager/materialsmanager*') ? 'active' : '' }}"
                                    style="right: 50px;" href="{{ route('ParkManager.materialsmanager.index') }}">


                                    Gest. Matériels motorisés</a>
                            </li>

                        </ul>
                    </li>
                @endif
                @if (Auth::user()->type == 'Gestionnaire parc' ||
                    Auth::user()->type == 'Gestionnaire Sup')
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle" style="font-size: 14px">
                            <span class="micon fa fa-file"></span><span class="mtext"> <b>Suivi des
                                    Documents</b></span>
                        </a>
                        <ul class="submenu">
                            <li>

                                <a class="  {{ Request::is('*ParkManager/insurances*') ? 'active' : '' }}"
                                    style="right: 50px;" href="{{ route('ParkManager.insurances.index') }}">


                                    Suivi des Assurances</a>
                            </li>

                            <li>
                                <a class="  {{ Request::is('*ParkManager/stickers*') ? 'active' : '' }}"
                                    style="right: 50px;" href="{{ route('ParkManager.stickers.index') }}">


                                    Suivi des Vignettes</a>
                            </li>
                            <li>
                                <a class="  {{ Request::is('*ParkManager/technicalcontrols*') ? 'active' : '' }}"
                                    style="right: 50px;" href="{{ route('ParkManager.technicalcontrols.index') }}">

                                    Contrôles
                                    techniques </a>
                            </li>
                            <li>

                                <a class="  {{ Request::is('*ParkManager/licences*') ? 'active' : '' }}"
                                    style="right: 50px;" href="{{ route('ParkManager.licences.index') }}">


                                    Permis de circulation</a>
                            </li>
                            <li>

                                <a class="  {{ Request::is('*ParkManager/guarantis*') ? 'active' : '' }}"
                                    style="right: 50px;" href="{{ route('ParkManager.guarantis.index') }}">

                                    Garantis et SAV</a>
                            </li>
                            <li>
                                <a class="  {{ Request::is('*ParkManager/accidents*') ? 'active' : '' }}"
                                    style="right: 50px;" href="{{ route('ParkManager.accidents.index') }}">


                                    Déclarations des
                                    Accidents</a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if (
                Auth::user()->type != 'Utilisateur'  )
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle" style="font-size: 14px">
                        <span class="micon fa fa-toolbox"></span><span class="mtext">
                            <b> Centre de Maintenance</b></span>
                    </a>
                    <ul class="submenu">
                        <li class="dropdown">
                        <li>

                            <a class="  {{ Request::is('*ParkManager/dts*') ? 'active' : '' }}" style="right: 50px;"
                                style="right: 60px;" href="{{ route('ParkManager.dts.index') }}">


                                Demandes de réparation (DR)</a>
                        </li>
                        @if (Auth::user()->type == 'Gestionnaire parc' ||
                            Auth::user()->type == 'Gestionnaire Sup')
                            <li>
                                <a class="  {{ Request::is('*ParkManager/repairs*') ? 'active' : '' }}"
                                    style="right: 50px;" href="{{ route('ParkManager.repairs.index') }}">


                                    Liste des Réparations</a>
                            </li>
                            <li>
                                <a class="  {{ Request::is('ParkManager/maintenances') ? 'active' : '' }}"
                                    style="right: 50px;"
                                    href="{{ route('ParkManager.maintenances.indexMaintenance') }}">


                                    Liste des Entretiens</a>

                            </li>
                            <li>
                                <a class="  {{ Request::is('*ParkManager/externals*') ? 'active' : '' }}"
                                    style="right: 50px;" href="{{ route('ParkManager.externals.index') }}">


                                    Liste des Maintenance externe</a>
                            </li>
                            @endif
                            <li>
                                <a class="  {{ Request::is('*ParkManager/archives*') ? 'active' : '' }}"
                                    style="right: 50px;" href="{{ route('ParkManager.archives.index') }}">


                                    Liste des DT archivées</a>
                            </li>






                    </ul>
                </li>
                @endif


                @if (Auth::user()->type == 'Gestionnaire parc' ||
                    Auth::user()->type == 'Gestionnaire Sup')
                    <li class="dropdown">

                        <a href="javascript:;" class="dropdown-toggle" style="font-size: 14px">
                            <span class="micon fa fa-puzzle-piece"></span><span class="mtext">
                                <b> Param. Pièces de Rechange</b></span>
                     </a>
                        <ul class="submenu">


                            <li>
                                <a class="  {{ Request::is('*ParkManager/cps*') ? 'active' : '' }}" style="right: 50px;"
                                    style="right: 60px;" href="{{ route('ParkManager.cps.index') }}">


                                    Pieces Consommées </a>
                            </li>



                        </ul>
                    </li>
                @endif

                @if (Auth::user()->type == 'Gestionnaire parc' ||
                    Auth::user()->type == 'Gestionnaire Sup')
                    <li class="dropdown">

                        <a href="javascript:;" class="dropdown-toggle" style="font-size: 14px">
                            <span class="micon fa fa-edit"></span><span class="mtext">
                                <b> Sanctions et Amendes</b></span>
                     </a>
                        <ul class="submenu">


                            <li>
                                <a class="  {{ Request::is('*ParkManager/amandes*') ? 'active' : '' }}" style="right: 50px;"
                                    style="right: 60px;" href="{{ route('ParkManager.amandes.index') }}">


                                    Gestion des Amendes</a>
                            </li>



                        </ul>
                    </li>
                @endif



            </li>
            @if (Auth::user()->type == 'Gestionnaire parc' ||
                Auth::user()->type == 'Gestionnaire Sup')
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle"style="font-size: 14px">
                        <span class="micon fa fa-gas-pump"></span><span class="mtext">
                            <b> Conso. Carburant</b></span>
                    </a>
                    <ul class="submenu">

                        <li>
                            <a class="  {{ Request::is('*ParkManager/gasVehicules*') ? 'active' : '' }}"
                                style="right: 50px;" href="{{ route('ParkManager.gasVehicules.index') }}">

                                Gest. de Carb. Véhicule </a>
                        </li>


                        <li>
                            <a class="  {{ Request::is('*ParkManager/gasPipes*') ? 'active' : '' }}"
                                style="right: 50px;" href="{{ route('ParkManager.gasPipes.index') }}">

                                Gest. de Carb. Unité </a>
                        </li>



                    </ul>
                </li>
            @endif
            @if (Auth::user()->type == 'Gestionnaire parc' ||
                Auth::user()->type == 'Gestionnaire Sup')
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle"style="font-size: 14px">
                        <span class="micon fa fa-clipboard-user"></span><span class="mtext"><b>Pointage &
                                Absences</b></span>
                    </a>
                    <ul class="submenu">

                        <li>
                            <a class="{{ Request::is('*ParkManager/attendances*') ? 'active' : '' }}"
                                style="right: 50px;" href="{{ route('ParkManager.attendances.index') }}">

                                Gest. des Pointages </a>
                        </li>
                        <li>
                            <a class="  {{ Request::is('*ParkManager/absences*') ? 'active' : '' }}"
                                style="right: 50px;" href="{{ route('ParkManager.absences.index') }}">

                                Gest. des Absences</a>
                        </li>

                    </ul>
                </li>
            @endif
            @if (Auth::user()->type == 'Gestionnaire parc' ||
                Auth::user()->type == 'Gestionnaire Sup')
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle"style="font-size: 14px">
                        <span class="micon fa fa-car"></span><span class="mtext"><b>Gest. des Déplacements</b>
                        </span>
                    </a>
                    <ul class="submenu">

                        <li>
                            <a class="  {{ Request::is('*ParkManager/missions*') ? 'active' : '' }}"
                                style="right: 50px;" href="{{ route('ParkManager.missions.index') }}">

                                Gérer les Déplacements</a>
                        </li>


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
                        <span class="micon fa fa-bar-chart"></span><span class="mtext"><b>Statistiques/
                                KPI's</b></span>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a class="  {{ Request::is('*Kpis/gas*') ? 'active' : '' }}" style="right: 50px;"
                                href="{{ route('Kpis.gas.index') }}">

                                <b> KPI's Carburant</b></b></a>
                        </li>


                        <li>
                            <a class="  {{ Request::is('*Kpis/pieces*') ? 'active' : '' }}" style="right: 50px;"
                                href="{{ route('Kpis.pieces.index') }}">


                                <b> KPI's Pieces</b> </a>
                        </li>
                        <li>
                            <a class="  {{ Request::is('*Kpis/vehicules*') ? 'active' : '' }}" style="right: 50px;"
                                href="{{ route('Kpis.vehicules.index') }}">


                                <b> KPI's Véhicules</b></a>
                        </li>
                        <li>
                            <a class="  {{ Request::is('*Kpis/materials*') ? 'active' : '' }}" style="right: 50px;"
                                href="{{ route('Kpis.materials.index') }}">


                                <b> KPI's Matériels Motorisés</b></a>
                        </li>
                        <li>
                            <a class="  {{ Request::is('*Kpis/pannes*') ? 'active' : '' }}" style="right: 50px;"
                                href="{{ route('Kpis.pannes.index') }}">


                                <b> KPI's Maintenances</b></a>
                        </li>

                        <li>
                            <a class="  {{ Request::is('*Kpis/staff*') ? 'active' : '' }}" style="right: 50px;"
                                href="{{ route('Kpis.staff.index') }}">


                                <b> KPI's Personnels </b></a>
                        </li>

                        <li>
                            <a class="  {{ Request::is('*Kpis/amandes*') ? 'active' : '' }}" style="right: 50px;"
                                href="{{ route('Kpis.amandes.index') }}">


                                <b> KPI's Amendes </b></a>
                        </li>

                    </ul>
                </li>
            @endif
            @if (Auth::user()->type == 'Gestionnaire parc' || Auth::user()->type == 'Utilisateur')
                <li>
                    <a class="dropdown-toggle no-arrow {{ Request::is('history') ? 'active' : '' }}"
                        href="{{ URL('/history') }}" style="font-size: 14px">




                        <span class="micon fa fa-history"></span><span class="mtext"><b>Historique</b></span>
                    </a>
                </li>
            @endif
            @if (Auth::user()->type == 'Gestionnaire parc' ||
                Auth::user()->type == 'Utilisateur' ||
                Auth::user()->type == 'Gestionnaire Sup')
                <li>
                    <a class="{{ Request::is('*ParkManager/users*') ? 'active' : '' }}  dropdown-toggle no-arrow"
                        href="{{ route('ParkManager.users.index') }}" style="font-size: 14px">




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
