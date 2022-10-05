<div class="wrapper">

    <div class="sidebar" data-color="white" data-active-color="danger">
        <div class="logo">
            <a href="#" class="simple-text logo-mini">
                <div class="logo-image-small">
                    <img src="{{ asset('paper') }}/img/edeval.png"   height="40">
                </div>
            </a>
            <a href="#" class="simple-text logo-normal">
                {{ __('EVEDAL') }}
            </a>
        </div>
        <div class="sidebar-wrapper">
            <ul class="nav">

                <li >
                    <a data-toggle="collapse" aria-expanded="true" href="#laravelExamples">
                        <i class="nc-icon"><img src="{{ asset('paper/img/warehouse.svg') }}"></i>
                        <p>
                                {{ __('GESTION DES INFORMATIONS DU PARC') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse show" id="laravelExamples">
                        <ul class="nav">
                            <li >
                                <a href="{{route('ParkManager.users.index')}}" style="font-size:80%;">
                                    <i class="fa fa-user"  style="font-size:200%;"> </i>
                                    <span class="sidebar-mini-icon"></span>
                                    <span class="sidebar-normal">   {{ __('  Gestion des utilisateurs ') }}
                                    </span>
                                </a>
                            </li>
                            <li >
                                <a href="{{route('ParkManager.vehicules.index')}}" style="font-size:80%;">
                                    <i class="fa fa-car"  style="font-size:200%;"> </i>
                                    <span class="sidebar-mini-icon"></span>
                                    <span class="sidebar-normal">   {{ __('  Gestion des véhicules ') }}
                                    </span>
                                </a>
                            </li>



                            <li  >
                                <a href="{{route('ParkManager.attendances.index')}}" style="font-size:80%;">
                                    <i class="fa fa-check"  style="font-size:200%;"> </i>
                                    <span class="sidebar-mini-icon"></span>
                                    <span class="sidebar-normal">   {{ __('  Gestion des pointage ') }}
                                    </span>
                                </a>
                            </li>


                            <li  >
                                <a href="{{route('ParkManager.absences.index')}}" style="font-size:80%;">
                                    <i class="fa fa-list"  style="font-size:200%;"> </i>
                                    <span class="sidebar-mini-icon"></span>
                                    <span class="sidebar-normal">   {{ __('  Gestion des absences ') }}
                                    </span>
                                </a>
                            </li>


                            <li >
                                <a href="{{route('ParkManager.units.index')}}" style="font-size:80%;">
                                    <i class="fa fa-university"  style="font-size:200%;"> </i>
                                    <span class="sidebar-mini-icon"></span>
                                    <span class="sidebar-normal">   {{ __('  Gestion des unités ') }}
                                    </span>
                                </a>
                            </li>


                            <li >
                                <a href="{{route('ParkManager.missions.index')}}" style="font-size:80%;">
                                    <i class="fa fa-cube"  style="font-size:200%;"> </i>
                                    <span class="sidebar-mini-icon"></span>
                                    <span class="sidebar-normal">   {{ __('  Gestion des déplacements ') }}
                                    </span>
                                </a>
                            </li>

                            <li >
                                <a data-toggle="collapse" aria-expanded="true" href="#gas" style="font-size:80%;">
                                    <i class="fa fa-oil-can"  style="font-size:200%;"> </i>

                                    <span class="sidebar-mini-icon"><img src="{{ asset('paper/img/gas.svg') }}" width="30" height="30"></span>
                                Gestion des  <br> consommationsde carburant
                                    </span>
                                        <b class="caret"></b>

                                </a>
                                <div class="collapse show" id="gas">
                                    <ul class="nav">
                                        <li >
                                            <a href="{{route('ParkManager.gasVehicules.index')}}" style="font-size:80%;">
                                                <span class="sidebar-mini-icon"><img src="{{ asset('paper/img/gas.svg') }}" width="30" height="30"></span>
                                                <span class="sidebar-normal">   {{ __('Pour véhicule ') }}
                                                </span>

                                            </a>
                                        </li>
                                        <br>
                                        <li >
                                            <a href="{{route('ParkManager.gasPipes.index')}}" style="font-size:80%;">

                                                <span class="sidebar-mini-icon"><img src="{{ asset('paper/img/pipe.svg') }}" width="30" height="30"></span>
                                                <span class="sidebar-normal" style="font-size:100%;">   Pour équipements <br>
                                                motorisés/ Pépinière
                                                </span>
                                            </a>
                                        </li>

                                    </ul>

                                </div>
                            </li >
                        </ul>

                    </div>
                </li >
                <li >
                    <a data-toggle="collapse" aria-expanded="true" href="#docs" style="font-size:80%;">

                        <span class="sidebar-mini-icon"><img src="{{ asset('paper/img/docs.svg') }}" width="30" height="30"></span>
                        GESTION / SUIVI DES  <br>  &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp;DOCUMENTS </span>
                            <b class="caret"></b>
                            <div class="collapse show" id="docs">

                                <ul class="nav">

                                    <li  >
                                        <a href="{{route('ParkManager.insurances.index')}}" style="font-size:80%;">

                                            <span class="sidebar-mini-icon"><img src="{{ asset('paper/img/insurance.svg') }}" width="30" height="30"></span>
                                            <span class="sidebar-normal" style="font-size:100%;">  Gestion des assurances </span>


                                        </a>
                                    </li>

                                    <li  >
                                        <a href="{{route('ParkManager.accidents.index')}}" style="font-size:80%;">
                                            <span class="sidebar-mini-icon"><img src="{{ asset('paper/img/accident.svg') }}" width="30" height="30"></span>
                                            <span class="sidebar-normal" style="font-size:100%;">   Gestion des déclarations <br>  des accidents
                                            </span>



                                          </a>
                                    </li>
                                    <li >
                                        <a href="{{route('ParkManager.stickers.index')}}" style="font-size:80%;">

                                                                    <span class="sidebar-mini-icon"><img src="{{ asset('paper/img/sticker.svg') }}" width="30" height="30"></span>
                                            <span class="sidebar-normal" style="font-size:100%;">
                                                Gestion des vignettes
                                            </span>


                                        </a>
                                    </li>
                                    <li  >
                                        <a href="{{route('ParkManager.technicalcontrols.index')}}" style="font-size:80%;">

                                            <span class="sidebar-mini-icon"><img src="{{ asset('paper/img/control.svg') }}" width="30" height="30"></span>
                                            <span class="sidebar-normal" style="font-size:100%;">   Gestion des contrôles <br>  techniques
                                            </span>



                                        </a>
                                    </li>
                                    <li  >
                                        <a href="{{route('ParkManager.licences.index')}}" style="font-size:80%;">

                                            <span class="sidebar-mini-icon"><img src="{{ asset('paper/img/licence.svg') }}" width="30" height="30"></span>
                                            <span class="sidebar-normal" style="font-size:100%;">    Gestion permis <br>  de circulation
                                            </span>


                                        </a>
                                    </li>
                                    <li  >
                                        <a href="{{route('ParkManager.guarantis.index')}}" style="font-size:80%;">


                                            <span class="sidebar-mini-icon"><img src="{{ asset('paper/img/guaranty.svg') }}" width="30" height="30"></span>
                                            <span class="sidebar-normal" style="font-size:100%;">     Service après-vente <br> et Garantis
                                            </span>

                                        </a>
                                    </li>

                                </ul>
                            </div>
                    </a>
                </li>



                <li >
                    <a data-toggle="collapse" aria-expanded="true" href="#maintenance" style="font-size:80%;">

                        <span class="sidebar-mini-icon"><img src="{{ asset('paper/img/maintenance.svg') }}" width="30" height="30"></span>
                        GESTION DU CENTRE DE MAINTENANCES</span>
                            <b class="caret"></b>
                            <div class="collapse show" id="maintenance">

                                <ul class="nav">

                                    <li  >
                                        <a href="{{route('ParkManager.dts.index')}}" style="font-size:80%;">

                                            <span class="sidebar-mini-icon"><img src="{{ asset('paper/img/dts.svg') }}" width="30" height="30"></span>
                                            <span class="sidebar-normal" style="font-size:100%;">  Gestion des demandes <br>de travaux (DT)</span>


                                        </a>
                                    </li>

                                    <li  >
                                        <a href="{{route('ParkManager.repairs.index')}}" style="font-size:80%;">
                                            <span class="sidebar-mini-icon"><img src="{{ asset('paper/img/repairs.svg') }}" width="30" height="30"></span>
                                            <span class="sidebar-normal" style="font-size:100%;">  Gestion des réparations
                                            </span>



                                          </a>
                                    </li>
                                    <li >
                                        <a href="{{route('ParkManager.maintenances.indexMaintenance')}}" style="font-size:80%;">

                                            <span class="sidebar-mini-icon"><img src="{{ asset('paper/img/entretiens.svg') }}" width="30" height="30"></span>
                                            <span class="sidebar-normal" style="font-size:100%;">
                                                Gestion des entretiens
                                            </span>


                                        </a>
                                    </li>
                                    <li  >
                                        <a href="{{route('ParkManager.cps.index')}}" style="font-size:80%;">

                                            <span class="sidebar-mini-icon"><img src="{{ asset('paper/img/pieces.svg') }}" width="30" height="30"></span>
                                            <span class="sidebar-normal" style="font-size:100%;">   Gestion des pièces<br> consommées
                                            </span>



                                        </a>
                                    </li>
                                    <li  >
                                        <a href="{{route('ParkManager.externals.index')}}" style="font-size:80%;">

                                            <span class="sidebar-mini-icon"><img src="{{ asset('paper/img/externe.svg') }}" width="30" height="30"></span>
                                            <span class="sidebar-normal" style="font-size:100%;">     Maintenance externe
                                            </span>


                                        </a>
                                    </li>


                                </ul>
                            </div>
                    </a>
                </li>
                <li >
                    <a data-toggle="collapse" aria-expanded="true" href="#mm" style="font-size:80%;">

                        <span class="sidebar-mini-icon"><img src="{{ asset('paper/img/mm.svg') }}" width="30" height="30"></span>
                        GESTION DU MATÉRIELS <br> &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;  &nbsp;MOTORISÉS</span>
                            <b class="caret"></b>
                            <div class="collapse show" id="mm">

                                <ul class="nav">

                                    <li  >
                                        <a href="{{route('ParkManager.materialsmanager.index')}}" style="font-size:80%;">

                                            <span class="sidebar-mini-icon"><img src="{{ asset('paper/img/infomm.svg') }}" width="30" height="30"></span>
                                            <span class="sidebar-normal" style="font-size:100%;">  Gestion des informations</span>


                                        </a>
                                    </li>
                                    <li >
                                        <a data-toggle="collapse" aria-expanded="true" href="#maintenancemm" style="font-size:80%;">
                                            <i class="fa fa-oil-can"  style="font-size:200%;"> </i>

                                            <span class="sidebar-mini-icon"><img src="{{ asset('paper/img/mmaintenance.svg') }}" width="30" height="30"></span>
                                            Gestion des <br>maintenances de MM
                                            </span>
                                                <b class="caret"></b>

                                        </a>
                                        <div class="collapse show" id="maintenancemm">
                                            <ul class="nav">
                                                <li >
                                                    <a href="{{route('ParkManager.dtsM.index')}}" style="font-size:80%;">
                                                        <span class="sidebar-mini-icon"><img src="{{ asset('paper/img/dtM.svg') }}" width="30" height="30"></span>
                                                        <span class="sidebar-normal">   Gestion des demandes <br>de travaux (DT)
                                                        </span>

                                                    </a>
                                                </li>
                                                <br>
                                                <li >
                                                    <a href="{{route('ParkManager.piecesMaterial.index')}}" style="font-size:80%;">

                                                        <span class="sidebar-mini-icon"><img src="{{ asset('paper/img/piecem.svg') }}" width="30" height="30"></span>
                                                        <span class="sidebar-normal" style="font-size:100%;">Gestion des pièces <br>consommées
                                                        </span>
                                                    </a>
                                                </li>
                                                <li >
                                                    <a href="{{route('ParkManager.repairsM.index')}}" style="font-size:80%;">

                                                        <span class="sidebar-mini-icon"><img src="{{ asset('paper/img/repairm.svg') }}" width="30" height="30"></span>
                                                        <span class="sidebar-normal" style="font-size:100%;">
                                                            Gestion des réparations
                                                        </span>
                                                    </a>
                                                </li>

                                                <li >
                                                    <a href="{{route('ParkManager.externalsM.index')}}" style="font-size:80%;">

                                                        <span class="sidebar-mini-icon"><img src="{{ asset('paper/img/externalm.svg') }}" width="30" height="30"></span>
                                                        <span class="sidebar-normal" style="font-size:100%;">
                                                            Maintenance externe
                                                        </span>
                                                    </a>
                                                </li>

                                            </ul>

                                        </div>
                                    </li >

                                </ul>
                            </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
