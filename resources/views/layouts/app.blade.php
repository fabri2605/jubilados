<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Manrope" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/jquery-confirm.min.css">
    <link rel="stylesheet" type="text/css" href="/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="/css/summernote-bs4.css">
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    @stack('head-style')
    <script src="https://kit.fontawesome.com/19167aafd7.js"></script>
    <script src="{{ asset('js/app.js') }}"  ></script>
</head>
@stack('local-style')
<body>
        @include('sweetalert::alert')
        <div class="preloader">
                <div class="lds-ripple">
                    <div class="lds-pos"></div>
                    <div class="lds-pos"></div>
                </div>
            </div>
            <div id="main-wrapper">
                @if(!Auth::guest())
                <header class="topbar">
                    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                        <div class="navbar-header">
                            <!-- This is for the sidebar toggle which is visible on mobile only -->
                            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                                <i class="ti-menu ti-close"></i>
                            </a>
                            <!-- ============================================================== -->
                            <!-- Logo -->
                            <!-- ============================================================== -->
                            <a class="navbar-brand" href="{!! url('/') !!}">
                                <!-- Logo icon -->
                                <b class="logo-icon">
                                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                                    <!-- Dark Logo icon -->
                                    <img src="/assets/images/logo-chico.png" alt="homepage" class="dark-logo" />
                                    <!-- Light Logo icon -->
                                    <img src="/assets/images/logo-chico.png" alt="homepage" class="light-logo" />
                                </b>
                                <!--End Logo icon -->
                                <!-- Logo text -->
                                <span class="logo-text" style="color:#fff; font-family: 'Manrope'">
                                    
                                </span>
                            </a>
                            <!-- ============================================================== -->
                            <!-- End Logo -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- Toggle which is visible on mobile only -->
                            <!-- ============================================================== -->
                            <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent"
                                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <i class="ti-more"></i>
                            </a>
                        </div>
                        <!-- ============================================================== -->
                        <!-- End Logo -->
                        <!-- ============================================================== -->
                        <div class="navbar-collapse collapse" id="navbarSupportedContent">
                            <!-- ============================================================== -->
                            <!-- toggle and nav items -->
                            <!-- ============================================================== -->
                            <ul class="navbar-nav float-left mr-auto">
                                <li class="nav-item d-none d-md-block">
                                    <a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="full">
                                        <i class="sl-icon-menu font-20"></i>
                                    </a>
                                </li>
                                <!-- ============================================================== -->
                                <!-- Comment -->
                                <!-- ============================================================== -->
                                <li class="nav-item dropdown">
                                    
                                </li>
                                <!-- ============================================================== -->
                                <!-- End Comment -->
                                <!-- ============================================================== -->
        
                            </ul>
                            <!-- ============================================================== -->
                            <!-- Right side toggle and nav items -->
                            <!-- ============================================================== -->
                            <ul class="navbar-nav float-right">
                                <!-- ============================================================== -->
                                <!-- User profile and search -->
                                <!-- ============================================================== -->
                                <!--
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <img src="../../assets/images/users/1.jpg" alt="user" class="rounded-circle" width="31">
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                        <span class="with-arrow">
                                            <span class="bg-primary"></span>
                                        </span>
                                        <div class="d-flex no-block align-items-center p-15 bg-primary text-white m-b-10">
                                            <div class="">
                                                <img src="../../assets/images/users/1.jpg" alt="user" class="img-circle" width="60">
                                            </div>
                                            <div class="m-l-10">
                                                <h4 class="m-b-0">Steave Jobs</h4>
                                                <p class=" m-b-0">varun@gmail.com</p>
                                            </div>
                                        </div>
                                        <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="ti-user m-r-5 m-l-5"></i> My Profile</a>
                                        <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="ti-wallet m-r-5 m-l-5"></i> My Balance</a>
                                        <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="ti-email m-r-5 m-l-5"></i> Inbox</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="ti-settings m-r-5 m-l-5"></i> Account Setting</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
                                        <div class="dropdown-divider"></div>
                                        <div class="p-l-30 p-10">
                                            <a href="javascript:void(0)" class="btn btn-sm btn-success btn-rounded">View Profile</a>
                                        </div>
                                    </div>
                                </li>!-->
                                <!-- ============================================================== -->
                                <!-- User profile and search -->
                                <!-- ============================================================== -->
                            </ul>
                        </div>
                    </nav>
                </header>
                @endif
                @if(!Auth::guest()) 
                    <aside class="left-sidebar">
                    <!-- Sidebar scroll-->
                    <div class="scroll-sidebar">
                        <!-- Sidebar navigation-->
                        <nav class="sidebar-nav">
                            <ul id="sidebarnav">
                                <!-- User Profile-->
                                <li>
                                    <!-- User Profile-->
                                    <div class="user-profile dropdown m-t-20">
                                        <div class="user-pic">
                                            <i class="ti-user m-r-8 m-l-8 cblanco"></i> </a>
                                        </div>
                                        <div class="user-content hide-menu m-t-10">
                                            <h5 class="m-b-10 user-name font-medium">{{Auth::user()->name}}</h5>
                                        <a href="{!! url('/logout') !!}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                            title="Cerrar Sesión" class="btn btn-circle btn-sm">
                                                <i class="ti-power-off"></i>
                                            </a>
                                        </div>
                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </div>
                                    <!-- End User Profile-->
                                </li>
                                @if(Auth::user()->hasRoles(['admin','user']))
                                    <li class="sidebar-item">
                                        <a class="sidebar-link  waves-effect waves-dark" href="{{route('turnos.index')}}" aria-expanded="false">
                                            <i class="fas fa-calendar-check"></i>
                                            <span class="hide-menu">Turnos </span>
                                        </a>
                                    </li>
                                @endif
                                @if(Auth::user()->hasRoles(['admin']))
                                    <li class="sidebar-item">
                                        <a class="sidebar-link  waves-effect waves-dark" href="{{route('oficina.index')}}" aria-expanded="false">
                                            <i class="fas fa-building"></i>
                                            <span class="hide-menu">Oficinas UGS </span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a class="sidebar-link  waves-effect waves-dark" href="{{route('dias.index')}}" aria-expanded="false">
                                            <i class="fas fa-calendar-times"></i>
                                            <span class="hide-menu">Dias Especiales </span>
                                        </a>
                                    </li>
                                @endif
                                @if(Auth::user()->hasRoles(['admin','user']))
                                    <li class="sidebar-item">
                                        <a class="sidebar-link  waves-effect waves-dark" href="{{route('solicitudes.index')}}" aria-expanded="false">
                                            <i class="far fa-file-alt"></i>
                                            <span class="hide-menu">Solicitudes </span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a class="sidebar-link  waves-effect waves-dark" href="{{route('enviados.index')}}" aria-expanded="false">
                                            <i class="fas fa-paper-plane"></i>
                                            <span class="hide-menu">Registros Enviados </span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a class="sidebar-link  waves-effect waves-dark" href="{{route('solicitudes_san_rafael.index')}}" aria-expanded="false">
                                            <i class="fas fa-file"></i>
                                            <span class="hide-menu">Solicitudes San Rafael </span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a class="sidebar-link  waves-effect waves-dark" href="{{route('enviado_san_rafael.index')}}" aria-expanded="false">
                                            <i class="fas fa-paper-plane"></i>
                                            <span class="hide-menu">Enviados San Rafael </span>
                                        </a>
                                    </li>
                                @endif
                                @if(Auth::user()->hasRoles(['admin']))
                                    <li class="sidebar-item sitem">
                                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                            <i class="mdi mdi-settings"></i>
                                            <span class="hide-menu">Configuración </span>
                                        </a>
                                        <ul aria-expanded="false" class="collapse first-level">
                                            <li class="sidebar-item sitem">
                                                <a href="{{route('users.index')}}" class="sidebar-link">
                                                    <i class="mdi mdi-account-multiple-plus icon-v"></i>
                                                    <span class="hide-menu"> Administrar Usuario </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                @endif
                               
                               
                            </ul>
                        </nav>
                        <!-- End Sidebar navigation -->
                    </div>
                    <!-- End Sidebar scroll-->
                    </aside>
                @endif
                <!-- ============================================================== -->
                <div class="page-wrapper">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                    <footer class="footer text-center">
                       Todos los derechos reservados CupStudio. Desarrollado por <b class="cprimario">Cup Studio</b>
                    </footer>
                </div>
            </div>
            
    <script src="/libs/jquery.min.js" ></script>
    <script src="/js/popper.min.js" ></script>
    <script src="/js/bootstrap.min.js" ></script>
    <script src="/js/jquery-confirm.min.js"></script>
    <script src="/sitio/assets/js/input.js"></script>
    <script src="/js/messages.js"></script> 
    <script src="/js/admin.js" ></script>
    <script src="/js/app.init.js" ></script>
    <script src="/js/app-style-switcher.js" ></script>
    <script src="/libs/perfect-scrollbar.jquery.min.js" ></script>
    <script src="/libs/sparkline.js" ></script>
    <script src="/js/waves.js" ></script>
    <script src="/js/sidebarmenu.js" ></script>
    <script src="/js/custom.min.js" ></script>
    <script src="/js/jquery.dataTables.min.js"></script>
    <script src="/js/select2.min.js"></script>
    <script src="/js/summernote-bs4.min.js"></script>
    <script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gijgo/1.9.13/combined/js/messages/messages.es-es.min.js"></script>
    @stack('scripts')
</body>
</html>
