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

                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-clipboard-fill"></span><span class="mtext">GESTION DES
                            <br>INFORMATIONS DU PARC</span>
                    </a>
                    <ul class="submenu">
                        <li>
                            @if (Auth::user()->type == 'Gestionnaire parc' ||
                                Auth::user()->type == 'Utilisateur' ||
                                Auth::user()->type == 'Gestionnaire Sup')
                                <a href="{{ route('ParkManager.vehicules.index') }}">
                                @else
                                    <a href="#" class="isDisabled"  >
                            @endif Gestion des véhicules</a>
                        </li>
                        <li>
                            @if (Auth::user()->type == 'Gestionnaire parc' ||
                                Auth::user()->type == 'Utilisateur' ||
                                Auth::user()->type == 'Gestionnaire Sup')
                                <a href="{{ route('ParkManager.staffs.index') }}">
                                @else
                                    <a href="#" class="isDisabled" >
                            @endif
                            Gestion du personnel </a>
                        </li>

                        <li>
                            @if (Auth::user()->type == 'Gestionnaire parc' ||
                                Auth::user()->type == 'Utilisateur' ||
                                Auth::user()->type == 'Gestionnaire Sup')
                                <a href="{{ route('ParkManager.attendances.index') }}">
                                @else
                                    <a href="#" class="isDisabled"  >
                            @endif
                            Gestion de pointage </a>
                        </li>
                        <li>
                            @if (Auth::user()->type == 'Gestionnaire parc' ||
                                Auth::user()->type == 'Utilisateur' ||
                                Auth::user()->type == 'Gestionnaire Sup')
                                <a href="{{ route('ParkManager.absences.index') }}">
                                @else
                                    <a href="#" class="isDisabled"  >
                            @endif
                            Gestion des absences</a>
                        </li>
                        <li>
                            @if (Auth::user()->type == 'Gestionnaire parc' ||
                                Auth::user()->type == 'Utilisateur' ||
                                Auth::user()->type == 'Gestionnaire Sup')
                                <a href="{{ route('ParkManager.units.index') }}">
                                @else
                                    <a href="#" class="isDisabled">
                            @endif

                            Gestion des unités </a>
                        </li>
                        <li>
                            @if (Auth::user()->type == 'Gestionnaire parc' ||
                                Auth::user()->type == 'Utilisateur' ||
                                Auth::user()->type == 'Gestionnaire Sup')
                                <a href="{{ route('ParkManager.missions.index') }}">
                                @else
                                    <a href="#" class="isDisabled">
                            @endif
                            Gestion des déplacements</a>
                        </li>
                        <li>
                            @if (Auth::user()->type == 'Gestionnaire parc' ||
                                Auth::user()->type == 'Utilisateur' ||
                                Auth::user()->type == 'Gestionnaire Sup')
                                <a href="{{ route('ParkManager.users.index') }}">
                                @else
                                    <a href="#" class="isDisabled">
                            @endif
                            Gestion Utilisateurs</a>
                        </li>

                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                Gestion des consommations de carburant
                            </a>
                            <ul class="submenu">
                                <li>
                                    @if (Auth::user()->type == 'Gestionnaire parc' ||
                                        Auth::user()->type == 'Utilisateur' ||
                                        Auth::user()->type == 'Gestionnaire Sup')
                                        <a href="{{ route('ParkManager.gasVehicules.index') }}">
                                        @else
                                            <a href="#" class="isDisabled">
                                    @endif
                                    Pour véhicule</a>
                                </li>
                                <li>
                                    @if (Auth::user()->type == 'Gestionnaire parc' ||
                                        Auth::user()->type == 'Utilisateur' ||
                                        Auth::user()->type == 'Gestionnaire Sup')
                                        <a href="{{ route('ParkManager.gasPipes.index') }}">
                                        @else
                                            <a href="#" class="isDisabled">
                                    @endif
                                    Pour équipements motorisés/
                                    Pépinière </a>
                                </li>

                            </ul>
                        </li>
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
                                <a href="{{ route('ParkManager.insurances.index') }}">
                                @else
                                    <a href="#" class="isDisabled">
                            @endif

                            Gestion des assurances</a>
                        </li>
                        <li>
                            @if (Auth::user()->type == 'Gestionnaire parc' ||
                                Auth::user()->type == 'Utilisateur' ||
                                Auth::user()->type == 'Gestionnaire Sup')
                                <a href="{{ route('ParkManager.accidents.index') }}">
                                @else
                                    <a href="#" class="isDisabled">
                            @endif

                            Gestion des déclarations des
                            accidents</a>
                        </li>
                        <li>
                            @if (Auth::user()->type == 'Gestionnaire parc' ||
                                Auth::user()->type == 'Utilisateur' ||
                                Auth::user()->type == 'Gestionnaire Sup')
                                <a href="{{ route('ParkManager.stickers.index') }}">
                                @else
                                    <a href="#" class="isDisabled">
                            @endif

                            Gestion des vignettes</a>
                        </li>
                        <li>
                            @if (Auth::user()->type == 'Gestionnaire parc' ||
                                Auth::user()->type == 'Utilisateur' ||
                                Auth::user()->type == 'Gestionnaire Sup')
                                <a href="{{ route('ParkManager.technicalcontrols.index') }}">
                                @else
                                    <a href="#" class="isDisabled">
                            @endif

                            Gestion des contrôles
                            techniques </a>
                        </li>
                        <li>
                            @if (Auth::user()->type == 'Gestionnaire parc' ||
                                Auth::user()->type == 'Utilisateur' ||
                                Auth::user()->type == 'Gestionnaire Sup')
                                <a href="{{ route('ParkManager.licences.index') }}">
                                @else
                                    <a href="#" class="isDisabled">
                            @endif

                            Gestion permis de circulation</a>
                        </li>
                        <li>
                            @if (Auth::user()->type == 'Gestionnaire parc' ||
                                Auth::user()->type == 'Utilisateur' ||
                                Auth::user()->type == 'Gestionnaire Sup')
                                <a href="{{ route('ParkManager.guarantis.index') }}">
                                @else
                                    <a href="#" class="isDisabled">
                            @endif

                            Service après-vente et Garantis</a>
                        </li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon fi-torso-business"></span><span class="mtext">GESTION DU CENTRE <br> DE
                            MAINTENANCES</span>
                    </a>
                    <ul class="submenu">
                        <li>

                                <a href="{{ route('ParkManager.dts.index') }}">


                            Gestion des demandes de travaux (DT)</a>
                        </li>
                        <li>
                            @if (Auth::user()->type == 'Gestionnaire parc' ||
                                Auth::user()->type == 'Utilisateur' ||
                                Auth::user()->type == 'Gestionnaire Sup')
                                <a href="{{ route('ParkManager.repairs.index') }}">
                                @else
                                    <a href="#" class="isDisabled">
                            @endif

                            Gestion des réparations</a>
                        </li>
                        <li>
                            @if (Auth::user()->type == 'Gestionnaire parc' ||
                                Auth::user()->type == 'Utilisateur' ||
                                Auth::user()->type == 'Gestionnaire Sup')
                                <a href="{{ route('ParkManager.maintenances.indexMaintenance') }}">
                                @else
                                    <a href="#" class="isDisabled">
                            @endif

                            Gestion des
                            entretiens</a>
                        </li>
                        <li>
                            @if (Auth::user()->type == 'Gestionnaire parc' ||
                                Auth::user()->type == 'Utilisateur' ||
                                Auth::user()->type == 'Gestionnaire Sup')
                                <a href="{{ route('ParkManager.cps.index') }}">
                                @else
                                    <a href="#" class="isDisabled">
                            @endif

                            Gestion des pièces consommées</a>
                        </li>
                        <li>
                            @if (Auth::user()->type == 'Gestionnaire parc' ||
                                Auth::user()->type == 'Utilisateur' ||
                                Auth::user()->type == 'Gestionnaire Sup')
                                <a href="{{ route('ParkManager.externals.index') }}">
                                @else
                                    <a href="#" class="isDisabled">
                            @endif

                            Maintenance externe</a>
                        </li>
                        <li>
                            @if (Auth::user()->type == 'Gestionnaire parc' ||
                                Auth::user()->type == 'Utilisateur' ||
                                Auth::user()->type == 'Gestionnaire Sup')
                                <a href="{{ route('ParkManager.liquids.index') }}">
                                @else
                                    <a href="#" class="isDisabled">
                            @endif

                            Liquide et Lubrifiant</a>
                        </li>

                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon fa fa-group"></span><span class="mtext">GESTION DU<br> MATÉRIELS
                            MOTORISÉS</span>
                    </a>
                    <ul class="submenu">
                        <li>
                            @if (Auth::user()->type == 'Gestionnaire parc' ||
                                Auth::user()->type == 'Utilisateur' ||
                                Auth::user()->type == 'Gestionnaire Sup')
                                <a href="{{ route('ParkManager.materialsmanager.index') }}">
                                @else
                                    <a href="#" class="isDisabled">
                            @endif

                            Gestion des informations du
                            matériel motorisé</a>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                Gestion des <br> maintenances de <br>matériel motorisé
                            </a>
                            <ul class="submenu">
                                <li>

                                        <a href="{{ route('ParkManager.dtsM.index') }}">


                                    Gestion des demandes de travaux
                                    (DT)</a>
                                </li>
                                <li>
                                    @if (Auth::user()->type == 'Gestionnaire parc' ||
                                        Auth::user()->type == 'Utilisateur' ||
                                        Auth::user()->type == 'Gestionnaire Sup')
                                        <a href="{{ route('ParkManager.piecesMaterial.index') }}">
                                        @else
                                            <a href="#" class="isDisabled">
                                    @endif

                                    Gestion des pièces
                                    consommées</a>
                                </li>
                                <li>
                                    @if (Auth::user()->type == 'Gestionnaire parc' ||
                                        Auth::user()->type == 'Utilisateur' ||
                                        Auth::user()->type == 'Gestionnaire Sup')
                                        <a href="{{ route('ParkManager.repairsM.index') }}">
                                        @else
                                            <a href="#" class="isDisabled">
                                    @endif

                                    Gestion des réparations</a>
                                </li>
                                <li>
                                    @if (Auth::user()->type == 'Gestionnaire parc' ||
                                        Auth::user()->type == 'Utilisateur' ||
                                        Auth::user()->type == 'Gestionnaire Sup')
                                        <a href="{{ route('ParkManager.externalsM.index') }}">
                                        @else
                                            <a href="#" class="isDisabled">
                                    @endif
                                    Maintenance externe</a>
                                </li>


                            </ul>
                        </li>
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
                                <a href="{{ route('Kpis.gas.index') }}">
                                @else
                                    <a href="#" class="isDisabled">
                            @endif
                            Carburant</a>
                        </li>
                        <li>
                            @if (Auth::user()->type == 'Gestionnaire parc' ||
                                Auth::user()->type == 'Utilisateur' ||
                                Auth::user()->type == 'Gestionnaire Sup')
                                <a href="{{ route('Kpis.interventions.index') }}">
                                @else
                                    <a href="#" class="isDisabled">
                            @endif

                            Interventions</a>
                        </li>
                        <li>
                            @if (Auth::user()->type == 'Gestionnaire parc' ||
                                Auth::user()->type == 'Utilisateur' ||
                                Auth::user()->type == 'Gestionnaire Sup')
                                <a href="{{ route('Kpis.liquids.index') }}">
                                @else
                                    <a href="#" class="isDisabled">
                            @endif

                            Liquide et Lubrifiant </a>
                        </li>
                        <li>
                            @if (Auth::user()->type == 'Gestionnaire parc' ||
                                Auth::user()->type == 'Utilisateur' ||
                                Auth::user()->type == 'Gestionnaire Sup')
                                <a href="{{ route('Kpis.pieces.index') }}">
                                @else
                                    <a href="#" class="isDisabled">
                            @endif

                            Pieces </a>
                        </li>
                        <li>
                            @if (Auth::user()->type == 'Gestionnaire parc' ||
                                Auth::user()->type == 'Utilisateur' ||
                                Auth::user()->type == 'Gestionnaire Sup')
                                <a href="{{ route('Kpis.vehicules.index') }}">
                                @else
                                    <a href="#" class="isDisabled">
                            @endif

                            Vehicules</a>
                        </li>
                        <li>
                            @if (Auth::user()->type == 'Gestionnaire parc' ||
                                Auth::user()->type == 'Utilisateur' ||
                                Auth::user()->type == 'Gestionnaire Sup')
                                <a href="{{ route('Kpis.materials.index') }}">
                                @else
                                    <a href="#" class="isDisabled">
                            @endif

                            MATÉRIELS MOTORISÉS</a>
                        </li>
                        <li>
                            @if (Auth::user()->type == 'Gestionnaire parc' ||
                                Auth::user()->type == 'Utilisateur' ||
                                Auth::user()->type == 'Gestionnaire Sup')
                                <a href="{{ route('Kpis.pannes.index') }}">
                                @else
                                    <a href="#" class="isDisabled">
                            @endif

                            Mintenances</a>
                        </li>

                        <li>
                            @if (Auth::user()->type == 'Gestionnaire parc' ||
                                Auth::user()->type == 'Utilisateur' ||
                                Auth::user()->type == 'Gestionnaire Sup')
                                <a href="{{ route('Kpis.staff.index') }}">
                                @else
                                    <a href="#" class="isDisabled">
                            @endif

                            Personnels</a>
                        </li>


                    </ul>
                </li>


                <li>
                    @if (Auth::user()->type == 'Gestionnaire parc' ||
                                Auth::user()->type == 'Utilisateur')
                                 <a href="{{ URL('/history') }}" class="dropdown-toggle no-arrow  ">

                                @else
                                <a href=# class="dropdown-toggle no-arrow isDisabled">



                                    @endif



                    <span class="micon fa fa-history"></span><span class="mtext">Historique</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>



<style>.isDisabled {
    color: currentColor;
    cursor: not-allowed;
    opacity: 0.5;
    text-decoration: none;
  }</style>



