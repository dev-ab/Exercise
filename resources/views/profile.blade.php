@extends('layout')

@section('title', trans('client.add'))

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ url('/')}}/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" />
<link rel="stylesheet" type="text/css" href="{{ url('/')}}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" />
<link rel="stylesheet" type="text/css" href="{{ url('/')}}/assets/global/plugins/jquery-notific8/jquery.notific8.min.css" />
<link rel="stylesheet" type="text/css" href="{{ url('/')}}/assets/admin/pages/css/profile.css" />
<link rel="stylesheet" type="text/css" href="{{ url('/')}}/assets/admin/pages/css/tasks.css" />
<link rel="stylesheet" type="text/css" href="{{ url('/')}}/assets/gallary/lightgallery.css" />
@endsection

@section('container')
<style>
    .g-icon{
        color:#5b9bd1;
        font-size: 32px !important;
        margin-right: 10px;
    }
    #hov {
        float: left;
        position: absolute;
        top:80%;
        left:40%;
        z-index: 1000;
        padding: 20px;
        color: #FFFFFF;
        font-weight: bold;
        display: none;
    }
    #img:hover{
        opacity: .7;
    }

    #hov:hover{
        display: block;
        cursor: pointer;
    }

    #img:hover + #hov {
        display: block;
        z-index: 10000;
    }


</style>

