@extends('layout')

@section('title', trans('client.add'))

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ url('/')}}/assets/global/plugins/jquery-notific8/jquery.notific8.min.css" />
@endsection

@section('container')
<div class="page-container" ng-controller="GroupsController">

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
                    <a title="Add new group" href="javascript:;" ng-click="addGroup()">
                        <i style="margin-left: 50px;font-size: 32px;" class="glyphicon glyphicon-plus"></i>
                    </a>
                    <div class="table-scrollable">
                        <table class="table table-striped table-bordered table-advance table-hover">
                            <thead>
                                <tr>
                                    <th>
                                        <i class="icon-users"></i> Group Name
                                    </th>
                                    <th class="hidden-xs">
                                        <i class="icon-lock-open"></i> Permissions
                                    </th>
                                    <th>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="g in groups">
                                    <td class="highlight">
                                        @{{g.name}}
                                    </td>
                                    <td class="hidden-xs">
                                        <span class="label label-sm label-info margin-right-10" ng-repeat="p in g.permissions">
                                            @{{p.name}}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="javascript:;" class="btn default btn-xs green-haze" ng-click="editGroup(g.id)">
                                            <i class="fa fa-edit"></i> Edit </a>
                                        <a href="javascript:;" class="btn default btn-xs black" ng-disabled="events.processing_info" ng-click="deleteGroup(g.id)">
                                            <i class="fa fa-trash-o"></i> Delete </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal fade" id="basic" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h4 class="modal-title">Add/Edit Group</h4>
                                </div>
                                <form id="group_form" action="javascript:;">
                                    <div class="modal-body">
                                        <input name="id" type="hidden" ng-model="group.id">
                                        <input ng-model="group.name" class="form-control" name="name" placeholder="Group name">

                                        <div class="margin-top-10" ng-repeat="p in permissions">
                                            <input type="checkbox" name="permissions[@{{p.id}}]" class="margin-right-10" ng-model="p.selected"><label> @{{p.name}} </label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn blue" ng-disabled="events.processing_info" ng-click="saveGroup()">Save</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
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
    var msgs = {
        group_updated_head: 'Group update',
        group_updated: 'Group updated successfully!',
        group_deleted_head: 'Group delete',
        group_deleted: 'Group deleted successfully!',
        error_head: 'Error',
        error: 'Unauthorized action!',
    }
    jQuery(document).ready(function () {
        // initiate layout and plugins
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        Demo.init();
    });
</script>
@endsection