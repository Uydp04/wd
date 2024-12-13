<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">


<!-- Mirrored from themesbrand.com/velzon/html/master/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 29 Oct 2024 07:29:52 GMT -->

<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />

    <title>@yield('title')</title>

    @include('admins.blocks.links.css')
    @yield('CSS')
</head>

<body>
    <div id="layout-wrapper">

        @include('admins.blocks.header')

        @include('admins.blocks.siderbar')

        <div class="vertical-overlay"></div>

        <div class="main-content">
            <div class="page-content">

                @yield('content')

            </div>

            @include('admins.blocks.footer')

        </div>
    </div>

    {{-- Các đoạn script dùng chung --}}
    @include('admins.blocks.links.js')
    @yield('JS')
</body>

</html>
