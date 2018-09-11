<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8"/>
    <title>@yield('title') - Portal do Clientes - Gyra+</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>

    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/plugins/ionicons/css/ionicons.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/animate.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/style.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/style-responsive.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/theme/default.css') }}" rel="stylesheet" id="theme"/>
    <!-- ================== END BASE CSS STYLE ================== -->

    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="{{ asset('assets/plugins/jquery-jvectormap/jquery-jvectormap.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/gritter/css/jquery.gritter.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/social-buttons.css') }}" rel="stylesheet" >
    <!-- ================== END PAGE LEVEL STYLE ================== -->

    <!-- ================== BEGIN CUSTOM CSS STYLE ================== -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <!-- ================== END STOM CSS STYLE ================== -->

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="{{ asset('assets/plugins/pace/pace.min.js') }}"></script>
    <!-- ================== END BASE JS ================== -->
    @yield('afterStyles')
</head>
@yield('body')
<!-- ================== BEGIN BASE JS ================== -->
<script src="{{ asset('assets/plugins/jquery/jquery-1.9.1.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery/jquery-migrate-1.1.0.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<!--[if lt IE 9]>
<script src="{{ asset('assets/crossbrowserjs/html5shiv.js') }}"></script>
<script src="{{ asset('assets/crossbrowserjs/respond.min.js') }}"></script>
<script src="{{ asset('assets/crossbrowserjs/excanvas.min.js') }}"></script>
<![endif]-->
<script src="{{ asset('assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-cookie/jquery.cookie.js') }}"></script>
<!-- ================== END BASE JS ================== -->

<script src="{{ asset('js/scs/social-buttons/config.js') }}"></script>

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="{{ asset('assets/plugins/gritter/js/jquery.gritter.js') }}"></script>
<script src="{{ asset('assets/plugins/flot/jquery.flot.min.js') }}"></script>
<script src="{{ asset('assets/plugins/flot/jquery.flot.time.min.js') }}"></script>
<script src="{{ asset('assets/plugins/flot/jquery.flot.resize.min.js') }}"></script>
<script src="{{ asset('assets/plugins/flot/jquery.flot.pie.min.js') }}"></script>
<script src="{{ asset('assets/plugins/sparkline/jquery.sparkline.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-jvectormap/jquery-jvectormap.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('assets/js/dashboard.min.js') }}"></script>
<script src="{{ asset('assets/js/apps.min.js') }}"></script>
<script src="{{ asset('assets/plugins/isotope/jquery.isotope.min.js') }}"></script>
<script src="{{ asset('assets/plugins/lightbox/js/lightbox.min.js') }}"></script>
<script src="{{ asset('assets/js/gallery.demo.min.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.6.5/angular.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.6.5/angular-animate.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.6.5/angular-sanitize.js"></script>
<script src="//angular-ui.github.io/bootstrap/ui-bootstrap-tpls-2.5.0.js"></script>
<script src="{{ asset('js/angular/global.js') }}"></script>
<!-- ================== END PAGE LEVEL JS ================== -->

@yield('afterScripts')
<script>
    $(document).ready(function () {
        App.init();
        Gallery.init();
    });
</script>
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

@yield('scripts')

</html>
