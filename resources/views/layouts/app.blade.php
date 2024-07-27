<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Vora : Crypto Trading UI Admin  Bootstrap 5 Template" />
    <meta property="og:title" content="Vora : Crypto Trading UI Admin  Bootstrap 5 Template" />
    <meta property="og:description" content="Vora : Crypto Trading UI Admin  Bootstrap 5 Template" />
    <meta property="og:image" content="social-image.png" />
    <meta name="format-detection" content="telephone=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicon Icon -->
    <link rel="icon" type="image/png" sizes="16x16" href={{ asset("images/favicon.png") }}>

    <!-- Styles -->
    @stack('styles-up')
    <!-- Toastr -->
    <link rel="stylesheet" href={{ asset("vendor/toastr/css/toastr.min.css") }}>
    <link href={{ asset("vendor/bootstrap-select/dist/css/bootstrap-select.min.css") }} rel="stylesheet">
    <link href={{ asset("css/style.css") }} rel="stylesheet">
    @stack('styles')
</head>

<body>
<!--*******************
    Preloader start
********************-->
<div id="preloader">
    <div class="sk-three-bounce">
        <div class="sk-child sk-bounce1"></div>
        <div class="sk-child sk-bounce2"></div>
        <div class="sk-child sk-bounce3"></div>
    </div>
</div>
<!--*******************
    Preloader end
********************-->

<!--**********************************
    Main wrapper start
***********************************-->
<div id="main-wrapper" style="margin-left: -15px;">

    <!--**********************************
        Nav header start
    ***********************************-->
    <div class="nav-header">
        <a href="{{ route('home.index') }}" class="brand-logo">
            <div class="logo-abbr">
                <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
                     width="100%" height="58.000000pt" viewBox="0 0 58.000000 58.000000"
                     preserveAspectRatio="xMidYMid meet">

                    <g transform="translate(0.000000,58.000000) scale(0.100000,-0.100000)"
                       fill="var(--primary)" stroke="none">
                        <path d="M146 570 c-47 -15 -94 -52 -118 -95 -19 -33 -23 -59 -26 -148 -2 -59
						-1 -127 2 -151 10 -64 52 -122 110 -151 45 -23 62 -25 177 -25 119 0 130 2
						180 28 43 22 59 38 81 81 26 49 28 62 28 170 0 64 -4 131 -10 150 -14 51 -50
						97 -95 123 -35 20 -55 23 -170 25 -72 1 -143 -2 -159 -7z m106 -230 c17 -38
						34 -70 38 -70 3 0 20 32 37 70 31 70 49 84 72 56 18 -21 -81 -216 -109 -216
						-29 0 -132 206 -110 220 30 19 42 9 72 -60z"/>
                    </g>
                </svg>
            </div>
            <img class="logo-compact" src={{ asset("images/logo-text.png") }} alt="">
            <div class="brand-title">
                <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
                     width="99" height="30.000000pt" viewBox="0 0 99.000000 30.000000"
                     preserveAspectRatio="xMidYMid meet">

                    <g transform="translate(0.000000,30.000000) scale(0.100000,-0.100000)"
                       fill="#000000" stroke="none">
                        <path d="M28 289 c-10 -5 -18 -16 -18 -24 0 -8 26 -67 57 -130 54 -108 78
						-136 103 -120 11 7 112 204 124 241 5 16 0 23 -18 32 -30 13 -27 17 -82 -98
						l-41 -85 -46 98 c-25 53 -49 97 -54 97 -4 0 -16 -5 -25 -11z"/>
                        <path d="M344 210 c-57 -23 -83 -111 -46 -156 44 -55 109 -59 158 -10 51 51
						43 119 -18 156 -35 21 -60 24 -94 10z m74 -92 c6 -47 -59 -62 -73 -17 -9 27
						13 51 44 47 20 -2 27 -9 29 -30z"/>
                        <path d="M615 210 c-11 -4 -37 -5 -58 -2 l-38 5 3 -99 c3 -98 3 -99 28 -99 24
						0 25 4 30 65 l5 65 40 5 c34 4 40 9 43 31 3 29 -19 41 -53 29z"/>
                        <path d="M705 179 c-28 -35 -32 -76 -10 -118 18 -36 67 -58 98 -44 15 7 27 7
						38 0 9 -6 24 -7 33 -4 13 5 16 23 16 101 l0 94 -75 0 c-71 1 -76 -1 -100 -29z
						m100 -64 c0 -23 -5 -31 -21 -33 -30 -4 -48 21 -34 48 18 33 55 23 55 -15z"/>
                        <path d="M914 66 c-12 -31 0 -51 31 -51 27 0 30 3 30 30 0 25 -4 30 -28 33
						-17 2 -29 -2 -33 -12z"/>
                    </g>
                </svg>
            </div>
        </a>

        <div class="nav-control">
            <div class="hamburger">
                <span class="line"></span><span class="line"></span><span class="line"></span>
            </div>
        </div>
    </div>
    <!--**********************************
        Nav header end
    ***********************************-->

    <!--**********************************
        Header start
    ***********************************-->
    <div class="header">
        <div class="header-content">
            <nav class="navbar navbar-expand">
                <div class="collapse navbar-collapse justify-content-between">
                    <div class="header-left">
                        <div class="dashboard_bar">
                            CMS
                        </div>
                    </div>
{{--                    @auth()--}}
                    <ul class="navbar-nav header-right">
                        <li class="nav-item">
                            <div class="input-group search-area d-lg-inline-flex d-none">
                                <div class="input-group-append">
                                    <span class="input-group-text"><a href="javascript:void(0)"><i class="flaticon-381-search-2"></i></a></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Search here...">
                            </div>
                        </li>
                        <li class="nav-item dropdown header-profile">
                            <a class="nav-link" href="javascript:void(0)" role="button" data-bs-toggle="dropdown">
                                <img src="{{ (Auth::user()->image) ? Auth::user()->image->url() : '' }}" width="20" alt="" srcset="">
                                <div class="header-info">
                                    <span class="text-black">{{ Auth::user()->name }}</span>
                                    <p class="fs-12 mb-0">{{ Auth::user()->roles[0]->name }}</p>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="{{ route('profile.show', ['profile' => Auth::user()->id]) }}" class="dropdown-item ai-icon">
                                    <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    <span class="ms-2">Profile</span>
                                </a>
                                <a class="dropdown-item ai-icon" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
{{--                    @endauth--}}
                </div>
            </nav>
        </div>
    </div>
    <!--**********************************
        Header end ti-comment-alt
    ***********************************-->

    <!--**********************************
        Sidebar start
    ***********************************-->
    <div class="dlabnav">
        <div class="dlabnav-scroll">
            <ul class="metismenu" id="menu">
                <li>
                    <a href="{{ route('home.index') }}" class="ai-icon" aria-expanded="false">
                        <i class="flaticon-381-networking"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a class="has-arrow ai-icon" href="javascript:void(0);" aria-expanded="false">
                        <i class="flaticon-381-notepad"></i>
                        <span class="nav-text">Blog</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('posts.index') }}">Posts</a></li>
                        <li><a href="{{ route('videos.index') }}">Videos</a></li>
                        <li><a href="{{ route('podcasts.index') }}">Podcasts</a></li>
                        <li><a href="{{ route('categories.index') }}">Categories</a></li>
                        <li><a href="{{ route('tags.index') }}">Tags</a></li>
                        <li><a href="{{ route('comments.index') }}">Comments</a></li>
                    </ul>
                </li>

                <li>
                    <a class="has-arrow ai-icon" href="javascript:void(0);" aria-expanded="false">
                        <i class="flaticon-381-user-9"></i>
                        <span class="nav-text">Users</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('users.index') }}">Users</a></li>
                        <li><a href="{{ route('permissions.index') }}">Permissions</a></li>
                        <li><a href="{{ route('roles.index') }}">Roles</a></li>
                        <li><a href="{{ route('roles.permissions.index') }}">Roles in Permissions</a></li>
                    </ul>
                </li>

                <li>
                    <a class="has-arrow ai-icon" href="javascript:void(0);" aria-expanded="false">
                        <i class="flaticon-381-fingerprint"></i>
                        <span class="nav-text">Subscriptions</span>
                    </a>
                    <ul aria-expanded="false">
{{--                        <li><a href="app-profile.html">Payments</a></li>--}}
                        <li><a href="{{ route('subscriptions.index') }}">Subscriptions</a></li>
                    </ul>
                </li>

                <li>
                    <a class="has-arrow ai-icon" href="javascript:void(0);" aria-expanded="false">
                        <i class="flaticon-381-television"></i>
                        <span class="nav-text">Appearance</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="app-profile.html">Themes</a></li>
                    </ul>
                </li>

                <li>
                    <a class="has-arrow ai-icon" href="javascript:void(0);" aria-expanded="false">
                        <i class="flaticon-381-settings-2"></i>
                        <span class="nav-text">Settings</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="app-profile.html">General</a></li>
                        <li><a href="app-profile.html">Language</a></li>
                        <li><a href="app-profile.html">SEO</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
    <!--**********************************
        Sidebar end
    ***********************************-->

    <!--**********************************
        Content body start
    ***********************************-->
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>
    <!--**********************************
        Content body end
    ***********************************-->

    <!--**********************************
        Footer start
    ***********************************-->
    <div class="footer">
        <div class="copyright">
            <p>Copyright © Developed by Amgad</p>
        </div>
    </div>
    <!--**********************************
        Footer end
    ***********************************-->

    <!--**********************************
       Support ticket button start
    ***********************************-->

    <!--**********************************
       Support ticket button end
    ***********************************-->


