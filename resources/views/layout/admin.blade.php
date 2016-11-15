de<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>@yield('title')</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{asset('css/admin.css')}}" rel="stylesheet" />
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="orange">

        <!--

            Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
            Tip 2: you can also add an image using data-image tag

        -->

        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="http://www.facebook.com/nhathuycn13" class="simple-text">
                    In1 Application
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="{{route('getDashboard')}}">
                        <i class="fa fa-check"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href="{{route('typeManagement')}}">
                        <i class="fa fa-check"></i>
                        <p>Product Type</p>
                    </a>
                </li>
                <li>
                    <a href="{{route('manufacturerManagement')}}">
                        <i class="fa fa-check"></i>
                        <p>Manufacturer</p>
                    </a>
                </li>
                <li>
                    <a href="{{route('supplierManagement')}}">
                        <i class="fa fa-check"></i>
                        <p>Supplier</p>
                    </a>
                </li>
                <li>
                    <a href="{{route('customerManagement')}}">
                        <i class="fa fa-check"></i>
                        <p>Customer</p>
                    </a>
                </li>
                <li>
                    <a href="{{route('productManagement')}}">
                        <i class="fa fa-check"></i>
                        <p>Product</p>
                    </a>
                </li>

                {{--@can('user-management')--}}
                {{--<li>--}}
                    {{--<a href="{{route('userManagement')}}">--}}
                        {{--<i class="fa fa-check"></i>--}}
                        {{--<p>User Manager</p>--}}
                    {{--</a>--}}
                {{--</li>--}}
                    {{--<li>--}}
                        {{--<a href="{{route('roleManagement')}}">--}}
                            {{--<i class="fa fa-check"></i>--}}
                            {{--<p>Role Manager</p>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                {{--@endcan--}}
            </ul>
            <hr>
        </div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Dashboard</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                {{\Illuminate\Support\Facades\Auth::user()->name}}
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="{{route('postLogout')}}">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div id="app">
                    @yield('content')
                </div>
            </div>
        </div>


        <footer class="footer">
            <div class="container-fluid">
                <p class="copyright pull-right">
                    &copy; 2016 <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
                </p>
            </div>
        </footer>

    </div>
</div>


</body>
@stack('script')
<script src="{{asset('js/admin.js')}}" type="text/javascript"></script>
</html>