<div class="page-container" ng-controller="ProfileController">

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
            <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
            <div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">Modal title</h4>
                        </div>
                        <div class="modal-body">
                            Widget settings form goes here
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn blue">Save changes</button>
                            <button type="button" class="btn default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
            <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
            <!-- BEGIN PAGE CONTENT INNER -->
            <div class="row margin-top-10">
                <div class="col-md-12">
                    <!-- BEGIN PROFILE SIDEBAR -->
                    <div class="profile-sidebar" style="width: 250px;">
                        <!-- PORTLET MAIN -->
                        <div class="portlet light profile-sidebar-portlet">
                            <!-- SIDEBAR USERPIC -->
                            <div class="profile-userpic">
                                <img src="@{{'/img/'+ user.info.profile_thumb}}" class="img-responsive" alt="">
                            </div>
                            <!-- END SIDEBAR USERPIC -->
                            <!-- SIDEBAR USER TITLE -->
                            <div class="profile-usertitle">
                                <div class="profile-usertitle-name">
                                    @{{user.info.title + user.info.fullname}}
                                </div>
                                <div class="profile-usertitle-job">
                                    @{{user.info.job}}
                                </div>
                            </div>
                            <!-- END SIDEBAR USER TITLE -->
                            <!-- SIDEBAR MENU -->
                            <div class="profile-usermenu">
                                <ul class="nav">
                                    <li class="active">
                                        <a href="#">
                                            <i class="icon-home"></i>
                                            Overview </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- END MENU -->
                        </div>
                        <!-- END PORTLET MAIN -->
                    </div>
                    <!-- END BEGIN PROFILE SIDEBAR -->
                    <!-- BEGIN PROFILE CONTENT -->
                    <div class="profile-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="portlet light">
                                    <div class="portlet-title tabbable-line">
                                        <div class="caption caption-md">
                                            <i class="icon-globe theme-font hide"></i>
                                            <span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
                                        </div>
                                        <ul class="nav nav-tabs">
                                            <li class="active">
                                                <a href="#tab_1_1" data-toggle="tab">Personal Info</a>
                                            </li>
                                            <li>
                                                <a href="#tab_1_2" data-toggle="tab">Change Avatar</a>
                                            </li>
                                            <li>
                                                <a href="#tab_1_3" data-toggle="tab">Security</a>
                                            </li>
                                            <li>
                                                <a href="#tab_1_4" data-toggle="tab">Portfolio</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="tab-content">
                                            <!-- PERSONAL INFO TAB -->
                                            <div class="tab-pane active" id="tab_1_1">
                                                <form id="info_form" role="form" action="/save-info" method="post">
                                                    <div class="form-group">
                                                        <label class="control-label">Title</label>
                                                        <select class="form-control" ng-model="info.title">
                                                            <option>Choose title ...</option>
                                                            <option value="Mr." {{ ($user->info['title'] == 'Mr.')? 'selected' : '' }}>Mr.</option>
                                                            <option value="Mrs." {{ ($user->info['title'] == 'Mrs.')? 'selected' : '' }}>Mrs.</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Full Name</label>
                                                        <input ng-model="info.fullname" type="text" placeholder="John Wilson" value="{{ $user->info['fullname']}}" class="form-control"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Occupation</label>
                                                        <input ng-model="info.job" type="text" placeholder="Web Developer" value='{{ $user->info['job']}}' class="form-control"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Birth Date</label>
                                                        <input ng-model="info.birthdate" class="form-control date-picker" size="16" type="text" value='{{$user->info['birthdate']}}' placeholder="Date of Birth" data-date-format="yyyy-mm-dd" >
                                                    </div>
                                                    <div class="margiv-top-10">
                                                        <a href="javascript:;" ng-disabled="events.processing_info"  class="btn green-haze" ng-click="submitInfo()">
                                                            Save Changes </a>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- END PERSONAL INFO TAB -->
                                            <!-- CHANGE AVATAR TAB -->
                                            <div class="tab-pane" id="tab_1_2">
                                                <form id="avatar_form" action="#" role="form">
                                                    <div class="form-group">
                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                                <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt=""/>
                                                            </div>
                                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
                                                            </div>
                                                            <div>
                                                                <span class="btn default btn-file">
                                                                    <span class="fileinput-new">
                                                                        Select image </span>
                                                                    <span class="fileinput-exists">
                                                                        Change </span>
                                                                    <input type="file" name="image">
                                                                </span>
                                                                <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput">
                                                                    Remove </a>
                                                                <span class="error" ng-show='vars.noImage'>Please select an image</span>
                                                                <span class="error" ng-show='vars.imageFail'>Upload failed! Make sure the image isn't too big and try again</span>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix margin-top-10">
                                                            <span class="label label-danger">NOTE! </span>
                                                            <span>Attached image thumbnail is supported in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 10 only </span>
                                                        </div>
                                                    </div>
                                                    <div class="progress" ng-show="events.processing_file">
                                                        <div class="progress-bar" role="progressbar" aria-valuenow="@{{ vars.fileProgress }}"
                                                             aria-valuemin="0" aria-valuemax="100" style="width:@{{ vars.fileProgress }}%">
                                                        </div>
                                                    </div>
                                                    <div class="margin-top-10">
                                                        <a href="javascript:;" class="btn green-haze" ng-disabled="events.processing_info" ng-click="uploadImage()">
                                                            Save </a>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- END CHANGE AVATAR TAB -->
                                            <!-- CHANGE PASSWORD TAB -->
                                            <div class="tab-pane" id="tab_1_3">
                                                <form id="pass_form" action="#">
                                                    @if($user->id == Auth::user()->id)
                                                    <div class="form-group">
                                                        <label class="control-label">Current Password</label>
                                                        <input type="password" name="current_password" class="form-control"/>
                                                        <span class="error" ng-show="vars.pass_err">The entered password is incorrect</span>
                                                    </div>
                                                    @endif
                                                    <div class="form-group">
                                                        <label class="control-label">New Password</label>
                                                        <input id="password" type="password" name="password" class="form-control"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Re-type New Password</label>
                                                        <input type="password" name="confirm_password" class="form-control"/>
                                                    </div>
                                                    <div class="margin-top-10">
                                                        <a href="javascript:;" ng-disabled="events.processing_info"  ng-click="savePassword()" class="btn green-haze">
                                                            Change Password </a>
                                                    </div>
                                                </form>
                                                @if($user->id != Auth::user()->id && Auth::user()->superAdmin)
                                                <form action="#" style="margin-top: 15px;">
                                                    <div class="form-group">
                                                        <label class="control-label">Security Group</label>
                                                        <select id="group" ng-model="user.group.id" class="form-control" ng-options="g.id as g.name for g in groups"></select>
                                                    </div>
                                                    <div class="margin-top-10">
                                                        <a href="javascript:;" ng-disabled="events.processing_info"  ng-click="saveGroup()"  class="btn green-haze">
                                                            Change Group </a>
                                                    </div>
                                                </form>
                                                @endif
                                            </div>
                                            <!-- END CHANGE PASSWORD TAB -->
                                            <!-- PRIVACY SETTINGS TAB -->
                                            <div class="tab-pane" id="tab_1_4">
                                                <div class="row">
                                                    <div class="col col-xs-12 col-md-6">
                                                        <div id="img" class="lightgallery">
                                                            <a href="http://ex.localhost/img/c4ca4238a0b923820dcc509a6f75849b/55.jpg">
                                                                <img width = "100%" src="http://ex.localhost/img/c4ca4238a0b923820dcc509a6f75849b/55.jpg"/>
                                                            </a>
                                                        </div>
                                                        <div id="hov">
                                                            <i class="fa fa-pencil-square fa-5x g-icon"></i>
                                                            <i class="fa fa-trash fa-5x g-icon"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col col-xs-12 col-md-6">
                                                        <div id="img" class="lightgallery">
                                                            <a href="http://ex.localhost/img/c4ca4238a0b923820dcc509a6f75849b/54.jpg">
                                                                <img width = "100%" src="http://ex.localhost/img/c4ca4238a0b923820dcc509a6f75849b/54.jpg"/>
                                                            </a>
                                                            <a class="hide" href="http://ex.localhost/img/c4ca4238a0b923820dcc509a6f75849b/55.jpg">
                                                                <img width = "100%" src="http://ex.localhost/img/c4ca4238a0b923820dcc509a6f75849b/55.jpg"/>
                                                            </a>
                                                        </div>
                                                        <div id="hov">
                                                            <i class="fa fa-pencil-square fa-5x g-icon"></i>
                                                            <i class="fa fa-trash fa-5x g-icon"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END PRIVACY SETTINGS TAB -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END PROFILE CONTENT -->
                </div>
            </div>
            <!-- END PAGE CONTENT INNER -->
        </div>
    </div>
    <!-- END PAGE CONTENT -->