</div>
<!--**********************************
    Main wrapper end
***********************************-->

<!--**********************************
    Scripts
***********************************-->
<!-- Required vendors -->
<script src={{ asset("vendor/global/global.min.js") }}></script>
<script src={{ asset("vendor/bootstrap-select/dist/js/bootstrap-select.min.js") }}></script>
<script src={{ asset("js/custom.min.js") }}></script>
<script src={{ asset("js/dlabnav-init.js") }}></script>
<!-- Toastr -->
<script src={{ asset("vendor/toastr/js/toastr.min.js") }}></script>
<script src={{ asset("js/plugins-init/toastr-init.js") }}></script>
@vite(['resources/js/app.js'])

<script>
    $(document).ready(function() {
        toastr.options.timeOut = 10000;
        @if (Session::has('error'))
        toastr.error('{{ Session::get('error') }}');
        @elseif(Session::has('success'))
        toastr.success("{{ Session::get('success') }}", "", {
            positionClass: "toast-bottom-right",
            timeOut: 5e3,
            closeButton: !0,
            debug: !1,
            newestOnTop: !0,
            progressBar: !0,
            preventDuplicates: !0,
            onclick: null,
            showDuration: "300",
            hideDuration: "1000",
            extendedTimeOut: "1000",
            showEasing: "swing",
            hideEasing: "linear",
            showMethod: "fadeIn",
            hideMethod: "fadeOut",
            tapToDismiss: !1
        });
        @endif
    });
</script>
@stack('scripts')

</body>

</html>
