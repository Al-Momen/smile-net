<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="apple-touch-icon" href="{{ asset('/app-assets/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/app-assets/images/ico/favicon.ico') }}">
    <link rel="icon" href="{{ URL::asset('assets/frontend/images/logo/fav.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('images/logoIcon/favicon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ getImage(imagePath()['logoIcon']['path'] . '/favicon.png') }}"
        type="image/x-icon">
    {{-- tosar css
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" /> --}}

    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700"
        rel="stylesheet">
    <input type="hidden" name="base_url" id="base_url" value="{{ url('/') }}">
    @include('admin.layout.includes.css')
    @yield('css')
    @stack('css')
</head>
<!-- END: Head-->

<body>
    @php
        $roles = userRolePermissionArray();
    @endphp
    <!-- BEGIN: Header-->
    <!--~~~~~~Start Page-wrapper~~~~~~~~-->
    <div class="page-wrapper">
        <div class="sidebar">
            <button class="res-sidebar-close-btn">
                <i class="las la-times"></i>
            </button>
            <div class="sidebar__inner">
                <div class="sidebar__logo">
                    <a href="{{ route('index') }}" class="sidebar__main-logo">
                        <img src="{{ getImage(imagePath()['logoIcon']['path'] . '/whiteLogo.png', '?' . time()) }}"
                            white-img="{{ getImage(imagePath()['logoIcon']['path'] . '/whiteLogo.png', '?' . time()) }}"
                            dark-img="{{ getImage(imagePath()['logoIcon']['path'] . '/whiteLogo.png', '?' . time()) }}"
                            alt="logo">
                    </a>
                    <a href="{{ route('admin.dashboard') }}" class="sidebar__logo-shape">
                        <img src="{{ getImage(imagePath()['logoIcon']['path'] . '/whiteLogo.png', '?' . time()) }}"
                            alt="logo">
                    </a>
                </div>
                @include('admin.layout.left_sidebar')
            </div>
        </div>
        <div class="main-wrapper">
            <div class="main-body-wrapper">
                <!-- navbar-wrapper-start -->
                @include('admin.layout.top_nav')
                <!-- body-wrapper-start -->
                <div class="body-wrapper">
                    @include('admin.layout.flash')
                    @yield('content')
                </div>
            </div>
            <!-- copyright-wrapper-start -->
            @include('admin.layout.footer')

        </div>
    </div>

    <!-- BEGIN: Footer-->

    <!-- END: Footer-->
    @include('partials.notify')
    @include('admin.layout.includes.js')
    {{-- @include('admin.layout.includes.home_js') --}}
    @yield('scripts')
    @stack('js')
    <script>
        "use strict";
        bkLib.onDomLoaded(function() {
            $(".nicEdit").each(function(index) {
                $(this).attr("id", "nicEditor" + index);
                new nicEditor({
                    fullPanel: true
                }).panelInstance('nicEditor' + index, {
                    hasPanel: true
                });
            });
        });
        (function($) {
            $(document).on('mouseover ', '.nicEdit-main,.nicEdit-panelContain', function() {
                $('.nicEdit-main').focus();
            });
            // Menu Active Code
            var menu_link_item = $('.sidebar-menu-item');
            $.each(menu_link_item, function(index, item) {
                if ($(item).hasClass('active')) {
                    if ($(item).parents('.sidebar-dropdown')) {
                        $(item).parents('.sidebar-dropdown').addClass('active');
                        if ($(item).parents('.sidebar-dropdown').find('.sidebar-submenu')) {
                            $(item).parents('.sidebar-dropdown').find('.sidebar-submenu').addClass('active');
                            $(item).parents('.sidebar-dropdown').find('.sidebar-submenu').slideDown(300);
                        }
                    }
                }
            });
        })(jQuery);
    </script>
</body>


<!-- END: Body-->

</html>
