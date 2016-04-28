@extends('layout')

@section('title', trans('client.add'))

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/global/plugins/select2/select2.css" />
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" />
<link href="{{ url('/') }}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" />
<link href="{{ url('/') }}/assets/global/plugins/dropzone/css/dropzone.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/global/plugins/bootstrap-toastr/toastr.min.css" />
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/global/plugins/jquery-notific8/sweetalert.css" />
@endsection

@section('container')
<div class="page-container">

    <!-- BEGIN PAGE HEAD -->
    <div class="page-head">
        <div class="container">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>{{ trans('client.add_new') }}</h1>
            </div>
            <!-- END PAGE TITLE -->

        </div>
    </div>
    <!-- END PAGE HEAD -->

    <!-- BEGIN PAGE CONTENT -->
    <div class="page-content">
        <div class="container">

            <!-- BEGIN PAGE CONTENT INNER -->
            <div class="row">
                <div class="col-md-12">
                    <div class="note note-success" id="submit-success" style="display:none">
                        <h4 class="block">You have successfully added a new client.</h4>
                        <p>
                            If you want to view the added client <a id="client-link" href="">click here</a> or if you want to add another client <a href="add-client">click here</a>.
                        </p>
                    </div>
                    <div class="portlet light " id="form_wizard_1">
                        <div class="portlet-body form">
                            <form action="process-client" class="form-horizontal form-bordered form-label-stripped" id="submit_form" method="POST">                                
                                <div class="form-wizard">
                                    <div class="form-body">
                                        <ul class="nav nav-pills nav-justified steps">

                                            <li id="st_step">
                                                <a href="#tab1" data-toggle="tab" class="step">
                                                    <span class="number">1 </span>
                                                    <span class="desc"><i class="fa fa-check"></i>Type</span>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="#tab2" data-toggle="tab" class="step">
                                                    <span class="number">2 </span>
                                                    <span class="desc"><i class="fa fa-check"></i>Info</span>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="#tab3" data-toggle="tab" class="step">
                                                    <span class="number">3</span>
                                                    <span class="desc"><i class="fa fa-check"></i>Contacts</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#tab4" data-toggle="tab" class="step">
                                                    <span class="number">4</span>
                                                    <span class="desc"><i class="fa fa-check"></i>Attachments</span>
                                                </a>
                                            </li>

                                        </ul>
                                        <div id="bar" class="progress progress-striped" role="progressbar">
                                            <div class="progress-bar progress-bar-success">
                                            </div>
                                        </div>
                                        <div class="tab-content">

                                            <div class="alert alert-danger display-none">
                                                <button class="close" data-dismiss="alert"></button>
                                                You have some form errors. Please check below.
                                            </div>
                                            <div class="alert alert-success display-none">
                                                <button class="close" data-dismiss="alert"></button>
                                                Your form validation is successful!
                                            </div>


                                            <div class="tab-pane active" id="tab1">
                                                <h3 class="block">Choose the client type</h3>

                                                <div class="form-group">

                                                    <div class="col-xs-6" style="padding-left: 20%;">
                                                        <a href="#" class="button-next individual_client">
                                                            <img src="{{ url('/') }}/assets/custom-icons/individual_client.svg" width="200" class="img-responsive">
                                                            <h3>Individual</h3>
                                                        </a>

                                                    </div>

                                                    <div class="col-xs-6" style="padding-left: 15%;">
                                                        <a href="#" class="button-next organizaton_client">
                                                            <img src="{{ url('/') }}/assets/custom-icons/org_client.svg" width="200" class="img-responsive">
                                                            <h3>Organization</h3>
                                                        </a>

                                                    </div>


                                                    <div class="col-md-12">
                                                        <select name="info[type]" style="display:none;" class="client_type">
                                                            <option id="ind" value="ind">ind1</option>
                                                            <option id="org" value="org">org1</option>
                                                        </select>
                                                    </div>
                                                </div>




                                            </div>

                                            <div class="tab-pane" id="tab2">
                                                <div id="entity_holder">

                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Username</label>
                                                    <div class="col-md-4">
                                                        <input id="username" data-msg-remote="Username already exists" type="text" class="form-control username" name="user[username]" placeholder="Username" />
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Password</label>
                                                    <div class="col-md-4">
                                                        <input type="password" id="pass" class="form-control passowrd" name="user[password]" placeholder="Password" />
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Confirm Password</label>
                                                    <div class="col-md-4">
                                                        <input type="password" id="passcon" class="form-control confirm_password" name="user[confirm_password]" placeholder="Password Confirmation" />
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Status</label>
                                                    <div class="col-md-4">
                                                        <select class="form-control" name="info[status]">
                                                            <option value="Inactive" selected>Inactive</option>
                                                            <option value="Active">Active</option>
                                                            <option value="Suspended">Suspended</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tab3">

                                                <h3 class="block">Contact Info</h3>

                                                <div class="form-group">
                                                    <label class="control-label col-md-3">photo</label>
                                                    <div class="col-md-9">
                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                                <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="">
                                                            </div>
                                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 10px;"></div>
                                                            <div style='text-align: center;'>
                                                                <span class="btn default btn-file">
                                                                    <span class="fileinput-new">Image</span>
                                                                    <span class="fileinput-exists">Change</span>
                                                                    <input type="hidden" value="" name="...">
                                                                    <input type="file" data-msg-accept="Image only" data-msg-filesize="Must be less than 2 MB" class="image" name="profile_pic">
                                                                </span>
                                                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix margin-top-10">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group something_container">
                                                    <label class="control-label col-md-3">Address</label>

                                                    <div class="col-md-9">
                                                        <div class="col-md-11">
                                                            <input type="hidden" name="contacts[0][name]" value="Address">
                                                            <input placeholder="new address" type="text" data-msg-minlength="More than 10 characters" class="form-control text" name="contacts[0][detail]" />
                                                        </div>
                                                        <div class="col-md-1">
                                                            <a href="javascript:;" class="btn btn-icon-only btn-circle green add_something address">
                                                                <i class="fa fa-plus"></i>
                                                            </a>
                                                        </div>

                                                    </div>


                                                </div>

                                                <div class="form-group something_container">
                                                    <label class="control-label col-md-3">Phone</label>

                                                    <div class="col-md-9">
                                                        <div class="col-md-11">
                                                            <input type="hidden" name="contacts[1][name]" value="Phone">
                                                            <input placeholder="new phone" type="text" data-msg-digits="Please enter numbers only" class="form-control int" name="contacts[1][detail]" />
                                                        </div>
                                                        <div class="col-md-1">
                                                            <a href="javascript:;" class="btn btn-icon-only btn-circle green add_something phone">
                                                                <i class="fa fa-plus"></i>
                                                            </a>
                                                        </div>

                                                    </div>


                                                </div>

                                                <div class="form-group something_container">
                                                    <label class="control-label col-md-3">e-mail</label>

                                                    <div class="col-md-9">
                                                        <div class="col-md-11">
                                                            <input type="hidden" name="contacts[2][name]" value="Email">
                                                            <input placeholder="new email" type="text" data-msg-email="Please enter a valid email address" class="form-control email" name="contacts[2][detail]" />
                                                        </div>
                                                        <div class="col-md-1">
                                                            <a href="javascript:;" class="btn btn-icon-only btn-circle green add_something email">
                                                                <i class="fa fa-plus"></i>
                                                            </a>
                                                        </div>

                                                    </div>


                                                </div>

                                                <div class="form-group something_container">
                                                    <label class="control-label col-md-3">Social</label>

                                                    <div class="col-md-9">
                                                        <div class="col-md-11">
                                                            <input type="hidden" name="contacts[3][name]" value="Social">
                                                            <input placeholder="new social account" type="text" data-msg-url="Please enter a valid url" class="form-control url" name="contacts[3][detail]" />
                                                        </div>
                                                        <div class="col-md-1">
                                                            <a href="javascript:;" class="btn btn-icon-only btn-circle green add_something social">
                                                                <i class="fa fa-plus"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tab4">
                                                <h3 class="block">Attachments</h3>
                                                <div class="dropzone" id="my-dropzone">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-actions">
                                        <div class="row">
                                            <div class=" col-md-9">
                                                <a href="javascript:;" class="btn default button-previous">
                                                    <i class="m-icon-swapleft"></i> Back </a>

                                                <a href="javascript:;" class="btn blue button-next first_next" style="display:none;">
                                                    Continue <i class="m-icon-swapright m-icon-white"></i>
                                                </a>

                                                <a href="javascript:;" class="btn green button-submit">
                                                    Submit <i class="m-icon-swapright m-icon-white"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE CONTENT INNER -->
        </div>
    </div>
    <!-- END PAGE CONTENT -->
