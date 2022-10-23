<div class="left-side-bar">
    <div class="brand-logo">
        <a href="{{ route('home') }}">
            <img src="{{ URL('assets/vendors/images/parc_logo_white.jpeg') }}" alt="" class="dark-logo" />
            <img src="{{ URL('assets/vendors/images/parc_logo_black.jpeg') }}"; alt="" class="light-logo" />
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">
                <li>
                    <a href="{{ route('home') }}" class="dropdown-toggle no-arrow">
                        <span class="micon fa fa-dashboard"></span><span class="mtext">Tableau de bord</span>
                    </a>
                </li>

                <li class="dropdown" >
                    <a href="javascript:;" class="dropdown-toggle" >
                        <span class="micon fi-info"></span>  GESTION DES
                            <br>INFORMATIONS DU PARC
                    </a>
                    <ul  class="submenu" >
                        <div style=" display: inline-block;">
                        <li  >
                            @if (Auth::user()->type == 'Gestionnaire parc' ||
                                Auth::user()->type == 'Utilisateur' ||
                                Auth::user()->type == 'Gestionnaire Sup')

                                <a style="right: 60px;" href="{{ route('ParkManager.staffs.index') }}">
                                @else
                                    <a href="#" class="isDisabled"   >
                            @endif
                            Gestion du personnel  </a></li></div>


                            <div style=" display: inline-block;">

                            <button style=" position: absolute;
                            right: 20px; top: 14px; background-color: transparent;
                            border-color: transparent; "
                            onclick="location.href=' {{ route('ParkManager.staffs.create') }}'"><i style="color: orangered; " class="fa fa-plus" aria-hidden="true"></i>
                        </button>

                            </div>


                            <div style=" display: inline-block;">
                            <div style=" display: inline-block;">
                        <li>
                            @if (Auth::user()->type == 'Gestionnaire parc' ||
                                Auth::user()->type == 'Utilisateur' ||
                                Auth::user()->type == 'Gestionnaire Sup')
                                <a style="right: 60px;"  href="{{ route('ParkManager.units.index') }}">
                                @else
                                    <a href="#" class="isDisabled">
                            @endif

                            Gestion des unités </a>
                        </li>
                            </div>
                            <div style=" display: inline-block;">

                                <button style=" position: absolute;
                                right: 20px; top:65px; background-color: transparent;
                                border-color: transparent; "
                                onclick="location.href=' {{ route('ParkManager.units.create') }}'"><i style="color: orangered; " class="fa fa-plus" aria-hidden="true"></i>
                            </button>

                                </div>

                                <div style=" display: inline-block;">
                        <li>
                            @if (Auth::user()->type == 'Gestionnaire parc' ||
                                Auth::user()->type == 'Utilisateur' ||
                                Auth::user()->type == 'Gestionnaire Sup')
                                <a style="right: 60px;" href="{{ route('ParkManager.vehicules.index') }}">
                                @else
                                    <a  href="#" class="isDisabled">
                            @endif Gestion des véhicules</a>
                        </li></div>
                        <div style=" display: inline-block;">

                            <button style=" position: absolute;
                            right: 20px; top:116px; background-color: transparent;
                            border-color: transparent; "
                            onclick="location.href=' {{ route('ParkManager.vehicules.create') }}'"><i style="color: orangered; " class="fa fa-plus" aria-hidden="true"></i>
                        </button>

                            </div>
                            <div style=" display: inline-block;">
                        <li>
                            @if (Auth::user()->type == 'Gestionnaire parc' ||
                                Auth::user()->type == 'Utilisateur' ||
                                Auth::user()->type == 'Gestionnaire Sup')
                                <a style="right: 60px;" href="{{ route('ParkManager.materialsmanager.index') }}">
                                @else
                                    <a href="#" class="isDisabled">
                            @endif

                            Gestion des
                            matériel motorisé</a>
                        </li>
                    </div>
                    <div style=" display: inline-block;">
                        <button style=" position: absolute;
                        right: 20px; top:167px; background-color: transparent;
                        border-color: transparent; "
                        onclick="location.href=' {{ route('ParkManager.materialsmanager.create') }}'"><i style="color: orangered; " class="fa fa-plus" aria-hidden="true"></i>
                    </button>
                    </div>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon fa fa-mortar-board"></span><span class="mtext">GESTION / SUIVI<br> DES
                            DOCUMENTS</span>
                    </a>
                    <ul class="submenu">
                        <li>
                            @if (Auth::user()->type == 'Gestionnaire parc' ||
                                Auth::user()->type == 'Utilisateur' ||
                                Auth::user()->type == 'Gestionnaire Sup')
                                <a style="right: 60px;" href="{{ route('ParkManager.insurances.index') }}">
                                @else
                                    <a  style="right: 60px;" href="#" class="isDisabled">
                            @endif

                            Gestion des assurances</a>
                        </li>

                        <li>
                            @if (Auth::user()->type == 'Gestionnaire parc' ||
                                Auth::user()->type == 'Utilisateur' ||
                                Auth::user()->type == 'Gestionnaire Sup')
                                <a  style="right: 60px;" href="{{ route('ParkManager.stickers.index') }}">
                                @else
                                    <a style="right: 60px;"  href="#" class="isDisabled">
                            @endif

                            Gestion des vignettes</a>
                        </li>
                        <li>
                            @if (Auth::user()->type == 'Gestionnaire parc' ||
                                Auth::user()->type == 'Utilisateur' ||
                                Auth::user()->type == 'Gestionnaire Sup')
                                <a style="right: 60px;"  href="{{ route('ParkManager.technicalcontrols.index') }}">
                                @else
                                    <a  style="right: 60px;" href="#" class="isDisabled">
                            @endif

                            Gestion des contrôles
                            techniques </a>
                        </li>
                        <li>
                            @if (Auth::user()->type == 'Gestionnaire parc' ||
                                Auth::user()->type == 'Utilisateur' ||
                                Auth::user()->type == 'Gestionnaire Sup')
                                <a style="right: 60px;"  href="{{ route('ParkManager.licences.index') }}">
                                @else
                                    <a  style="right: 60px;" href="#" class="isDisabled">
                            @endif

                            Gestion permis de circulation</a>
                        </li>
                        <li>
                            @if (Auth::user()->type == 'Gestionnaire parc' ||
                                Auth::user()->type == 'Utilisateur' ||
                                Auth::user()->type == 'Gestionnaire Sup')
                                <a style="right: 60px;"  href="{{ route('ParkManager.guarantis.index') }}">
                                @else
                                    <a  style="right: 60px;" href="#" class="isDisabled">
                            @endif

                            Service après-vente et Garantis</a>
                        </li>
                        <li>
                            @if (Auth::user()->type == 'Gestionnaire parc' ||
                                Auth::user()->type == 'Utilisateur' ||
                                Auth::user()->type == 'Gestionnaire Sup')
                                <a  style="right: 60px;" href="{{ route('ParkManager.accidents.index') }}">
                                @else
                                    <a  style="right: 60px;" href="#" class="isDisabled">
                            @endif

                            Gestion des déclarations des
                            accidents</a>
                        </li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon fa fa-toolbox"></span><span class="mtext">GESTION DU CENTRE <br> DE
                            MAINTENANCES</span>
                    </a>
                    <ul class="submenu">
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                VEHICULES
                            </a>
                            <ul class="submenu">
                                <div style=" display: inline-block;">
                                <li>

                                    <a  style="right: 60px;"  style="right: 60px;" href="{{ route('ParkManager.dts.index') }}">


                                        Gestion des demandes de travaux (DT)</a>
                                </li>
                            </div>
                            <div style=" display: inline-block;">
                                <button style=" position: absolute;
                                right: 20px; top:14px; background-color: transparent;
                                border-color: transparent; "
                                onclick="location.href=' {{ route('ParkManager.dts.create') }}'"><i style="color: orangered; " class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                            </div>
                                <li>
                                    @if (Auth::user()->type == 'Gestionnaire parc' ||
                                        Auth::user()->type == 'Utilisateur' ||
                                        Auth::user()->type == 'Gestionnaire Sup')
                                        <a style="right: 60px;"  href="{{ route('ParkManager.repairs.index') }}">
                                        @else
                                            <a style="right: 60px;" href="#" class="isDisabled">
                                    @endif

                                    Gestion des réparations</a>
                                </li>
                                <li>
                                    @if (Auth::user()->type == 'Gestionnaire parc' ||
                                        Auth::user()->type == 'Utilisateur' ||
                                        Auth::user()->type == 'Gestionnaire Sup')
                                        <a style="right: 60px;"  href="{{ route('ParkManager.maintenances.indexMaintenance') }}">
                                        @else
                                            <a style="right: 60px;" href="#" class="isDisabled">
                                    @endif

                                    Gestion des
                                    entretiens</a>

                                </li>
                                <li>
                                    @if (Auth::user()->type == 'Gestionnaire parc' ||
                                        Auth::user()->type == 'Utilisateur' ||
                                        Auth::user()->type == 'Gestionnaire Sup')
                                        <a style="right: 60px;"  href="{{ route('ParkManager.externals.index') }}">
                                        @else
                                            <a style="right: 60px;" href="#" class="isDisabled">
                                    @endif

                                    Maintenance externe</a>
                                </li>
                            </ul>
                        </li>


                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                MATERIELS MOTORISÉS
                            </a>
                            <ul class="submenu">
                                <div  style="right: 60px;" style=" display: inline-block;">
                                <li>

                                    <a style="right: 60px;"  href="{{ route('ParkManager.dtsM.index') }}">


                                        Gestion des demandes de travaux
                                        (DT)</a>
                                </li>
                            </div>
                            <div style=" display: inline-block;">
                                <button style=" position: absolute;
                                right: 20px; top:14px; background-color: transparent;
                                border-color: transparent; "
                                onclick="location.href=' {{ route('ParkManager.dtsM.create') }}'"><i style="color: orangered; " class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                            </div>

                                <li>
                                    @if (Auth::user()->type == 'Gestionnaire parc' ||
                                        Auth::user()->type == 'Utilisateur' ||
                                        Auth::user()->type == 'Gestionnaire Sup')
                                        <a style="right: 60px;"  href="{{ route('ParkManager.repairsM.index') }}">
                                        @else
                                            <a href="#" class="isDisabled">
                                    @endif

                                    Gestion des réparations</a>
                                </li>
                                <li>
                                    @if (Auth::user()->type == 'Gestionnaire parc' ||
                                        Auth::user()->type == 'Utilisateur' ||
                                        Auth::user()->type == 'Gestionnaire Sup')
                                        <a  style="right: 60px;" href="{{ route('ParkManager.externalsM.index') }}">
                                        @else
                                            <a style="right: 60px;" href="#" class="isDisabled">
                                    @endif
                                    Maintenance externe</a>
                                </li>

                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                PIECÈS DE RECHANGE
                            </a>
                            <ul class="submenu">
                                <div style=" display: inline-block;">
                                <li>
                                    @if (Auth::user()->type == 'Gestionnaire parc' ||
                                        Auth::user()->type == 'Utilisateur' ||
                                        Auth::user()->type == 'Gestionnaire Sup')
                                        <a  style="right: 60px;" style="right: 60px;" href="{{ route('ParkManager.piecesMaterial.index') }}">
                                        @else
                                            <a style="right: 60px;" href="#" class="isDisabled">
                                    @endif

                                    Gestion des pièces
                                    consommées Machine</a>
                                </li>
                            </div>
                            <div style=" display: inline-block;">
                                <button style=" position: absolute;
                                right: 20px; top:14px; background-color: transparent;
                                border-color: transparent; "
                                onclick="location.href=' {{ route('ParkManager.piecesMaterial.create') }}'"><i style="color: orangered; " class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                            </div>
                            <div style=" display: inline-block;">
                                <li>
                                    @if (Auth::user()->type == 'Gestionnaire parc' ||
                                        Auth::user()->type == 'Utilisateur' ||
                                        Auth::user()->type == 'Gestionnaire Sup')
                                        <a style="right: 60px;"  style="right: 60px;" href="{{ route('ParkManager.cps.index') }}">
                                        @else
                                            <a style="right: 60px;" href="#" class="isDisabled">
                                    @endif

                                    Gestion des pièces consommées Vehicule</a>
                                </li>
                            </div>
                            <div style=" display: inline-block;">
                                <button style=" position: absolute;
                                right: 20px; top:116px; background-color: transparent;
                                border-color: transparent; "
                                onclick="location.href=' {{ route('ParkManager.cps.create') }}'"><i style="color: orangered; " class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                            </div>
                                <li>
                                    @if (Auth::user()->type == 'Gestionnaire parc' ||
                                        Auth::user()->type == 'Utilisateur' ||
                                        Auth::user()->type == 'Gestionnaire Sup')
                                        <a  style="right: 60px;" href="{{ route('ParkManager.liquids.index') }}">
                                        @else
                                            <a style="right: 60px;" href="#" class="isDisabled">
                                    @endif

                                    Liquide et Lubrifiant</a>
                                </li>

                            </ul>
                        </li>




                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon fa fa-gas-pump"></span><span class="mtext">GESTION DES <br> CONSOMMATIONS<br> DE
                            CARBURANT</span>
                    </a>
                    <ul class="submenu">
                        <div style=" display: inline-block;">
                        <li>
                            @if (Auth::user()->type == 'Gestionnaire parc' ||
                                Auth::user()->type == 'Utilisateur' ||
                                Auth::user()->type == 'Gestionnaire Sup')
                                <a style="right: 60px;" href="{{ route('ParkManager.gasVehicules.index') }}">
                                @else
                                    <a style="right: 60px;" href="#" class="isDisabled">
                            @endif
                            Carb. Véhicule  </a>
                        </li>
                    </div>
                    <div style=" display: inline-block;">
                        <button style=" position: absolute;
                        right: 20px; top:14px; background-color: transparent;
                        border-color: transparent; "
                        onclick="location.href=' {{ route('ParkManager.gasVehicules.create') }}'"><i style="color: orangered; " class="fa fa-plus" aria-hidden="true"></i>
                    </button>
                </div>
                    <div style=" display: inline-block;">
                        <li>
                            @if (Auth::user()->type == 'Gestionnaire parc' ||
                                Auth::user()->type == 'Utilisateur' ||
                                Auth::user()->type == 'Gestionnaire Sup')
                                <a style="right: 60px;" href="{{ route('ParkManager.gasPipes.index') }}">
                                @else
                                    <a style="right: 60px;" href="#" class="isDisabled">
                            @endif
                            Carb. Unité </a>
                        </li>
                    </div>
                    <div style=" display: inline-block;">
                        <button style=" position: absolute;
                        right: 20px; top:65px; background-color: transparent;
                        border-color: transparent; "
                        onclick="location.href=' {{ route('ParkManager.gasPipes.create') }}'"><i style="color: orangered; " class="fa fa-plus" aria-hidden="true"></i>
                    </button>
                </div>
                    </ul>


                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon fa fa-clipboard-user"></span><span class="mtext">POINTAGES<br> ET ABSENCES</span>
                    </a>
                    <ul class="submenu">

                        <li>
                            @if (Auth::user()->type == 'Gestionnaire parc' ||
                                Auth::user()->type == 'Utilisateur' ||
                                Auth::user()->type == 'Gestionnaire Sup')
                                <a  style="right: 60px;" href="{{ route('ParkManager.attendances.index') }}">
                                @else
                                    <a style="right: 60px;"  href="#" class="isDisabled">
                            @endif
                            Gestion de pointage </a>
                        </li>
                        <li>
                            @if (Auth::user()->type == 'Gestionnaire parc' ||
                                Auth::user()->type == 'Utilisateur' ||
                                Auth::user()->type == 'Gestionnaire Sup')
                                <a style="right: 60px;"  href="{{ route('ParkManager.absences.index') }}">
                                @else
                                    <a  style="right: 60px;" style="right: 60px;" href="#" class="isDisabled">
                            @endif
                            Gestion des absences</a>
                        </li>

                    </ul>
                </li>

                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon fa fa-car"></span><span class="mtext">MISSIONS <br>ET DEPLACEMENTS </span>
                    </a>
                    <ul class="submenu">
                        <div style=" display: inline-block;">
                        <li>
                            @if (Auth::user()->type == 'Gestionnaire parc' ||
                                Auth::user()->type == 'Utilisateur' ||
                                Auth::user()->type == 'Gestionnaire Sup')
                                <a  style="right: 60px;" href="{{ route('ParkManager.missions.index') }}">
                                @else
                                    <a style="right: 60px;" href="#" class="isDisabled">
                            @endif
                            Gestion des déplacements</a>
                        </li>
                    </div>
                    <div style=" display: inline-block;">
                        <button style=" position: absolute;
                        right: 20px; top:14px; background-color: transparent;
                        border-color: transparent; "
                        onclick="location.href=' {{ route('ParkManager.missions.create') }}'"><i style="color: orangered; " class="fa fa-plus" aria-hidden="true"></i>
                    </button>
                </div>
                    </ul>
                </li>

                <li>
                    <div class="dropdown-divider"></div>
                </li>
                <li>
                    <div class="sidebar-small-cap">Autre</div>
                </li>

                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon fa fa-bar-chart"></span><span class="mtext">Statistiques</span>
                    </a>
                    <ul class="submenu">
                        <li>
                            @if (Auth::user()->type == 'Gestionnaire parc' ||
                                Auth::user()->type == 'Utilisateur' ||
                                Auth::user()->type == 'Gestionnaire Sup')
                                <a style="right: 60px;" href="{{ route('Kpis.gas.index') }}">
                                @else
                                    <a style="right: 60px;" href="#" class="isDisabled">
                            @endif
                            Carburant</a>
                        </li>

                        <li>
                            @if (Auth::user()->type == 'Gestionnaire parc' ||
                                Auth::user()->type == 'Utilisateur' ||
                                Auth::user()->type == 'Gestionnaire Sup')
                                <a style="right: 60px;" href="{{ route('Kpis.liquids.index') }}">
                                @else
                                    <a style="right: 60px;" href="#" class="isDisabled">
                            @endif

                            Liquide et Lubrifiant </a>
                        </li>
                        <li>
                            @if (Auth::user()->type == 'Gestionnaire parc' ||
                                Auth::user()->type == 'Utilisateur' ||
                                Auth::user()->type == 'Gestionnaire Sup')
                                <a style="right: 60px;" href="{{ route('Kpis.pieces.index') }}">
                                @else
                                    <a style="right: 60px;" href="#" class="isDisabled">
                            @endif

                            Pieces </a>
                        </li>
                        <li>
                            @if (Auth::user()->type == 'Gestionnaire parc' ||
                                Auth::user()->type == 'Utilisateur' ||
                                Auth::user()->type == 'Gestionnaire Sup')
                                <a style="right: 60px;" href="{{ route('Kpis.vehicules.index') }}">
                                @else
                                    <a style="right: 60px;" href="#" class="isDisabled">
                            @endif

                            Véhicules</a>
                        </li>
                        <li>
                            @if (Auth::user()->type == 'Gestionnaire parc' ||
                                Auth::user()->type == 'Utilisateur' ||
                                Auth::user()->type == 'Gestionnaire Sup')
                                <a style="right: 60px;" href="{{ route('Kpis.materials.index') }}">
                                @else
                                    <a style="right: 60px;" href="#" class="isDisabled">
                            @endif

                            MATÉRIELS MOTORISÉS</a>
                        </li>
                        <li>
                            @if (Auth::user()->type == 'Gestionnaire parc' ||
                                Auth::user()->type == 'Utilisateur' ||
                                Auth::user()->type == 'Gestionnaire Sup')
                                <a style="right: 60px;" href="{{ route('Kpis.pannes.index') }}">
                                @else
                                    <a style="right: 60px;" href="#" class="isDisabled">
                            @endif

                            Maintenances</a>
                        </li>

                        <li>
                            @if (Auth::user()->type == 'Gestionnaire parc' ||
                                Auth::user()->type == 'Utilisateur' ||
                                Auth::user()->type == 'Gestionnaire Sup')
                                <a style="right: 60px;" href="{{ route('Kpis.staff.index') }}">
                                @else
                                    <a style="right: 60px;" href="#" class="isDisabled">
                            @endif

                            Personnels</a>
                        </li>


                    </ul>
                </li>


                <li>
                    @if (Auth::user()->type == 'Gestionnaire parc' || Auth::user()->type == 'Utilisateur')
                        <a href="{{ URL('/history') }}" class="dropdown-toggle no-arrow  ">
                        @else
                            <a style="right: 60px;" href=# class="dropdown-toggle no-arrow isDisabled">
                    @endif



                    <span class="micon fa fa-history"></span><span class="mtext">Historique</span>
                    </a>
                </li>

                <li>
                    @if (Auth::user()->type == 'Gestionnaire parc' || Auth::user()->type == 'Utilisateur' ||
                    Auth::user()->type == 'Gestionnaire Sup')
                        <a href="{{ route('ParkManager.users.index') }}" class="dropdown-toggle no-arrow  ">
                        @else
                            <a  href=# class="dropdown-toggle no-arrow isDisabled">
                    @endif



                    <span class="micon fa fa-user"></span><span class="mtext">Gestion Utilisateurs</span>
                    </a>
                </li>





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
