<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>CAMPRO @yield('title')</title>
    @yield('css_before')
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/logo-camrail.png')}}">
    <!-- Datatable css -->
    <link href="{{asset('template/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">

    <!-- Scripts -->
    <!-- Toastr -->
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('app.css') }}">
    <link href="{{asset('template/assets/libs/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('template/assets/vendor/fonts/circular-std/style.css')}}" rel="stylesheet">
    <link href="{{asset('template/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('template/assets/vendor/fonts/fontawesome/css/fontawesome-all.css')}}" rel="stylesheet">
    <!-- Toastr -->

    <link href="{{asset('template/vendor/plugins/toastr/css/toastr.min.css')}}" rel="stylesheet">
    <!-- Javascript -->
    <script src="{{ asset('app.js') }}" defer></script>

{{--    <script src="{{ asset('template/vendor/jquery/jquery.min.js') }}"></script>--}}

</head>
<body>

<!-- ============================================================== -->
<!-- main wrapper -->
<!-- ============================================================== -->
<div class="dashboard-main-wrapper">
    <!-- ============================================================== -->
    <!-- navbar -->
    <!-- ============================================================== -->
    <div class="dashboard-header">
        <nav class="navbar navbar-expand-lg bg-white fixed-top">
{{--            <a class="navbar-brand" href="../index.html">Concept</a>--}}
            <a href="/"><img class="logo-img ml-5" src="{{ asset('images/logo-camrail.png') }}" style="height: 70px" alt="logo">
            <button class="navbar-toggler text-danger" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon text-danger"><i class="fas fa-fw fa-bars"></i></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto navbar-right-top">
                    <li class="nav-item">
{{--                        <div id="custom-search" class="top-search-bar">--}}
{{--                            <input class="form-control" type="text" placeholder="Search..">--}}
{{--                        </div>--}}
                    </li>
{{--                    <li class="nav-item dropdown notification">--}}
{{--                        <a class="nav-link nav-icons" href="#" id="navbarDropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-fw fa-bell"></i> <span class="indicator"></span></a>--}}

