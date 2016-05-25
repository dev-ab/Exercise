@extends('layout')

@section('title', trans('client.add'))

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ url('/')}}/assets/global/plugins/jquery-notific8/jquery.notific8.min.css" />
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
                    <div class="row thumbnails">
                        @foreach($users as $user)
                        <div class="col-md-3">
                            <div class="meet-our-team">
                                <h3>{{ $user->info->fullname }} <small>{{ $user->info->job }}</small></h3>
                                <img src="{{(empty($user->info->profile_pic))? url('assets/admin/layout/img/avatar2.png'): url('img/'.$user->info->profile_pic)}}" alt="" class="img-responsive"/>
                                <div class="team-info" style="margin:15px;">
                                    <a href="{{url('profile/'.$user->id)}}"><li style="font-size: 32px;margin-left: 10px;" class="fa fa-edit"></li></a>
                                    <a href="javascript:;" class="delete-user" data="{{$user->id}}"><li style="font-size: 32px;margin-left: 10px;" class="fa fa-trash"></li></a>
                                </div>
                            </div>
                        </div>
                        @endforeach
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
<script type="text/javascript" src="{{ url('/')}}/assets/global/plugins/jquery-notific8/jquery.notific8.min.js"></script>
@endsection

@section('scripts')
<script src="{{ url('/')}}/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="{{ url('/')}}/assets/admin/layout3/scripts/layout.js" type="text/javascript"></script>
<script src="{{ url('/')}}/assets/admin/layout3/scripts/demo.js" type="text/javascript"></script>
<script src="{{ url('/')}}/assets/admin/pages/scripts/ui-notific8.js" type="text/javascript"></script>
@endsection

@section('javascript')
<script>
jQuery(document).ready(function () {
    // initiate layout and plugins
    Metronic.init(); // init metronic core components
    Layout.init(); // init current layout
    Demo.init();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.delete-user').click(function () {
        $(this).parent().parent().parent().remove();
        var id = $(this).attr('data');
        $.ajax({
            url: '/delete-user/' + id,
            type: 'post',
            data: {id: id},
            success: function (data) {
                console.log(JSON.stringify(data));
                $.notific8('User Deleted Successfully!', {heading: 'User Deletetion', theme: 'lime'});
            },
            error: function (c) {
                console.log(c.responseText);
                $.notific8('Unauthorized Action', {heading: 'Error', theme: 'ruby'});
            }
        });
    });


});

</script>
@endsection