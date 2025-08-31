<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>@yield('title')</title>
    <!-- Icons. Uncomment required icon fonts -->
    {{-- <link rel="stylesheet" href="{{ asset('./assets/vendor/fonts/boxicons.css') }}" /> --}}
    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('./assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('./assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('./assets/css/demo.css') }}" />
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('./assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('./assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <!-- Helpers -->
    <script src="{{ asset('./assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('./assets/js/config.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />

    <script src="https://kit.fontawesome.com/b1f3e48a93.js" crossorigin="anonymous"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">


</head>

<body>

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar  ">
        <div class="layout-container">
            <!-- Menu -->
            @include('admin.layout.sidebar')
            <!-- / Menu -->
            <!-- Layout container -->
            <div class="layout-page">
                @include('admin.layout.header')
                <!-- Content wrapper -->
                <div class="content-wrapper">
                    @yield('content')
                    <!-- Footer -->
                    @include('admin.layout.footer')
                    <!-- / Footer -->
                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>
        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('./assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('./assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('./assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('./assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('./assets/vendor/js/menu.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    {{-- <script src="{{ asset('./assets/vendor/libs/apex-charts/apexcharts.js') }}"></script> --}}

    <!-- Main JS -->
    <script src="{{ asset('./assets/js/main.js') }}"></script>

    {{-- <!-- Page JS --> --}}
    <script src="{{ asset('./assets/js/dashboards-analytics.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>
@stack('script')

</html>
