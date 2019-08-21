<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Admin Dasboard</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/css/icon.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/sweetalert2.css') }}" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{ asset('backend/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ asset('backend/plugins/node-waves/waves.css') }}" rel="stylesheet" />

    <link href="{{ asset('backend/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet">

    <!-- Animation Css -->
    <link href="{{ asset('backend/plugins/animate-css/animate.css') }}" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="{{ asset('backend/plugins/morrisjs/morris.css') }}" rel="stylesheet" />

    <link href="{{ asset('backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">

    <!-- Custom Css -->
    <link href="{{ asset('backend/css/style.css') }}" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{ asset('backend/css/themes/all-themes.css') }}" rel="stylesheet" />
</head>

<body class="theme-blue">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="#">Blog System In Laravel</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                    <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
                    
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="{{ asset('backend/images/user.png') }}" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</div>
                    <div class="email">{{ Auth::user()->email }}</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="{{ route('admin.settings') }}"><i class="material-icons">person</i>Profile</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a  href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form> </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    @if(Request::is('admin*'))
                        <li class="{{ Request::is('admin/deshboard') ? 'active' : '' }}">
                            <a href="{{ route('admin.dashboard') }}">
                                <i class="material-icons">dashboard</i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('admin/tag*') ? 'active' : '' }}">
                            <a href="{{ route('admin.tag.index') }}">
                                <i class="material-icons">label</i>
                                <span>Tag</span>
                            </a>
                        </li>

                        <li class="{{ Request::is('admin/category*') ? 'active' : '' }}">
                            <a href="{{ route('admin.category.index') }}">
                                <i class="material-icons">apps</i>
                                <span>Category</span>
                            </a>
                        </li>

                        <li class="{{ Request::is('admin/post*') ? 'active' : '' }}">
                            <a href="{{ route('admin.post.index') }}">
                                <i class="material-icons">library_books</i>
                                <span>Posts</span>
                            </a>
                        </li>

                        <li class="{{ Request::is('admin/pending/post') ? 'active' : '' }}">
                            <a href="{{ route('admin.post.pending') }}">
                                <i class="material-icons">library_books</i>
                                <span>Pending Post</span>
                            </a>
                        </li>

                        <li class="{{ Request::is('admin/subscriber') ? 'active' : '' }}">
                            <a href="{{ route('admin.subscriber.index') }}">
                                <i class="material-icons">subscriptions</i>
                                <span>Subscribers Email</span>
                            </a>
                        </li>
                    @endif

                    @if(Request::is('author*'))
                        <li class="{{ Request::is('author/deshboard') ? 'active' : '' }}">
                            <a href="{{ route('author.dashboard') }}">
                                <i class="material-icons">dashboard</i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="{{ Request::is('author/post*') ? 'active' : '' }}">
                            <a href="{{ route('author.post.index') }}">
                                <i class="material-icons">library_books</i>
                                <span>Posts</span>
                            </a>
                        </li>

                    @endif
                        
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2016 - 2017 <a href="javascript:void(0);">AdminBSB - Material Design</a>.
                </div>
                <div class="version">
                    <b>Version: </b> 1.0.5
                </div>
            </div>
            <!-- #Footer -->
        </aside>
    </section>

    @yield('content')

    <!-- Jquery Core Js -->
    <script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.js') }}"></script>

    <!-- Select Plugin Js -->
    <script src="{{ asset('backend/lugins/bootstrap-select/js/bootstrap-select.js') }}"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="{{ asset('backend/plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{ asset('backend/plugins/node-waves/waves.js') }}"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="{{ asset('backend/plugins/jquery-countto/jquery.countTo.js') }}"></script>

    <!-- Morris Plugin Js -->
    <script src="{{ asset('backend/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/morrisjs/morris.js') }}"></script>

    <script src="{{ asset('backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>

    <!-- ChartJs -->
    <script src="{{ asset('backend/plugins/chartjs/Chart.bundle.js') }}"></script>

    <!-- Flot Charts Plugin Js -->
    <script src="{{ asset('backend/plugins/flot-charts/jquery.flot.js') }}"></script>
    <script src="{{ asset('backend/plugins/flot-charts/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('backend/plugins/flot-charts/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('backend/plugins/flot-charts/jquery.flot.categories.js') }}"></script>
    <script src="{{ asset('backend/plugins/flot-charts/jquery.flot.time.js') }}"></script>


    <script src="{{ asset('backend/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <!-- Sparkline Chart Plugin Js -->
    <script src="{{ asset('backend/plugins/jquery-sparkline/jquery.sparkline.js') }}"></script>

    <!-- Custom Js -->
    <script src="{{ asset('backend/js/admin.js') }}"></script>
    <script src="{{ asset('backend/js/pages/index.js') }}"></script>
    <script src="{{ asset('backend/js/pages/tables/jquery-datatable.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.all.js') }}"></script>
    <!-- Demo Js -->
    <script src="{{ asset('backend/js/demo.js') }}"></script>

</body>

</html>
