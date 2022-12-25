<script src="https://kit.fontawesome.com/4812ff0186.js" crossorigin="anonymous"></script>
<div class="header">
    <div class="header-left">
        <div class="menu-icon bi bi-list"></div>
        <div class="search-toggle-icon bi bi-search" data-toggle="header_search"></div>

    </div>
    <div class="header-right">
        @if (Auth::user()->type == 'Gestionnaire parc' ||
        Auth::user()->type == 'Utilisateur' ||
        Auth::user()->type == 'Gestionnaire Sup')
        <div class="user-notification">
            <div class="dropdown" style=" left:-10%;">
                <a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">

                    <span class="hovertext" data-hover="Toutes les notifications">
                        <i style="font-size: 2em;
                           @if (Auth::user()->notifications->where('read_at','!=','null')->count()==0)
                                                    color: grey
                                                @endif
                                                "  class="fa fa-bell  " aria-hidden="true" style="color: grey" ></i>
                      </span>
                    <b>
                        {{ Auth::user()->notifications->count() }}</b>
                    <span class="badge  "></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="notification-list ">
                        <ul>

                            <li>

                                <a href="{{ route('markAllRead') }}">
                                    <h3 style="display:inline"> Tout marquer
                                    </h3>
                                    <p>
                                        comme lu
                                    </p>

                                </a>
                            </li>
                            @foreach (Auth::user()->notifications as $notification)

                                    <li
                                        @if ($notification->read_at == null) style="background-color:rgb(238, 173, 173)" @endif>
                                        <a href="{{ route('markAsRead', $notification->id) }} ">
                                            <h3 style="display:inline">
                                                @if ($notification->read_at != null)
                                                    ✅
                                                @else
                                                    <span class="fa fa-circle" style="color: red">
                                                    </span>
                                                @endif {{ $notification->data['from'] }}
                                            </h3>
                                            <p>
                                                {{ $notification->data['details'] }}
                                            </p>

                                        </a>
                                    </li>

                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="user-notification">
            <div class="dropdown" style=" left:-10%;">
                <a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">

                    <span class="hovertext" data-hover="Permit de circulation">
                 <i style="font-size: 2em;

                 @if ( Auth::user()->notifications->where('type','=','App\Notifications\LicenseNotification')->count() ==0)
                                                    color: grey
                                                @endif"  class="fa fa-id-card  " aria-hidden="true"style="color: grey" ></i>
                      </span>
                    <b>
                        {{ Auth::user()->notifications->where('type','=','App\Notifications\LicenseNotification')->count() }}</b>
                    <span class="badge  "></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="notification-list ">
                        <ul>

                            <li>

                                <a href="{{ route('markAllRead') }}">
                                    <h3 style="display:inline"> Tout marquer
                                    </h3>
                                    <p>
                                        comme lu
                                    </p>

                                </a>
                            </li>
                            @foreach (Auth::user()->notifications as $notification)
                                @if ($notification->type == 'App\Notifications\LicenseNotification')
                                    <li
                                        @if ($notification->read_at == null) style="background-color:rgb(238, 173, 173)" @endif>
                                        <a href="{{ route('markAsRead', $notification->id) }} ">
                                            <h3 style="display:inline">
                                                @if ($notification->read_at != null)
                                                    ✅
                                                @else
                                                    <span class="fa fa-circle" style="color: red">
                                                    </span>
                                                @endif {{ $notification->data['from'] }}
                                            </h3>
                                            <p>
                                                {{ $notification->data['details'] }}
                                            </p>

                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="user-notification">
            <div class="dropdown" style=" left:-10%;">
                <a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">

                    <span  class="hovertext" data-hover="Contrôle technique">
                        <i style="font-size: 2em;   @if ( Auth::user()->notifications->where('type','=','App\Notifications\ControllNotification')->count() ==0)
                            color: grey
                        @endif" class="fa fa-book  " aria-hidden="true"style="color: grey" ></i>
                    </span>
                    <b>
                        {{ Auth::user()->notifications->where('type','=','App\Notifications\ControllNotification')->count() }}</b>
                    <span class="badge  "></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="notification-list ">
                        <ul>

                            <li>

                                <a href="{{ route('markAllRead') }}">
                                    <h3 style="display:inline"> Tout marquer
                                    </h3>
                                    <p>
                                        comme lu
                                    </p>

                                </a>
                            </li>
                            @foreach (Auth::user()->notifications as $notification)
                                @if ($notification->type == 'App\Notifications\ControllNotification')
                                    <li
                                        @if ($notification->read_at == null) style="background-color:rgb(238, 173, 173)" @endif>
                                        <a href="{{ route('markAsRead', $notification->id) }} ">
                                            <h3 style="display:inline">
                                                @if ($notification->read_at != null)
                                                    ✅
                                                @else
                                                    <span class="fa fa-circle" style="color: red">
                                                    </span>
                                                @endif {{ $notification->data['from'] }}
                                            </h3>
                                            <p>
                                                {{ $notification->data['details'] }}
                                            </p>

                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="user-notification">
            <div class="dropdown" style=" left:-10%;">
                <a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">

                    <span class="hovertext" data-hover="Absence">
                        <i style="font-size: 2em;
                         @if (Auth::user()->notifications->where('type','=','App\Notifications\AbsenceNotification')->count()  ==0)
                            color: grey
                        @endif"  class="fa fa-address-book  " aria-hidden="true"style="color: grey" ></i>
                    </span>
                    <b>
                        {{ Auth::user()->notifications->where('type','=','App\Notifications\AbsenceNotification')->count() }}</b>
                    <span class="badge  "></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="notification-list ">
                        <ul>

                            <li>

                                <a href="{{ route('markAllRead') }}">
                                    <h3 style="display:inline"> Tout marquer
                                    </h3>
                                    <p>
                                        comme lu
                                    </p>

                                </a>
                            </li>
                            @foreach (Auth::user()->notifications as $notification)
                                @if ($notification->type == 'App\Notifications\AbsenceNotification')
                                    <li
                                        @if ($notification->read_at == null) style="background-color:rgb(238, 173, 173)" @endif>
                                        <a href="{{ route('markAsRead', $notification->id) }} ">
                                            <h3 style="display:inline">
                                                @if ($notification->read_at != null)
                                                    ✅
                                                @else
                                                    <span class="fa fa-circle" style="color: red">
                                                    </span>
                                                @endif {{ $notification->data['from'] }}
                                            </h3>
                                            <p>
                                                {{ $notification->data['details'] }}
                                            </p>

                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="user-notification">
            <div class="dropdown" style=" left:-10%;">
                <a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">


                    <span class="hovertext" data-hover="Missions ">
                    <i style="font-size: 2em;
                     @if ( Auth::user()->notifications->where('type','=','App\Notifications\MissionNotification')->count()  ==0)
                            color: grey
                        @endif"  class="fa-solid fa-car  "style="color: grey" ></i>
                    </span>
                    <b>
                        {{ Auth::user()->notifications->where('type','=','App\Notifications\MissionNotification')->count() }}</b>
                    <span class="badge  "></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="notification-list ">
                        <ul>

                            <li>

                                <a href="{{ route('markAllRead') }}">
                                    <h3 style="display:inline"> Tout marquer
                                    </h3>
                                    <p>
                                        comme lu
                                    </p>

                                </a>
                            </li>
                            @foreach (Auth::user()->notifications as $notification)
                                @if ($notification->type == 'App\Notifications\MissionNotification')
                                    <li
                                        @if ($notification->read_at == null) style="background-color:rgb(238, 173, 173)" @endif>
                                        <a href="{{ route('markAsRead', $notification->id) }} ">
                                            <h3 style="display:inline">
                                                @if ($notification->read_at != null)
                                                    ✅
                                                @else
                                                    <span class="fa fa-circle" style="color: red">
                                                    </span>
                                                @endif {{ $notification->data['from'] }}
                                            </h3>
                                            <p>
                                                {{ $notification->data['details'] }}
                                            </p>

                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="user-notification">
            <div class="dropdown" style=" left:-10%;">
                <a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">

                    <span class="hovertext" data-hover="Assurances ">
                        <i style="font-size: 2em;
                           @if (Auth::user()->notifications->where('type','=','App\Notifications\InsuranceNotification')->count() ==0)
                            color: grey
                        @endif"  class="fa-sharp fa-solid fa-shield  "style="color: grey" ></i>
                    </span>
                    <b>
                        {{ Auth::user()->notifications->where('type','=','App\Notifications\InsuranceNotification')->count() }}</b>
                    <span class="badge  "></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="notification-list ">
                        <ul>

                            <li>

                                <a href="{{ route('markAllRead') }}">
                                    <h3 style="display:inline"> Tout marquer
                                    </h3>
                                    <p>
                                        comme lu
                                    </p>

                                </a>
                            </li>
                            @foreach (Auth::user()->notifications as $notification)
                                @if ($notification->type == 'App\Notifications\InsuranceNotification'   )
                                    <li
                                        @if ($notification->read_at == null) style="background-color:rgb(238, 173, 173)" @endif>
                                        <a href="{{ route('markAsRead', $notification->id) }} ">
                                            <h3 style="display:inline">
                                                @if ($notification->read_at != null)
                                                    ✅
                                                @else
                                                    <span class="fa fa-circle" style="color: red">
                                                    </span>
                                                @endif {{ $notification->data['from'] }}
                                            </h3>
                                            <p>
                                                {{ $notification->data['details'] }}
                                            </p>

                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="user-notification">
            <div class="dropdown" style=" left:-10%;">
                <a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">

                    <span class="hovertext" data-hover="Vignettes">
                        <i style="font-size: 2em;
                         @if ( Auth::user()->notifications->where('type','=','App\Notifications\StickersNotification')->count()  ==0)
                            color: grey
                        @endif"  class="fa-solid fa-note-sticky  "style="color: grey" ></i>
                    </span>
                    <b>
                        {{ Auth::user()->notifications->where('type','=','App\Notifications\StickersNotification')->count() }}</b>
                    <span class="badge  "></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="notification-list ">
                        <ul>

                            <li>
                                <a href="{{ route('markAllRead') }}">
                                    <h3 style="display:inline"> Tout marquer
                                    </h3>
                                    <p>
                                        comme lu
                                    </p>

                                </a>
                            </li>
                            @foreach (Auth::user()->notifications as $notification)
                                @if ($notification->type == 'App\Notifications\StickersNotification' || $notification->type == 'App\Notifications\ExternamVNotification')
                                    <li
                                        @if ($notification->read_at == null) style="background-color:rgb(238, 173, 173)" @endif>
                                        <a href="{{ route('markAsRead', $notification->id) }} ">
                                            <h3 style="display:inline">
                                                @if ($notification->read_at != null)
                                                    ✅
                                                @else
                                                    <span class="fa fa-circle" style="color: red">
                                                    </span>
                                                @endif {{ $notification->data['from'] }}
                                            </h3>
                                            <p>
                                                {{ $notification->data['details'] }}
                                            </p>

                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="user-notification">
            <div class="dropdown" style=" left:-10%;">
                <a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
                    <span  class="hovertext" data-hover="Demandes de travaux">
                                                <i style="font-size: 2em;
                                                @if (
                                                    Auth::user()->notifications->where('type','=','App\Notifications\DtMNotification')->count()
                                                    +Auth::user()->notifications->where('type','=','App\Notifications\DtVNotification')->count()==0)
                                                    color: grey
                                                @endif
                                                "  class="fa-sharp fa-solid fa-clipboard-question   "  ></i>
                    </span>

                    <b>
                        {{ Auth::user()->notifications->where('type','=','App\Notifications\DtMNotification')->count()
                        +Auth::user()->notifications->where('type','=','App\Notifications\DtVNotification')->count() }}</b>
                    <span class="badge  "></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="notification-list ">
                        <ul>

                            <li>

                                <a href="{{ route('markAllRead') }}">
                                    <h3 style="display:inline"> Tout marquer
                                    </h3>
                                    <p>
                                        comme lu
                                    </p>

                                </a>
                            </li>
                            @foreach (Auth::user()->notifications as $notification)
                                @if ($notification->type == 'App\Notifications\DtMNotification' || $notification->type == 'App\Notifications\DtVNotification')
                                    <li
                                        @if ($notification->read_at == null) style="background-color:rgb(238, 173, 173)" @endif>
                                        <a href="{{ route('markAsRead', $notification->id) }} ">
                                            <h3 style="display:inline">
                                                @if ($notification->read_at != null)
                                                    ✅
                                                @else
                                                    <span class="fa fa-circle" style="color: red" >
                                                    </span>
                                                @endif {{ $notification->data['from'] }}
                                            </h3>
                                            <p>
                                                {{ $notification->data['details'] }}
                                            </p>

                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="dashboard-setting user-notification">
            <div class="dropdown">
                <a class="dropdown-toggle no-arrow" href="{{ route('ParkManager.profile.index') }}">
                    <span class="user-name" style="color: grey" ><b>{{ Auth::user()->username }}</b></span>
                </a>
            </div>
        </div>

        <div class="dashboard-setting user-notification">
            <div class="dropdown">
                <a class="dropdown-toggle no-arrow" href="/public"style="color: grey" >
                    <i style="font-size: 2em;"  class="dw dw-logout"style="color: grey" ></i><b> Se déconnecter</b></a>
                </a>
            </div>
        </div>










    </div>