</div>
<div id="templates" style="display: none;">
    <div id="address_temp">
        <div class="col-md-9 col-md-offset-3 something">
            <div class="col-md-11">
                <input type="hidden" name="contacts[:num][name]" value="Address">
                <input placeholder="new address" type="text" data-msg-minlength="More than 10 characters" class="form-control text" name="contacts[:num][detail]" />
            </div>
            <div class="col-md-1">
                <a href="javascript:;" class="btn btn-icon-only btn-circle red delete_something">
                    <i class="fa fa-times"></i>
                </a>
            </div>
        </div>
    </div>
    <div id="phone_temp">
        <div class="col-md-9 col-md-offset-3 something">
            <div class="col-md-11">
                <input type="hidden" name="contacts[:num][name]" value="Phone">
                <input placeholder="new phone" type="text" data-msg-digits="Please enter numbers only" class="form-control int" name="contacts[:num][detail]" />
            </div>
            <div class="col-md-1">
                <a href="javascript:;" class="btn btn-icon-only btn-circle red delete_something">
                    <i class="fa fa-times"></i>
                </a>
            </div>
        </div>
    </div>
    <div id="email_temp">
        <div class="col-md-9 col-md-offset-3 something">
            <div class="col-md-11">
                <input type="hidden" name="contacts[:num][name]" value="Email">
                <input placeholder="new email" type="text" data-msg-email="Please enter a valid email address" class="form-control email" name="contacts[:num][detail]" />
            </div>
            <div class="col-md-1">
                <a href="javascript:;" class="btn btn-icon-only btn-circle red delete_something">
                    <i class="fa fa-times"></i>
                </a>
            </div>
        </div>
    </div>
    <div id="social_temp">
        <div class="col-md-9 col-md-offset-3 something">
            <div class="col-md-11">
                <input type="hidden" name="contacts[:num][name]" value="Social">
                <input placeholder="new social account" type="text" data-msg-url="Please enter a valid url" class="form-control url" name="contacts[:num][detail]" />
            </div>
            <div class="col-md-1">
                <a href="javascript:;" class="btn btn-icon-only btn-circle red delete_something">
                    <i class="fa fa-times"></i>
                </a>
            </div>
        </div>
    </div>
    <div id="ind_temp">
        <h3 class="block">Individual</h3>


        <div class="form-group">
            <label class="control-label col-md-3">Full name </label>
            <div class="col-md-9">
                <input type="text" class="form-control required name" name="info[name]" placeholder='Name in English' data-msg-minlength="More than 10 characters" data-msg-required="Pleaser enter the full name"  />
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">Full Arabic name </label>
            <div class="col-md-9">
                <input type="text" class="form-control name" name="info[name_ar]" placeholder='Name in Arabic' data-msg-minlength="More than 10 characters" />
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">Nick Name</label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="info[nickname]" placeholder="Nick name" />
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">Job Title</label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="info[job_title]" placeholder="Job title" />
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3">Gender</label>
            <div class="col-md-9">
                <div class="radio-list">
                    <label style="float:left">
                        <input type="radio" class="template ununiformed" name="info[gender]" value="Male" data-title="Male" checked="checked" />Male</label>
                    <label style="float:left">
                        <input type="radio" class="template ununiformed" name="info[gender]" value="Female" data-title="Female" />Female</label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3">ID Number</label>
            <div class="col-md-9">
                <input type="text" class="form-control int" name="info[id][number]" placeholder='ID number' data-msg-digits="Please enter digits only" />
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">ID Expiry</label>
            <div class="col-md-9">
                <div class="input-group input-large date-picker input-daterange" data-date-format="yyyy-mm-dd" style="width:100% !important;">
                    <input type="text" class="form-control date" name="info[id][date]" placeholder="Issue Date" data-msg-dateISO="Please enter a valid date(choose from calendar)">
                    <span class="input-group-addon">
                        to </span>
                    <input type="text" class="form-control date" name="info[id][expiray]" placeholder="Expiray Date" data-msg-dateISO="Please enter a valid date(choose from calendar)">
                </div>
            </div>
        </div>
    </div>

    <div id="org_temp">
        <h3 class="block">Organization</h3>
        <div class="form-group">
            <label class="control-label col-md-3">Full name </label>
            <div class="col-md-9">
                <input type="text" class="form-control required name" name="info[name]" placeholder='Name in English' data-msg-minlength="More than 10 characters" data-msg-required="Pleaser enter the full name" />
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">Full Arabic name </label>
            <div class="col-md-9">
                <input type="text" class="form-control name" name="info[name_ar]" placeholder='Name in Arabic' data-msg-minlength="More than 10 characters" />
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">activity</label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="info[activity]" placeholder="Organization activity" />
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3">registered number</label>
            <div class="col-md-9">
                <input type="text" class="form-control int" name="info[register_number]" placeholder="Organization registered number" data-msg-digits="Please enter digits only" />
            </div>
        </div>
    </div>
