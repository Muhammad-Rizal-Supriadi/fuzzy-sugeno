<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title')</title>
    <link href="{{asset('public/assets/template/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/assets/template/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('public/assets/template/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('public/assets/template/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('public/assets/plugin/datatables/datatables.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/assets/corelib/ajax.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('public/assets/corelib/datepicker/datepicker3.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('public/assets/plugin/select2/select2.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('public/assets/template/css/plugins/summernote/summernote.css')}}" rel="stylesheet">
    <link href="{{asset('public/assets/template/css/plugins/summernote/summernote-bs3.css')}}" rel="stylesheet">
    <link href="{{asset('public/assets/template/css/plugins/jasny/jasny-bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('public/assets/plugin/datatables/datatables.min.css')}}" rel="stylesheet">
    <style>
        body::-webkit-scrollbar {
            width: 0.5em;
        }

        body::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
        }

        body::-webkit-scrollbar-thumb {
            background-color: #e67e22;
            outline: 1px solid slategrey;
        }
    </style>
    @yield('style')

</head>

<body class="body-small pace-done skin-3">
<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="{{asset('public/assets/template/img/a4.jpg')}}" width="60" height="60" />
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">Admin</strong>
                             </span> <span class="text-muted text-xs block"> Admin<b class="caret"></b></span> </span> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="#">Profile</a></li>
                            <li class="divider"></li>
                            <li><a href="{{url('/logout')}}">Logout</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        <i class="fa fa-globe" style="font-size: 30px"></i>
                    </div>
                </li>
                @include('layout.menu')
            </ul>

        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                    <form role="search" class="navbar-form-custom" action="">
                        <div class="form-group">
                            <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                        </div>
                    </form>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <span class="m-r-sm text-muted welcome-message">Welcome to Sistem Pakar</span>
                        </li>



                        <li>
                            <a href="{{url('/logout')}}">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                        </li>
                    </ul>
                </ul>

            </nav>
        </div>


        @yield('content')

        <div class="footer">
            <div class="pull-right">
                CV. <strong>Wellcore</strong>
            </div>
            <div>
                <strong>Copyright </strong>Aplikasi Sistem Pakar &copy; 2018 - present
            </div>
        </div>
    </div>


    <!-- Mainly scripts -->
    <script src="{{asset('public/assets/template/js/jquery-3.1.1.min.js')}}"></script>
    <script src="{{asset('public/assets/template/js/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="{{asset('public/assets/template/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/assets/template/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
    <script src="{{asset('public/assets/template/js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('public/assets/template/js/plugins/summernote/summernote.min.js')}}"></script>




    <!-- Select2 -->
    <script src="{{asset('public/assets/plugin/select2/select2.full.min.js')}}"></script>

    <!-- Flot -->
    <script src="{{asset('public/assets/template/js/plugins/flot/jquery.flot.js')}}"></script>
    <script src="{{asset('public/assets/template/js/plugins/flot/jquery.flot.tooltip.min.js')}}"></script>
    <script src="{{asset('public/assets/template/js/plugins/flot/jquery.flot.spline.js')}}"></script>
    <script src="{{asset('public/assets/template/js/plugins/flot/jquery.flot.resize.js')}}"></script>
    <script src="{{asset('public/assets/template/js/plugins/flot/jquery.flot.pie.js')}}"></script>
    <script src="{{asset('public/assets/template/js/plugins/flot/jquery.flot.symbol.js')}}"></script>
    <script src="{{asset('public/assets/template/js/plugins/flot/jquery.flot.time.js')}}"></script>
    <script src="{{asset('public/assets/template/js/plugins/jasny/jasny-bootstrap.min.js')}}"></script>


    <!-- jQuery UI -->



    <input type='hidden' name='_token' value='{{ csrf_token() }}'>


    <script src="{{ asset('public/assets/plugin/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugin/iCheck/icheck.min.js') }}"></script>


    <!-- Custom and plugin javascript -->
    <script src="{{asset('public/assets/template/js/inspinia.js')}}"></script>
    <script src="{{asset('public/assets/template/js/plugins/pace/pace.min.js')}}"></script>
    <script src="{{asset('public/assets/corelib/core.js')}}"></script>
    <!-- Datepicker -->
    <script src="{{asset('public/assets/corelib/datepicker/bootstrap-datepicker.js')}}"></script>

    <!--Datatable -->
    <script src="{{asset('public/assets/plugin/datatables/datatables.min.js')}}"></script>

    <script>
        baseURL = '{{url("/")}}';
    </script>

@yield('scripts')

</body>
</html>
