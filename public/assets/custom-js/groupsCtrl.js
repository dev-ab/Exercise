angular.module('groupsCtrl', []).controller('GroupsController', ['$scope', '$window', function ($scope, $window) {

        var vm = this;
        $scope.groups = $window.groups;
        $scope.permissions = $window.permissions;
        $scope.group = {id: 'null', name: '', permissions: []}
        $scope.events = {
            processing_info: false
        };

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $scope.addGroup = function () {
            $scope.group = {id: 'null', name: '', permissions: []}
            for (var i = 0; i < $scope.permissions.length; i++) {
                $scope.permissions[i].selected = false;
            }
            $('#basic').modal('toggle');
        }

        $scope.editGroup = function (id) {
            var go = true;
            angular.forEach($scope.groups, function (g) {
                if (go) {
                    if (g.id == id) {
                        $scope.group = angular.copy(g);
                        go = false;
                    }
                }
            });

            for (var i = 0; i < $scope.permissions.length; i++) {
                var result = $.grep($scope.group.permissions, function (e) {
                    return e.id == $scope.permissions[i].id;
                });

                if (result.length > 0)
                    $scope.permissions[i].selected = true;
                else
                    $scope.permissions[i].selected = false;
            }
            var temp = angular.copy($scope.permissions);
            $scope.permissions = [];
            $scope.permissions = temp;
            $('#basic').modal('toggle');
        }

        $scope.reloadGroups = function () {
            $.ajax({
                url: '/reload-groups',
                type: 'get',
                success: function (data) {
                    console.log(JSON.stringify(data));
                    $scope.groups = data.groups;
                    $scope.$apply();
                },
                error: function (c) {
                    console.log(c.responseText);
                    $scope.$apply();
                }
            });
        }

        $scope.saveGroup = function () {
            $scope.events.processing_info = true;
            $.ajax({
                url: '/update-group/' + $scope.group.id,
                type: 'post',
                data: $('#group_form').serialize(),
                success: function (data) {
                    console.log(JSON.stringify(data));
                    $scope.events.processing_info = false;
                    $.notific8($window.msgs.group_updated, {heading: $window.msgs.group_updated_head, theme: 'lime'});
                    $scope.reloadGroups();
                    $scope.$apply();
                    $('#basic').modal('toggle');
                },
                error: function (c) {
                    console.log(c.responseText);
                    $scope.events.processing_info = false;
                    $.notific8($window.msgs.error, {heading: $window.msgs.error_head, theme: 'ruby'});
                    $scope.$apply();
                }
            });
        }
        
        $scope.deleteGroup = function (id) {
            $scope.events.processing_info = true;
            $.ajax({
                url: '/delete-group/' + id,
                type: 'get',
                success: function (data) {
                    console.log(JSON.stringify(data));
                    $scope.events.processing_info = false;
                    $.notific8($window.msgs.group_deleted, {heading: $window.msgs.group_deleted_head, theme: 'lime'});
                    $scope.reloadGroups();
                    $scope.$apply();
                },
                error: function (c) {
                    console.log(c.responseText);
                    $scope.events.processing_info = false;
                    $.notific8($window.msgs.error, {heading: $window.msgs.error_head, theme: 'ruby'});
                    $scope.$apply();
                }
            });
        }


    }]);