</div>

@endsection

@section('plugins')
<script type="text/javascript" src="{{ url('/') }}/assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/assets/global/plugins/jquery-validation/js/additional-methods.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/assets/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js"></script>
<script type="text/javascript" src="{{ url('/') }}/assets/global/plugins/bootstrap-markdown/lib/markdown.js"></script>
<script src="{{ url('/') }}/assets/admin/pages/scripts/components-form-tools.js"></script>
<script type="text/javascript" src="{{ url('/') }}/assets/global/plugins/select2/select2.min.js"></script>
<script src="{{ url('/') }}/assets/global/plugins/dropzone/dropzone.js"></script>
<script type="text/javascript" src="{{ url('/') }}/assets/global/plugins/bootstrap-toastr/toastr.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/assets/global/plugins/jquery-notific8/sweetalert.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/assets/admin/pages/scripts/ui-toastr.js"></script>

@endsection

@section('scripts')
<script src="{{ url('/') }}/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="{{ url('/') }}/assets/admin/layout3/scripts/layout.js" type="text/javascript"></script>
<script src="{{ url('/') }}/assets/admin/layout3/scripts/demo.js" type="text/javascript"></script>
<script src="{{ url('/') }}/assets/admin/pages/scripts/components-pickers.js"></script>
<script src="{{ url('/') }}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
<script src="{{ url('/') }}/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script src="{{ url('/') }}/assets/admin/pages/scripts/form-wizard.js"></script>
<script src="{{ url('/') }}/assets/custom-js/custom_dropzone.js"></script>
<script src="{{ url('/') }}/assets/custom-js/rules.js"></script>
<script src="{{ url('/') }}/assets/custom-js/add_client.js"></script>
@endsection

