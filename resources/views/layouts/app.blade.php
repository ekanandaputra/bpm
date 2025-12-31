<!doctype html>

<html lang="{{ app()->getLocale() }}" class="layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-skin="default"
    data-assets-path="{{ asset('assets/') }}" data-template="vertical-menu-template-no-customizer" data-bs-theme="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>@yield('title', 'Clinic Medical Records')</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/iconify-icons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/node-waves/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS (optional) -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <!-- Page CSS -->
    @stack('styles')

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <aside id="layout-menu" class="layout-menu menu-vertical menu">
                <div class="app-brand demo">
                    <a href="/dashboard" class="app-brand-link">
                        <span class="app-brand-logo demo">
                            <!-- small inline svg logo could go here -->
                        </span>
                        <span class="menu-text fw-bold ms-3">Clinic MR</span>
                    </a>

                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                        <i class="icon-base ti menu-toggle-icon d-none d-xl-block"></i>
                        <i class="icon-base ti tabler-x d-block d-xl-none"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    <li class="menu-header small">
                        <span class="menu-header-text">{{ __('messages.apps_pages') }}</span>
                    </li>
                    <li class="menu-item">
                        <a href="/dashboard" class="menu-link">
                            <i class="menu-icon icon-base ti tabler-home"></i>
                            <div>{{ __('messages.dashboard') }}</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="/patients" class="menu-link">
                            <i class="menu-icon icon-base ti tabler-users"></i>
                            <div>{{ __('messages.patients') }}</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="/medications" class="menu-link">
                            <i class="menu-icon icon-base ti tabler-capsule"></i>
                            <div>{{ __('messages.medications') }}</div>
                        </a>
                    </li>
                </ul>
            </aside>

            <div class="menu-mobile-toggler d-xl-none rounded-1">
                <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large text-bg-secondary p-2 rounded-1">
                    <i class="ti tabler-menu icon-base"></i>
                    <i class="ti tabler-chevron-right icon-base"></i>
                </a>
            </div>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <nav class="layout-navbar container-xxl navbar-detached navbar navbar-expand-xl align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    <img src="{{ asset('assets/img/navbar-logos.jpeg') }}" alt="Navbar Logos" style="height:48px; margin-right:16px;">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
                            <i class="icon-base ti tabler-menu-2 icon-md"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center justify-content-end" id="navbar-collapse">
                        <form class="d-flex me-3" method="GET" action="{{ route('search.index') }}">
                            <input class="form-control form-control-sm me-2" type="search" name="q" placeholder="Search..." value="{{ request('q') }}" aria-label="Search">
                            <button class="btn btn-sm btn-outline-primary" type="submit">Search</button>
                        </form>
                        <ul class="navbar-nav flex-row align-items-center ms-md-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow p-0 me-2" href="javascript:void(0);" data-bs-toggle="dropdown">
                                    <div class="d-flex align-items-center">
                                        <span class="me-1">{{ strtoupper(app()->getLocale()) }}</span>
                                        <i class="ti tabler-chevron-down"></i>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="{{ route('locale.switch', 'en') }}">{{ __('messages.english') }}</a></li>
                                    <li><a class="dropdown-item" href="{{ route('locale.switch', 'id') }}">{{ __('messages.indonesia') }}</a></li>
                                </ul>
                            </li>
                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);"
                                    data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="rounded-circle" />
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item mt-0" href="#">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-2">
                                                    <div class="avatar avatar-online">
                                                        <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="rounded-circle" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="mb-0">{{ optional(auth()->user())->name ?? 'Admin' }}</h6>
                                                    <small class="text-body-secondary">Admin</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider my-1 mx-n2"></div>
                                    </li>
                                    <li>
                                        <div class="d-grid px-2 pt-2 pb-1">
                                            <a class="btn btn-sm btn-danger d-flex" href="/login">
                                                <small class="align-middle">{{ __('messages.logout') }}</small>
                                                <i class="icon-base ti tabler-logout ms-2 icon-14px"></i>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>
                </nav>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    @yield('content')

                    <!-- / Content -->

                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme">
                        <div class="container-xxl">
                            <div class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
                                <div class="text-body">© <script>document.write(new Date().getFullYear());</script>, {{ __('messages.clinic_mr') }}</div>
                                <div class="d-none d-lg-inline-block">
                                    <a href="#" class="footer-link me-4">{{ __('messages.license') }}</a>
                                    <a href="#" class="footer-link me-4">{{ __('messages.more_themes') }}</a>
                                </div>
                            </div>
                        </div>
                    </footer>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

            <!-- Global loading overlay -->
            <div id="global-loading" style="display:none;position:fixed;inset:0;z-index:2000;align-items:center;justify-content:center;background:rgba(255,255,255,0.75);">
                <div class="text-center">
                    <div class="spinner-border text-primary" role="status" style="width:3rem;height:3rem;">
                        <span class="visually-hidden">{{ __('messages.loading') }}</span>
                    </div>
                    <div class="mt-2">{{ __('messages.loading') }}</div>
                </div>
            </div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/node-waves/node-waves.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>

    <!-- Vendors JS (optional) -->
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script>
        (function(){
            function showLoading(){
                var el = document.getElementById('global-loading');
                if(el) el.style.display = 'flex';
            }

            function hideLoading(){
                var el = document.getElementById('global-loading');
                if(el) el.style.display = 'none';
            }

            document.addEventListener('DOMContentLoaded', function(){
                // Show on any form submit (non-ajax)
                document.addEventListener('submit', function(e){
                    try{
                        var form = e.target;
                        if(form && form.tagName === 'FORM'){
                            showLoading();
                        }
                    }catch(err){}
                }, true);

                // Show on clicks of links/buttons with class action-loading
                document.addEventListener('click', function(e){
                    try{
                        var a = e.target.closest && e.target.closest('a.action-loading, button.action-loading');
                        if(a){
                            showLoading();
                        }
                    }catch(err){}
                }, true);

                // Hide on window load (in case navigation returns here)
                window.addEventListener('load', hideLoading);
            });
        })();
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const currentUrl = window.location.pathname;
            const menuItems = document.querySelectorAll(".menu-item a");

            menuItems.forEach((link) => {
                try{
                    if (currentUrl.startsWith(link.getAttribute("href"))) {
                        link.closest(".menu-item").classList.add("active");
                    }
                }catch(e){}
            });
        });
    </script>

    <script>
        $.ajaxSetup({
            statusCode: {
                401: function() {
                    window.location.href = '/login';
                }
            }
        });
    </script>

    @stack('scripts')

</body>

</html>
