<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Exception Reporter</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="{{ asset("/vendor/laravel-reporter/AdminLTE/bootstrap/css/bootstrap.min.css") }}">
    <link rel="stylesheet" href="{{ asset("/vendor/laravel-reporter/font-awesome/css/font-awesome.min.css") }}">
    <link rel="stylesheet" href="{{ asset("/vendor/laravel-reporter/AdminLTE/dist/css/skins/skin-black.min.css") }}">
    <link rel="stylesheet" href="{{ asset("/vendor/laravel-reporter/AdminLTE/dist/css/AdminLTE.min.css") }}">

    <!-- REQUIRED JS SCRIPTS -->
    <script src="{{ asset ("/vendor/laravel-reporter/AdminLTE/plugins/jQuery/jQuery-2.1.4.min.js") }}"></script>
    <script src="{{ asset ("/vendor/laravel-reporter/AdminLTE/bootstrap/js/bootstrap.min.js") }}"></script>
    <script src="{{ asset ("/vendor/laravel-reporter/AdminLTE/dist/js/app.min.js") }}"></script>
    <script src="{{ asset ("/vendor/laravel-reporter/jquery-pjax/jquery.pjax.js") }}"></script>
    <script src="{{ asset ("/vendor/laravel-reporter/code-pretty/run_prettify.js") }}"></script>

    <style>

        .prettyprint ol.linenums > li { list-style-type: decimal;background: #FFFFFF; }
        pre.prettyprint { background: #FFFFFF; border-radius: 0;margin: 10px 0 0 0;border: 0;}
        .prettyprint ol.linenums > li.active { list-style-type: decimal;background: #f5dfdf; }
        .args .name {width: 100px;}
        .args .value {color: #005384}
        .parameter .name {padding: 5px;}
        .parameter .value {padding: 5px;background-color: #f7f8f9;word-wrap: break-word; }
        .parameter dt,.parameter dd {padding: 3px;}

        .navbar-ext {border-bottom: 1px solid #d5cfdb !important;box-shadow: 0 2px 0 rgba(0,0,0,.03);margin-left:0px !important;padding-left: 30px;}

    </style>

</head>

<body class="hold-transition skin-black sidebar-mini sidebar-collapse">
<div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">
        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top navbar-ext" role="navigation">
            <div class="container" style="margin-left: 0px;margin-right: 0px;width:100%;padding-right:0px;">
                <div class="navbar-header">
                    <a href="javascript:void(0);" class="navbar-brand"><b>Laravel</b> reporter</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="/{{ config('reporter.base_uri') }}/issues">Issues <span class="sr-only">(current)</span></a></li>
                        <li><a href="javascript:void(0);">Overview</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Tasks Menu -->
                        <li class="dropdown tasks-menu">
                            <!-- Menu Toggle Button -->
                            <a href="/{{ config('reporter.base_uri') }}/auth/logout">
                                <i class="fa fa-sign-out"></i>
                            </a>
                        </li>
                    </ul>
                </div><!-- /.navbar-custom-menu -->
            </div>
        </nav>
    </header>

    <div class="content-wrapper" id="pjax-container" style="margin-left: 0px !important">
        @yield('content')
    </div>

    <!-- Main Footer -->
    <footer class="main-footer" style="margin-left: 0px !important;">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
            <strong>Version</strong>&nbsp;&nbsp; 1.0
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2016 <a href="https://github.com/z-song/laravel-reporter">laravel-reporter</a>.</strong> All rights reserved.
    </footer>
</div>

<script>

    $(document).pjax('a:not(a[target="_blank"])', '#pjax-container');

    $(document).on("pjax:popstate", function() {

        $(document).one("pjax:end", function(event) {
            $(event.target).find("script[data-exec-on-popstate]").each(function() {
                $.globalEval(this.text || this.textContent || this.innerHTML || '');
            })
        });
    });

</script>

</body>
</html>