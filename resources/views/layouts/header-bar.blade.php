<script src="https://kit.fontawesome.com/4812ff0186.js" crossorigin="anonymous"></script>
<div class="header">
    <div class="header-left">
        <div class="menu-icon bi bi-list"></div>
        <div class="search-toggle-icon bi bi-search" data-toggle="header_search"></div>

    </div>
    <div class="header-right">

        <div class="user-notification">
            <div class="dropdown" style=" left:-10%;">
                <a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
                    <i class="fa fa-bell fa-2x" aria-hidden="true"></i>
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
                    <i class="fa fa-id-card fa-2x" aria-hidden="true"></i>
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
                    <i class="fa fa-book fa-2x" aria-hidden="true"></i>
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
                    <i class="fa fa-address-book fa-2x" aria-hidden="true"></i>
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
                    <i class="fa fa-puzzle-piece fa-2x" aria-hidden="true"></i>                    <b>
                        {{ Auth::user()->notifications->where('type','=','App\Notifications\CpMNotification')->count()+
                        Auth::user()->notifications->where('type','=','App\Notifications\CpVNotification')->count() }}</b>
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
                                @if ($notification->type == 'App\Notifications\CpMNotification' ||
                                    $notification->type == 'App\Notifications\CpVNotification')
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
                    <i class="fa-solid fa-toolbox fa-2x"></i>
                    <b>
                        {{ Auth::user()->notifications->where('type','=','App\Notifications\RepairVNotification')->count()+
                        Auth::user()->notifications->where('type','=','App\Notifications\RepairMNotification')->count() }}</b>
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
                                @if ($notification->type == 'App\Notifications\RepairVNotification' ||
                                    $notification->type == 'App\Notifications\RepairMNotification')
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

                    <i class="fa-solid fa-screwdriver-wrench fa-2x"></i>
                    <b>
                        {{ Auth::user()->notifications->where('type','=','App\Notifications\MaintenaceNotification')->count() }}</b>
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
                                @if ($notification->type == 'App\Notifications\MaintenaceNotification')
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
                    <i class="fa-solid fa-car fa-2x"></i>
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

                    <i class="fa-sharp fa-solid fa-clipboard-question  fa-2x"></i>
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
                    <i class="fa-sharp fa-solid fa-shield fa-2x"></i>
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

                    <i class="fa-solid fa-square-up-right fa-2x"></i><b>
                        {{ Auth::user()->notifications->where('type','=','App\Notifications\ExternamMNotification')->count()
                        +Auth::user()->notifications->where('type','=','App\Notifications\ExternamVNotification')->count() }}</b>
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
                                @if ($notification->type == 'App\Notifications\ExternamMNotification' || $notification->type == 'App\Notifications\ExternamVNotification')
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
                    <i class="fa-solid fa-note-sticky fa-2x"></i>
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


        <div class="dashboard-setting user-notification">
            <div class="dropdown">
                <a class="dropdown-toggle no-arrow" href="#">
                    <span class="user-name">{{ Auth::user()->username }}</span>
                </a>
            </div>
        </div>

        <div class="dashboard-setting user-notification">
            <div class="dropdown">
                <a class="dropdown-toggle no-arrow" href="/">
                    <i class="dw dw-logout"></i> Se déconnecter</a>
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
</style>