@section('javascript')
<script>
jQuery(document).ready(function () {
    // initiate layout and plugins
    Metronic.init(); // init metronic core components
    Layout.init(); // init current layout
    Demo.init(); // init demo features
    FormWizard.init();
    ComponentsPickers.init();
    $('body').on('click', '.individual_client,.organizaton_client', function () {
        ComponentsPickers.init();
    });

    $('#form_wizard_1 .button-submit').click(function () {
        //document.getElementById('submit_form').submit();
        //return;
        Metronic.blockUI({message: 'Processing...'});
        $.ajax({
            url: 'process-client',
            type: 'post',
            data: $('#submit_form').serialize(),
            success: function (data) {
                function notif() {
                    //toastr.success('Have fun storming the castle!', 'Miracle Max Says');
                    Metronic.unblockUI();
                    swal("Client Added!", "You have added a new client successfully!", "success");
                    $('#client-link').attr('href', 'view-client/' + id);
                    $('#form_wizard_1').remove();
                    $('#submit-success').show();
                }

                console.log(JSON.stringify(data));
                var id = data.id;
                myDropzone.options.url = 'update-client/' + id;

                myDropzone.on("errormultiple", function (files, response) {

                });
                myDropzone.on('successmultiple', function (files, response) {
                    notif();
                });

                if (myDropzone.getAcceptedFiles().length > 0) {
                    myDropzone.processQueue();
                } else {
                    notif();
                }
            },
            error: function (err) {
                Metronic.unblockUI();
                swal("Client not added!", "There has been an error! Please try again later or contact support", "error");
            }
        });
    }).hide();
});
</script>
@endsection