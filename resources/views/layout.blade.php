<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" ng-app="MyApp">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <meta name="csrf-token" content="{{ csrf_token()}}">
        <title>{{ trans('app.app_name')}} | @yield('title')</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <meta content="" name="description" />
        <meta content="" name="author" />


        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css">
        <link href="{{ url('/')}}/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="{{ url('/')}}/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css">
        <link href="{{ url('/')}}/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="{{ url('/')}}/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css">
        <!-- END GLOBAL MANDATORY STYLES -->

        <!-- BEGIN PAGE LEVEL STYLES -->
        @yield('styles')
        <!-- END PAGE LEVEL STYLES -->

        <!-- BEGIN THEME STYLES -->
        <link href="{{ url('/')}}/assets/global/css/components-rounded.css" id="style_components" rel="stylesheet" type="text/css">
        <link href="{{ url('/')}}/assets/global/css/plugins.css" rel="stylesheet" type="text/css">
        <link href="{{ url('/')}}/assets/admin/layout3/css/layout.css" rel="stylesheet" type="text/css">
        <link href="{{ url('/')}}/assets/admin/layout3/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color">
        <link href="{{ url('/')}}/assets/admin/layout3/css/custom.css" rel="stylesheet" type="text/css">
        <!-- END THEME STYLES -->

        <link rel="shortcut icon" href="{{ url('/')}}/favicon.ico" />
    </head>
    <!-- END HEAD -->
    <!-- BEGIN BODY -->
    <!-- DOC: Apply "page-header-menu-fixed" class to set the mega menu fixed  -->
    <!-- DOC: Apply "page-header-top-fixed" class to set the top menu fixed  -->
    <body>

        <!-- BEGIN HEADER -->
        @include('header')
        <!-- END HEADER -->

        <!-- BEGIN PAGE CONTAINER -->
        @yield('container')
        <!-- END PAGE CONTAINER -->

        <!-- BEGIN FOOTER -->
        @include('footer')
        <!-- END FOOTER -->

        <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->

        <!-- BEGIN CORE PLUGINS -->
        <!--[if lt IE 9]>
        <script src="{{ url('/') }}/assets/global/plugins/respond.min.js"></script>
        <script src="{{ url('/') }}/assets/global/plugins/excanvas.min.js"></script> 
        <![endif]-->
        <script src="{{ url('/')}}/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="{{ url('/')}}/assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
        <!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
        <script src="{{ url('/')}}/assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
        <script src="{{ url('/')}}/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="{{ url('/')}}/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <script src="{{ url('/')}}/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="{{ url('/')}}/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="{{ url('/')}}/assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
        <script src="{{ url('/')}}/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
        <script src="{{ url('/')}}/assets/custom-js/moment.js" type="text/javascript"></script>
        <script src="{{ url('/')}}/assets/custom-js/angular.min.js" type="text/javascript"></script>
        <script src="{{ url('/')}}/assets/custom-js/xeditable.js" type="text/javascript"></script>
        <script src="{{ url('/')}}/assets/custom-js/ui-bootstrap-tpls.min.js" type="text/javascript"></script>
        <script src="{{ url('/')}}/assets/custom-js/app.js" type="text/javascript"></script>
        <script src="{{ url('/')}}/assets/custom-js/angular-bind-html-compile.js" type="text/javascript"></script>
        <script src="{{ url('/')}}/assets/custom-js/profileCtrl.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->

        <!-- BEGIN PAGE LEVEL PLUGINS -->
        @yield('plugins')
        <!-- END PAGE LEVEL PLUGINS -->

        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        @yield('scripts')
        <!-- END PAGE LEVEL SCRIPTS -->

        @yield('javascript')

        <!-- END JAVASCRIPTS -->
    </body>
    <!-- END BODY -->
</html>