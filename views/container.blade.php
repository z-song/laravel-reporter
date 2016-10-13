<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Exception Reporter</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="{{ asset("/packages/admin/AdminLTE/bootstrap/css/bootstrap.min.css") }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset("/packages/admin/font-awesome/css/font-awesome.min.css") }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset("/packages/admin/AdminLTE/dist/css/skins/skin-black.min.css") }}">
    <link rel="stylesheet" href="{{ asset("/packages/admin/AdminLTE/dist/css/AdminLTE.min.css") }}">

    <!-- REQUIRED JS SCRIPTS -->
    <script src="{{ asset ("/packages/admin/AdminLTE/plugins/jQuery/jQuery-2.1.4.min.js") }}"></script>
    <script src="{{ asset ("/packages/admin/AdminLTE/bootstrap/js/bootstrap.min.js") }}"></script>
    <script src="{{ asset ("/packages/admin/AdminLTE/dist/js/app.min.js") }}"></script>
    <script src="{{ asset ("/packages/admin/jquery-pjax/jquery.pjax.js") }}"></script>

    <script src="{{ asset ("/packages/admin/code-pretty/run_prettify.js") }}"></script>

    <style>

        .prettyprint ol.linenums > li { list-style-type: decimal;background: #FFFFFF; }
        pre.prettyprint { background: #FFFFFF; border-radius: 0;margin: 10px 0 0 0;border: 0;}
        .prettyprint ol.linenums > li.active { list-style-type: decimal;background: #f5dfdf; }

    </style>

</head>

<body class="hold-transition skin-black sidebar-mini sidebar-collapse">
<div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

        <!-- Logo -->

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle">
                            <!-- The user image in the navbar-->

                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs"><i class="fa fa-sign-out"></i>&nbsp;&nbsp;logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
    </aside>

    <div class="content-wrapper" id="pjax-container">
        @yield('content')
    </div>

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
            <strong>Version</strong>&nbsp;&nbsp; 1.0
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2016 <a href="https://github.com/z-song/laravel-reporter">laravel-reporter</a>.</strong> All rights reserved.
    </footer>
</div>



<script>

    $(function () {

        var highlightLine = function () {
            $('pre.prettyprint').each(function (index, pre) {
                var active_line = $(pre).data('active');
                var start_line = $(pre).data('start-line');

                var $active = $(pre).find('li:eq('+ (active_line-start_line) +')').addClass('active');
            });
        };

        setTimeout(function () {
            highlightLine();
        }, 500);
    });

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