@extends('layout')

@section('title', trans('client.add'))

@section('styles')
@endsection

@section('container')
<div class="page-container">

    <!-- BEGIN PAGE HEAD -->
    <div class="page-head">
        <div class="container">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>{{ trans('client.add_new')}}</h1>
            </div>
            <!-- END PAGE TITLE -->

        </div>
    </div>
    <!-- END PAGE HEAD -->

    <!-- BEGIN PAGE CONTENT -->
    <div class="page-content">
        <div class="container">
            <!-- BEGIN PAGE CONTENT INNER -->
            <div class='portlet light'>
                <div class='portlet-body'>
                    <div class="tiles">
                        <a href='/profile'>
                            <div class="tile double bg-blue-hoki">
                                <div class="tile-body">
                                    <i class="fa fa-user"></i>
                                </div>
                                <div class="tile-object">
                                    <div class="name" style='padding-left:35%;'>
                                        My Profile
                                    </div>
                                </div>
                            </div>
                        </a>
                        @if(Gate::check('view_users') || ($user->superAdmin))
                        <a href='/view-users'>
                            <div class="tile double bg-red-sunglo">
                                <div class="tile-body">
                                    <i class="fa fa-users"></i>
                                </div>
                                <div class="tile-object">
                                    <div class="name" style='padding-left:30%;'>
                                        Manage Users
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endif
                        @if(Gate::check('view_groups') || ($user->superAdmin))
                        <a href='/view-groups'>
                            <div class="tile double bg-blue-madison">
                                <div class="tile-body">
                                    <i class="fa fa-unlock-alt"></i>
                                </div>
                                <div class="tile-object">
                                    <div class="name" style='padding-left:30%;'>
                                        Manage Groups
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            <!-- END PAGE CONTENT INNER -->
        </div>
    </div>
    <!-- END PAGE CONTENT -->
</div>
@endsection

@section('plugins')
@endsection

@section('scripts')
<script src="{{ url('/')}}/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="{{ url('/')}}/assets/admin/layout3/scripts/layout.js" type="text/javascript"></script>
<script src="{{ url('/')}}/assets/admin/layout3/scripts/demo.js" type="text/javascript"></script>
@endsection

@section('javascript')
<script>
jQuery(document).ready(function () {
    // initiate layout and plugins
    Metronic.init(); // init metronic core components
    Layout.init(); // init current layout
    Demo.init();
});
</script>
@endsection