</div>
@endsection

@section('plugins')
<script type="text/javascript" src="{{ url('/')}}/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="{{ url('/')}}/assets/global/plugins/jquery.sparkline.min.js"></script>
<script type="text/javascript" src="{{ url('/')}}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
<script type="text/javascript" src="{{ url('/')}}/assets/global/plugins/jquery-notific8/jquery.notific8.min.js"></script>
<script type="text/javascript" src="{{ url('/')}}/assets/global/plugins/jquery-validation/jquery.validate.min.js"></script>
<script type="text/javascript" src="{{ url('/')}}/assets/global/plugins/jquery-validation/additional-methods.min.js"></script>
<script type="text/javascript" src="{{ url('/')}}/assets/global/plugins/jquery-validation/localization/messages_ar.min.js"></script>

@endsection

@section('scripts')
<script src="{{ url('/')}}/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="{{ url('/')}}/assets/admin/layout3/scripts/layout.js" type="text/javascript"></script>
<script src="{{ url('/')}}/assets/admin/layout3/scripts/demo.js" type="text/javascript"></script>
<script src="{{ url('/')}}/assets/admin/pages/scripts/components-pickers.js" type="text/javascript"></script>
<script src="{{ url('/')}}/assets/admin/pages/scripts/profile.js" type="text/javascript"></script>
<script src="{{ url('/')}}/assets/admin/pages/scripts/ui-notific8.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js"></script>
<script src="{{ url('/')}}/assets/gallary/lightgallery.js" type="text/javascript"></script>
<script src="{{ url('/')}}/assets/gallary/lg-thumbnail.js" type="text/javascript"></script>
<script src="{{ url('/')}}/assets/gallary/lg-fullscreen.js" type="text/javascript"></script>
@endsection

@section('javascript')
<script>
                                                            var msgs = {
                                                                info_updated_head: 'Personal Information',
                                                                info_updated: 'Personal information updated successfully!',
                                                                accept_msg:'Please select an image only!',
                                                                avatar_updated_head: 'User avatar',
                                                                avatar_updated: 'Avatar updated successfully!',
                                                                pass_updated_head: 'User password',
                                                                pass_updated: 'Password updated successfully!',
                                                                error_head: 'Error',
                                                                error: 'Unauthorized Action!',
                                                            }
                                                            jQuery(document).ready(function () {
                                                                // initiate layout and plugins
                                                                Metronic.init(); // init metronic core components
                                                                Layout.init(); // init current layout
                                                                Demo.init();
                                                                Profile.init(); // init page demo
                                                                ComponentsPickers.init();
                                                                UINotific8.init();
                                                                
                                                                $(".lightgallery").lightGallery(); 
                                                                
                                                            });
</script>
@endsection