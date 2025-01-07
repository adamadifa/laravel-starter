<!DOCTYPE html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-wide" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('/assets/') }}" data-template="vertical-menu-template-no-customizer">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>@yield('titlepage')</title>

    <meta name="description" content="" />
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <meta name="theme-color" content="#4CAF50">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('/assets/img/favicon/favicon.ico') }}" />

    @include('layouts.fonts')

    @include('layouts.icons')

    @include('layouts.styles')

    <!-- Helpers -->
    <script src="{{ asset('/assets/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('/assets/js/config.js') }}"></script>

    @laravelPWA
</head>

<body>
    <!-- Layout wrapper -->
    @php
        $agent = new Jenssegers\Agent\Agent();
    @endphp
    <div class="layout-wrapper layout-content-navbar">
        @if (!$agent->isMobile())
            <div class="layout-container">
                <!-- Sidebar -->

                @include('layouts.sidebar')

                <!-- / Sidebar-->
                <!-- Layout container -->
                <div class="layout-page">
                    <!-- Navbar -->

                    @include('layouts.navbar')

                    <!-- / Navbar -->

                    <!-- Content wrapper -->
                    <div class="content-wrapper">
                        <!-- Content -->

                        <div class="container-fluid flex-grow-1 @if (!$agent->isMobile()) container-p-y @endif ">


                            <h4 class="py-3 mb-4">@yield('navigasi')</h4>

                            @yield('content')
                        </div>
                        <!-- / Content -->

                        <!-- Footer -->
                        @include('layouts.footer')
                        <!-- / Footer -->
                        <div class="content-backdrop fade"></div>
                    </div>
                    <!-- Content wrapper -->
                </div>
                <!-- / Layout page -->
            </div>
            <!-- / Layout wrapper -->
        @else
            <div class="layout-container">
                <!-- Sidebar -->

                @include('layouts.sidebar')
                <div class="layout-page">
                    <!-- Navbar -->
                    @include('layouts.navbar')
                    <!-- / Navbar -->

                    <!-- Content wrapper -->
                    <div class="content-wrapper">
                        <div class="container-fluid flex-grow-1  ">
                            @yield('content')
                        </div>
                    </div>

                </div>


            </div>
        @endif

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->
    {{-- @if ($agent->isMobile())
        <nav class="navbar fixed-bottom navbar-light bg-white shadow d-md-none">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><i class="ti ti-user" style="font-size: 20px"></i></a>
                <a class="navbar-brand" href="#"><i class="ti ti-file-description {{ request()->is('aktifitassmm') ? 'text-primary' : '' }}"
                        style="font-size: 20px"></i></a>
                <a class="navbar-brand" href="/dashboard"><i class="fa fa-home {{ request()->is('dashboard') ? 'text-primary' : '' }}"
                        style="font-size: 25px; border-radius: 50%;"></i></a>
                <a class="navbar-brand" href="#"><i class="ti ti-mail" style="font-size: 20px"></i></a>
                <a class="navbar-brand" href="#"><i class="ti ti-help" style="font-size: 20px"></i></a>
            </div>
        </nav>
    @endif --}}
    <!-- Core JS -->
    @include('layouts.scripts')
    <!-- Page JS -->
</body>

</html>