{{--                        --}}
{{--                    </li>--}}
{{--                    <li class="nav-item dropdown connection">--}}
{{--                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-fw fa-th"></i> </a>--}}
{{--                        <ul class="dropdown-menu dropdown-menu-right connection-dropdown">--}}
{{--                            <li class="connection-list">--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">--}}
{{--                                        <a href="#" class="connection-item"><img src="../assets/images/github.png" alt="" > <span>Github</span></a>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">--}}
{{--                                        <a href="#" class="connection-item"><img src="../assets/images/dribbble.png" alt="" > <span>Dribbble</span></a>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">--}}
{{--                                        <a href="#" class="connection-item"><img src="../assets/images/dropbox.png" alt="" > <span>Dropbox</span></a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">--}}
{{--                                        <a href="#" class="connection-item"><img src="../assets/images/bitbucket.png" alt=""> <span>Bitbucket</span></a>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">--}}
{{--                                        <a href="#" class="connection-item"><img src="../assets/images/mail_chimp.png" alt="" ><span>Mail chimp</span></a>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">--}}
{{--                                        <a href="#" class="connection-item"><img src="../assets/images/slack.png" alt="" > <span>Slack</span></a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <div class="conntection-footer"><a href="#">More</a></div>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
                    <li class="nav-item dropdown nav-user">
                        <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
{{--                            <img src="../assets/images/avatar-1.jpg" alt="" class="">--}}

                            @if (!empty(Auth::user()->profile_photo_path))
                                <img src="{{ asset('images/profil/'.Auth::user()->profile_photo_path) }}"
                                     alt="Image introuvable" class="user-avatar-md rounded-circle">
                            @else
                                <i class="fas fa fa-user-circle fs-2"></i>
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                            <div class="nav-user-info">
                                <h5 class="mb-0 text-white nav-user-name">
                                    {{ Auth::user()->lastname }} {{ Auth::user()->firstname }}</h5>
                                <span class="status"></span><span class="ml-2"></span>
                            </div>
                            <a href="{{ route('user.profile') }}" class="dropdown-item">
                                <i class="fas fa-user mr-2"></i>
                                <span class="ml-2">Profil </span>
                            </a>

                            <form action="{{ route('logout') }}" method="post" id="logout-form">
                                @csrf
                                <a type="submit" class="dropdown-item" data-toggle="modal"
                                   data-target="#logoutModal">
                                    <i class="fas fa-power-off mr-2"></i>
                                    <span class="ml-2">Se déconnecter </span>
                                </a>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <!-- ============================================================== -->
    <!-- end navbar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- left sidebar -->
    <!-- ============================================================== -->
    <div class="nav-left-sidebar sidebar-dark">
        <div class="menu-list">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="d-xl-none d-lg-none" href="#">Tableau de bord</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav flex-column">
                        <li class="nav-divider">
                            Menu
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link active" href="{{  route('home') }}">
                                <i class="fab fa-fw fa-dashcube"></i>Tableau de bord </a>
                            <div id="submenu-0" class="collapse submenu">

                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1" aria-controls="submenu-1">
                                <i class="fas fa-exclamation-circle fa-fw"></i>Requêtes</a>
                            <div id="submenu-1" class="collapse submenu">
                                <ul class="nav flex-column">
                                    @if (Auth::user()->is_admin==1)
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('requette.index') }}">Gestions des requêtes</a>
                                        </li>
                                    @endif

                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('requette.mes') }}">Mes requêtes</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('requette.create') }}">Nouvelles requêtes</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        @if (Auth::user()->is_admin==1)
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2">
                                    <i class="fas fa-fw fa-table"></i>Formations</a>
                                <div id="submenu-2" class="collapse submenu">
                                    <ul class="nav flex-column">

                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('formation.index') }}">Toutes les formations</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('formation.create') }}">Ajouter une formations</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-6" aria-controls="submenu-6">
                                    <i class="fas fa-fw fa-user"></i>Fournisseur</a>
                                <div id="submenu-6" class="collapse submenu">
                                    <ul class="nav flex-column">

                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('fournisseur.index') }}">Tous les fournisseur</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('fournisseur.create') }}">Ajouter un fournisseur</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3">
                                    <i class="fa fa-fw fa-users"></i>Utilisateurs</a>
                                <div id="submenu-3" class="collapse submenu">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a href="{{ route('user.all') }}" class="nav-link">Gestions des utilisateurs</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('user.add') }}" class="nav-link">Ajouter</a>
                                        </li>
                                        <li class="nav-item">

                                        </li>
                                    </ul>
                                </div>
                            </li>
                        @endif

                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('user.profile') }}">
                                <i class="fa fa-fw fa-user-circle"></i>Profil </a>
                            <div class="collapse submenu">

                            </div>
                        </li>
                        <li class="nav-item ">

                            <button class="navbar-toggler text-danger" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon text-danger"><i class="fas fa-fw fa-bars"></i></span>
                            </button>
                            <div class="collapse submenu">

                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end left sidebar -->
    <!-- ============================================================== -->
    <!-- wrapper  -->
    <!-- ============================================================== -->
    <div class="dashboard-wrapper">
       @yield('content')
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->

           @include('_partial._modals')

        <div class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                        Copyright © 2022. Dashboard by <a href="https://colorlib.com/wp/">CAMRAIL</a>.
                    </div>

                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end footer -->
        <!-- ============================================================== -->
    </div>
</div>
<!-- ============================================================== -->
<!-- end main wrapper -->
<!-- ============================================================== -->
<!-- Optional JavaScript -->
<!-- Required vendors -->
<script src="{{ asset('template/assets/vendor/jquery/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('template/assets/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
<script src="{{ asset('template/assets/vendor/slimscroll/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('template/assets/libs/js/main-js.js') }}"></script>


{{--<script src="{{asset('template/vendor/global/global.min.js')}}"></script>--}}
{{--<script src="{{asset('template/js/quixnav-init.js')}}"></script>--}}
{{--<script src="{{asset('template/js/custom.min.js')}}"></script>--}}

{{--<script src="{{asset('template/vendor/toastr/js/toastr.min.js')}}"></script>--}}

{{--<!-- All init script -->--}}
{{--<script src="{{asset('template/js/plugins-init/toastr-init.js')}}"></script>--}}
<!-- Toastr -->
<script src="{{asset('template/vendor/plugins/toastr/js/toastr.min.js')}}"></script>
<script src="{{asset('template/vendor/plugins/toastr/js/toastr.init.js')}}"></script>
{{--<script src="{{asset('template/vendor/plugins/tooltip/popper.min.js')}}"></script>--}}
{{--<script src="{{asset('template/vendor/plugins/tooltip/tooltip.js')}}"></script>--}}
{{--<script src="{{asset('template/vendor/plugins/tooltip/popover.js')}}"></script>--}}
{{--<script src="{{asset('template/vendor/plugins/tooltip/bootstrap.bundle.min.js')}}"></script>--}}
{{--<script src="{{asset('template/vendor/plugins/tooltip/bootstrap.bundle.js')}}"></script>--}}
{{--<script src="{{asset('template/vendor/plugins/tooltip/bootstrap.js')}}"></script>--}}
{{--<script src="{{asset('template/vendor/plugins/tooltip/bootstrap.min.js')}}"></script>--}}

@include('_partial._toastr-message')
@yield('script')
{{--@include('scripts.dashboard')--}}
</body>
</html>
