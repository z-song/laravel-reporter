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
    <link rel="stylesheet" href="{{ asset("/vendor/laravel-reporter/AdminLTE/dist/css/skins/skins.min.css") }}">
    <link rel="stylesheet" href="{{ asset("/vendor/laravel-reporter/AdminLTE/dist/css/AdminLTE.min.css") }}">
    <link rel="stylesheet" href="{{ asset("/vendor/laravel-reporter/prism/prism.css") }}">

    <!-- REQUIRED JS SCRIPTS -->
    <script src="{{ asset ("/vendor/laravel-reporter/AdminLTE/plugins/jQuery/jQuery-2.1.4.min.js") }}"></script>
    <script src="{{ asset ("/vendor/laravel-reporter/AdminLTE/bootstrap/js/bootstrap.min.js") }}"></script>
    <script src="{{ asset ("/vendor/laravel-reporter/AdminLTE/dist/js/app.min.js") }}"></script>
    <script src="{{ asset ("/vendor/laravel-reporter/jquery-pjax/jquery.pjax.js") }}"></script>
    {{--<script src="{{ asset ("/vendor/laravel-reporter/code-pretty/run_prettify.js") }}"></script>--}}
    <script src="{{ asset ("/vendor/laravel-reporter/prism/prism.js") }}"></script>

    <style>

        h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
            font-family: 'Source Sans Pro',sans-serif;
        }

        .main-header {
            position: relative;
            max-height: 100px;
            z-index: 1030;
            display: block;
            background-color: #fff;
        }

        .main-header>.navbar {
            -webkit-transition: margin-left .3s ease-in-out;
            -o-transition: margin-left .3s ease-in-out;
            transition: margin-left .3s ease-in-out;
            margin-bottom: 0;
            margin-left: 230px;
            border: none;
            min-height: 50px;
            border-radius: 0;
        }

        .main-header .navbar-brand {
            margin-left: -15px;
            color: #3c8dbc;
        }

        .content {
            min-height: 250px;
            padding: 15px;
            margin-right: auto;
            margin-left: auto;
            padding-left: 15px;
            padding-right: 15px;
        }

        .content-wrapper, .right-side {
            min-height: 100%;
            background-color: #fff;
            z-index: 800;
        }

        .box {
            position: relative;
            border-radius: 3px;
            background: #ffffff;
            border-top: 3px solid #d2d6de;
            margin-bottom: 20px;
            width: 100%;
            box-shadow: 0 1px 1px rgba(0,0,0,0.1);
        }

        .box.box-solid {
            border-top: 0;
        }

        .box-header {
            color: #444;
            display: block;
            padding: 10px;
            position: relative;
        }

        .box-header.with-border {
            border-bottom: 1px solid #f4f4f4;
        }

        .box-header .box-title {
            display: inline-block;
            font-size: 18px;
            margin: 0;
            line-height: 1;
        }

        .box-header>.box-tools {
            position: absolute;
            right: 10px;
            top: 5px;
        }

        .has-feedback {
            position: relative;
        }

        .box-body {
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            border-bottom-right-radius: 3px;
            border-bottom-left-radius: 3px;
            padding: 10px;
        }

        .box-footer {
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            border-bottom-right-radius: 3px;
            border-bottom-left-radius: 3px;
            border-top: 1px solid #f4f4f4;
            padding: 10px;
            background-color: #fff;
        }

        .no-padding {
            padding: 0 !important;
        }

        .no-margin {
            margin: 0 !important;
        }

        .mailbox-controls {
            padding: 5px;
        }

        .args .name {width: 100px;}
        .args .value {color: #005384}

        .navbar-ext {border-bottom: 1px solid #d5cfdb !important;box-shadow: 0 2px 0 rgba(0,0,0,.03);margin-left:0px !important;padding-left: 30px;}

        .browser-window {
            text-align: left;
            display: inline-block;
            border-radius: 4px;
            background-color: #fff;
            border: 1px solid #ddd;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .1);
            overflow: hidden;
            width: 100%;
        }

        .browser-window .top-bar {
            height: 30px;
            border-radius: 4px 4px 0 0;
            border-top: thin solid #eaeae9;
            border-bottom: thin solid #dfdfde;
            background: #ebebeb;
        }

        .browser-window .window-content pre[class*=language-] {
            background: #fff;
            margin: 0;
            border: 0px;
        }

        .browser-window .circles {
            margin: 1px 10px;
        }

        .browser-window .circle {
            height: 8px;
            width: 8px;
            display: inline-block;
            border-radius: 50%;
            background-color: #fff;
            margin-left: 5px;
        }

        .browser-window .circle-red {
            background-color: rgba(252, 97, 92, 1);
        }

        .browser-window .circle-yellow {
            background-color: rgba(253, 189, 65, 1);
        }

        .browser-window .circle-green {
            background-color: rgba(52, 200, 74, 1);
        }

    </style>

</head>

<body>
<div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">
        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top navbar-ext" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <a href="javascript:void(0);" class="navbar-brand"><b>Laravel</b> reporter</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active small"><a href="/{{ config('reporter.base_uri') }}/issues">Exceptions <span class="sr-only">(current)</span></a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
                <!-- Navbar Right Menu -->
            </div>
        </nav>
    </header>

    <div class="content-wrapper" id="pjax-container" style="width:1170px; margin-left: auto !important; margin-right: auto !important;">
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