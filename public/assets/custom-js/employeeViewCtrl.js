angular.module('employeeViewCtrl', []).controller('EmployeeViewController', ['$scope', '$window', function ($scope, $window) {

        var vm = this;

        vm.employee = $window.employee;
        vm.gender = $window.gender;
        vm.blood = $window.blood;
        vm.caseTypes = $window.caseTypes;
        vm.jobTypes = $window.jobTypes;
        vm.jobDegrees = $window.jobDegrees;
        vm.branches = $window.branches;
        vm.deps = $window.deps;
        vm.langEv = $window.eval;


        if (vm.employee.owner && vm.employee.owner.case_types.length > 0)
            vm.selectedCaseTypes = vm.employee.owner.case_types.map(function (a) {
                return a.id;
            });

        vm.typeName = function (id) {
            var res = $.grep(vm.caseTypes, function (e) {
                return e.id == id;
            });
            if (res.length > 0)
                return res[0];
        }


        vm.contactType = function (type) {
            var result = {};
            angular.forEach(vm.employee.contacts, function (value, key) {
                if (value.name == type) {
                    result[key] = value;
                }
            });
            return result;
        }

        vm.reloadEmployee = function () {
            $window.Metronic.blockUI({message: 'Processing...'});
            $.ajax('/employee/get-employee/' + vm.employee.id, {
                type: 'get',
                success: function (data) {
                    vm.employee = data.employee;
                    $scope.$apply();
                    $window.Portfolio.init();
                    $window.Metronic.unblockUI();
                },
                error: function (err) {
                    console.log(err.responseText);
                }
            });
        }

        vm.updateEmployee = function (name, data, empty) {
            if (empty) {
                if (data == '')
                    return $window.msgs['empty'];
            }

            if (name == 'birth_date' || name == 'contract_date' || name == 'contract_expiray')
                data = data.toISOString().slice(0, 10);

            if (name == 'hour_rate' || name == 'working_hours' || name == 'case_types') {
                if (vm.employee.owner)
                    var ddata = {lawyer: {id: employee.owner.id}};
                else
                    var ddata = {lawyer: {}};
                ddata.lawyer[name] = data;
            } else {
                var ddata = {info: {}};
                ddata.info[name] = data;
            }
            $.ajax('/update-employee/' + vm.employee.id, {
                type: 'post',
                data: ddata,
                success: function (d) {
                    var arr = ['job_type', 'job_degree', 'birth_date', 'contract_expiray',
                        'contract_date', 'hour_rate', 'working_hours', 'case_types'];
                    if (arr.indexOf(name) != -1) {
                        vm.reloadEmployee();
                        if (name == 'job_type') {
                            vm.selectedCaseTypes = [];
                        }
                    }
                    $scope.$apply();
                    toastr['success']($window.msgs['updated'], 'Success');
                },
                error: function (err) {
                    toastr['error']($window.msgs['notupdated'], 'Error');
                    console.log(err.responseText);
                }
            });
        }

        vm.updateOne = function (type, obj, data, i, empty) {

            if (type == 'contact') {
                if (empty && data == '')
                    return $window.msgs['empty'];
                obj.detail = data;
            }
            if (type == 'education') {
                if (empty && data.name == '')
                    return $window.msgs['empty'];
                obj.name = data.name;
                obj.description = data.desc;
                obj.year = data.year;
                //alert(JSON.stringify(obj));
            }
            if (type == 'language') {
                if (empty && data.lang == '')
                    return $window.msgs['empty'];
                obj.language = data.lang;
                obj.evaluation = data.eval;
            }
            if (type == 'certification') {
                if (empty && data.name == '')
                    return $window.msgs['empty'];
                obj.name = data.name;
                obj.description = data.desc;
            }

            var ddata = {type: type, data: obj};
            $.ajax('/update-one/' + vm.employee.id, {
                type: 'post',
                data: ddata,
                success: function (data) {
                    if (type == 'contact')
                        vm.employee.contacts[i] = data.obj;
                    if (type == 'education')
                        vm.employee.educations[i] = data.obj;
                    if (type == 'language')
                        vm.employee.languages[i] = data.obj;
                    if (type == 'certification')
                        vm.employee.certifications[i] = data.obj;

                    $scope.$apply();
                    toastr['success']($window.msgs['updated'], 'Success');
                },
                error: function (err) {
                    toastr['error']($window.msgs['notupdated'], 'Error');
                    console.log(err.responseText);
                }
            });
        }

        vm.deleteOne = function (type, obj, i) {
            if (obj.id == null) {
                if (type == 'contact')
                    vm.employee.contacts.splice(i, 1);
                if (type == 'education')
                    vm.employee.educations.splice(i, 1);
                if (type == 'language')
                    vm.employee.languages.splice(i, 1);
                if (type == 'certification')
                    vm.employee.certifications.splice(i, 1);
            } else {
                swal({title: $window.msgs['del'].title,
                    text: $window.msgs['del'].body,
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonText: $window.msgs['del'].cancel,
                    confirmButtonText: $window.msgs['del'].confirm,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                }, function () {
                    Metronic.blockUI({message: 'Processing...'});
                    $.ajax('/delete-one/' + vm.employee.id, {
                        type: 'post',
                        data: {type: type, data: obj},
                        success: function (data) {
                            if (type == 'contact')
                                vm.employee.contacts.splice(i, 1);
                            if (type == 'education')
                                vm.employee.educations.splice(i, 1);
                            if (type == 'language')
                                vm.employee.languages.splice(i, 1);
                            if (type == 'certification')
                                vm.employee.certifications.splice(i, 1);

                            $scope.$apply();
                            toastr['success']($window.msgs['deleted'], 'Success');
                        },
                        error: function (err) {
                            toastr['error']($window.msgs['notdeleted'], 'Error');
                            console.log(err.responseText);
                        }
                    });
                    swal.close();
                    Metronic.unblockUI();
                    $scope.$apply();
                });
            }
        }

        vm.addCon = function (type) {
            vm.insertedCon = {
                id: null,
                name: type,
                detail: ''
            };
            vm.employee.contacts.push(vm.insertedCon);
        }

        vm.addEdu = function () {
            vm.insertedEdu = {
                id: null,
                name: '',
                description: '',
                year: ''
            };
            vm.employee.educations.push(vm.insertedEdu);
        }
        vm.addLang = function () {
            vm.insertedLang = {
                id: null,
                language: '',
                evaluation: ''
            };
            vm.employee.languages.push(vm.insertedLang);
        }
        vm.addCer = function () {
            vm.insertedCer = {
                id: null,
                name: '',
                description: ''
            };
            vm.employee.certifications.push(vm.insertedCer);
        }




        /*
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
         */
    }]);