</div>

<div class="right-sidebar">
    <div class="sidebar-title">
        <h3 class="weight-600 font-16 text-orange">
            Thème
            <span class="btn-block font-weight-400 font-12">Modifier les Paramètres</span>
        </h3>
        <div class="close-sidebar" data-toggle="right-sidebar-close">
            <i class="icon-copy ion-close-round"></i>
        </div>
    </div>
    <div class="right-sidebar-body customscroll">
        <div class="right-sidebar-body-content">
            <h4 class="weight-600 font-18 pb-10">Fond d'en-tête</h4>
            <div class="sidebar-btn-group pb-30 mb-10">
                <a href="javascript:void(0);" class="btn btn-outline-primary header-white active">Clair </a>
                <a href="javascript:void(0);" class="btn btn-outline-primary header-dark">Sombre</a>
            </div>

            <h4 class="weight-600 font-18 pb-10">Menu</h4>
            <div class="sidebar-btn-group pb-30 mb-10">
                <a href="javascript:void(0);" class="btn btn-outline-primary sidebar-light">Clair</a>
                <a href="javascript:void(0);" class="btn btn-outline-primary sidebar-dark active">Sombre</a>
            </div>

            <div class="reset-options pt-30 text-center">
                <button class="btn btn-success" id="reset-settings">
                    Réinitialiser
                </button>
            </div>
        </div>
    </div>
</div>
<style>
    a:hover {
        background-color: rgb(243, 217, 207);
    }
    .hovertext {
  position: relative;

}

.hovertext:before {
  content: attr(data-hover);
  visibility: hidden;
  opacity: 0;

  color: rgb(0, 0, 0);
  text-align: center;
  border-radius: 5px;
  padding: 5px 0;
  transition: opacity 1s ease-in-out;

  position: absolute;
  z-index: 1;
  left: 0;
  top: 110%;
}

.hovertext:hover:before {
  opacity: 1;
  visibility: visible;
}
</style>
