angular.module('taskViewCtrl', []).controller('TaskViewController', ['$scope', '$window', function ($scope, $window) {

        var vm = this;

        vm.task = $window.task;
        vm.clients = $window.clients;
        vm.employees = $window.employees;
        vm.types = $window.types;
        vm.tags = $window.tags;
        vm.cases = [];

        if (vm.task.tags != '')
            vm.selectedtags = vm.task.tags.split(',');

        vm.taskColor = function () {
            if (vm.task.status == 'pending')
                return 'info';
            else if (vm.task.status == 'overdue')
                return 'danger';
            else if (vm.task.status == 'completed')
                return 'success';
        }

        vm.changeClient = function () {
            if (vm.task.type.related == 2) {
                $.ajax('/task/get-cases/' + vm.task.object.id, {
                    type: 'get',
                    crossDomain: true,
                    success: function (data) {
                        vm.cases = data.cases;
                        $scope.$apply();
                    },
                });
            }
        }

        vm.changeClient();
        vm.fileLink = function (link) {
            var ext = ['jpg', 'jpeg', 'png', 'bmp'];

            var three = link.substr(link.length - 3);
            var four = link.substr(link.length - 4);


            if (ext.indexOf(three) != -1 || ext.indexOf(four) != -1)
                return 'files/' + link;
            else
                return 'assets/admin/pages/img/doc2.png';

        }


        vm.updateTask = function (name, data, empty) {
            if (empty) {
                if (data == '')
                    return $window.msgs['empty'];
            }

            if (name == 'date')
                data = data.toISOString().slice(0, 10);
            if (name == 'tags')
                data = data.join();

            var ddata = {};
            ddata[name] = data;
            $.ajax('/task/update-task/' + vm.task.id, {
                type: 'post',
                data: ddata,
                success: function (d) {
                    if (name == 'date')
                        vm.task.date = data;
                    var arr = ['type', 'date', 'task_employee', 'employee', 'client', 'case', 'report'];
                    if (arr.indexOf(name) != -1) {
                        vm.reloadTask();
                        if (name == 'client') {
                            vm.changeClient();
                        }
                    }
                    $scope.$apply();
                    toastr['success']($window.msgs['updated'], 'Success');
                },
                error: function (err) {
                    toastr['error']($window.msgs['notupdated'], 'Error');
                }
            });
        }

        vm.deleteAtt = function (id) {
            $window.Metronic.blockUI({message: 'Processing...'});
            $.ajax('/task/delete-att/' + vm.task.id + '/' + id, {
                type: 'get',
                success: function (data) {
                    vm.task.attachments = $.grep(vm.task.attachments, function (e) {
                        return e.id != id;
                    });

                    $scope.$apply();
                    $window.Metronic.unblockUI();
                },
                error: function (err) {
                    $window.Metronic.unblockUI();
                    //console.log(err.responseText);
                }
            });
        }

        vm.reloadTask = function () {
            $window.Metronic.blockUI({message: 'Processing...'});
            $.ajax('/task/get-task/' + vm.task.id, {
                type: 'get',
                success: function (data) {
                    vm.task = data.task;
                    $scope.$apply();
                    $window.Portfolio.init();
                    $window.Metronic.unblockUI();
                },
                error: function (err) {
                    console.log(err.responseText);
                }
            });
        }

        vm.upload = function () {
            $window.myDropzone.options.url = '/task/update-task/' + vm.task.id;

            $window.myDropzone.on("errormultiple", function (files, response) {
                $window.Metronic.unblockUI();
                $window.notif(false);
                $window.myDropzone.removeAllFiles();

            });

            $window.myDropzone.on('successmultiple', function (files, response) {
                $window.Metronic.unblockUI();
                $window.notif(true);
                $window.myDropzone.removeAllFiles();
                vm.reloadTask();
            });

            if ($window.myDropzone.getAcceptedFiles().length > 0) {
                $window.myDropzone.processQueue();
            }
        }

        vm.completeTask = function () {
            vm.task.report = $('iframe').contents().find('.wysihtml5').html();

            if (vm.task.report == '') {
                toastr['error']($window.msgs['comp'].error, $window.msgs['comp'].title);
                return;
            }

            swal({title: $window.msgs['comp'].title,
                text: $window.msgs['comp'].body,
                type: "warning",
                showCancelButton: true,
                cancelButtonText: $window.msgs['comp'].cancel,
                confirmButtonText: $window.msgs['comp'].confirm,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }, function () {
                Metronic.blockUI({message: 'Processing...'});
                vm.updateTask('report', vm.task.report, true)
                swal.close();
                Metronic.unblockUI();
                $scope.$apply();

            });
        }

    }]);