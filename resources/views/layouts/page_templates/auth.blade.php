<div class="wrapper">

    @include('layouts.navbars.auth')

    <div class="main-panel">
        @include('inc.sidebar')
        @include('inc.navbar')

        @yield('content')
        @include('layouts.footer')
    </div>
</div>
