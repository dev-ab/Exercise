angular.module('profileCtrl', []).controller('ProfileController', ['$scope', '$window', function ($scope, $window) {

        var vm = this;
        $scope.user = $window.user;
        $scope.groups = $window.groups;
        $scope.info = angular.copy($scope.user.info);
        $scope.vars = {
            fileProgress: 0
        };
        $scope.events = {
            processing_info: false,
            processing_file: false,
        };

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $scope.reloadUser = function () {


            $.ajax({
                url: '/reload-user/' + $scope.user.id,
                type: 'get',
                data: {},
                success: function (data) {
                    //console.log(JSON.stringify(data));
                    $scope.user = data.user;
                    $scope.$apply()
                },
                error: function (data) {
                    //console.log(data.responseText);
                }
            });
        }



        $scope.submitInfo = function () {
            $scope.events.processing_info = true;
            //alert(JSON.stringify($scope.info));
            $.ajax({
                url: '/save-info/' + $scope.user.id,
                type: 'post',
                data: $scope.info,
                success: function (data) {
                    $scope.events.processing_info = false;
                    $.notific8($window.msgs.info_updated, {heading: $window.msgs.info_updated_head, theme: 'lime'});
                    $scope.reloadUser();
                    $scope.$apply();
                },
                error: function (c) {
                    //console.log(c.responseText);
                    $scope.events.processing_info = false;
                    $.notific8($window.msgs.error, {heading: $window.msgs.error_head, theme: 'ruby'});
                    $scope.$apply();
                }
            });
        }

        $scope.uploadImage = function () {
            $scope.events.processing_info = true;
            $scope.vars.noImage = false;
            $scope.vars.imageFail = false;
            $('#avatar_form').validate({
                errorPlacement: function (error, element) {
                    error.appendTo(element.parent().parent());
                },
                rules: {
                    image: {
                        accept: "image/*"
                    }
                },
                messages: {
                    image: {
                        accept: $window.msgs.accept_msg
                    }
                }
            });
            if (!$('#avatar_form').valid()) {
                $scope.events.processing_info = false;
                return;
            } else if (!jQuery('input[name=image]')[0].files ||
                    !jQuery('input[name=image]')[0].files.length) {
                $scope.vars.noImage = true;
                $scope.events.processing_info = false;
                return;
            }

            $scope.events.processing_file = true;
            var data = new FormData();
            jQuery.each(jQuery('input[name=image]')[0].files, function (i, file) {
                data.append(i, file);
            });
            $.ajax({
                url: '/save-avatar/' + $scope.user.id,
                type: 'post',
                cache: false,
                contentType: false,
                processData: false,
                data: data,
                xhr: function () {
                    // get the native XmlHttpRequest object
                    var xhr = $.ajaxSettings.xhr();
                    // set the onprogress event handler
                    xhr.upload.onprogress = function (evt) {
                        //console.log('progress', evt.loaded / evt.total * 100)
                        $scope.vars.fileProgress = evt.loaded / evt.total * 100;
                        $scope.$apply();
                    };
                    // set the onload event handler
                    xhr.upload.onload = function () {
                        //console.log('DONE!')
                    };
                    // return the customized object
                    return xhr;
                },
                success: function (data) {
                    $scope.events.processing_file = false;
                    $scope.events.processing_info = false;
                    $.notific8($window.msgs.avatar_updated, {heading: $window.msgs.avatar_updated_head, theme: 'lime'});
                    $scope.reloadUser();
                    $scope.$apply();
                    //console.log(data);
                },
                error: function (c) {
                    $scope.events.processing_file = false;
                    $scope.events.processing_info = false;
                    $scope.vars.imageFail = true;
                    $scope.$apply();
                    //console.log(c.responseText);
                    $.notific8($window.msgs.error, {heading: $window.msgs.error_head, theme: 'ruby'});
                    $scope.$apply();
                }
            });
        }
        $scope.savePassword = function () {
            $scope.events.processing_info = true;
            $scope.vars.pass_err = false;
            $('#pass_form').validate({
                rules: {
                    current_password: {
                        required: true
                    },
                    password: {
                        required: true,
                        minlength: 5
                    },
                    confirm_password: {
                        equalTo: "#password"
                    }
                }
            });
            if (!$('#pass_form').valid()) {
                $scope.events.processing_info = false;
                return;
            }
            $.ajax({
                url: '/save-password/' + $scope.user.id,
                type: 'post',
                data: $('#pass_form').serialize(),
                success: function (data) {
                    //console.log(JSON.stringify(data));
                    $scope.events.processing_info = false;
                    if (data.success) {
                        $('#pass_form').find("input[type=password]").val("");
                        $.notific8($window.msgs.pass_updated, {heading: $window.msgs.pass_updated_head, theme: 'lime'});
                    } else {
                        $scope.vars.pass_err = true;
                    }
                    $scope.$apply();
                },
                error: function (c) {
                    //console.log(c.responseText);
                    $scope.events.processing_info = false;
                    $.notific8($window.msgs.error, {heading: $window.msgs.error_head, theme: 'ruby'});
                    $scope.$apply();
                }
            });
        }


        $scope.saveGroup = function () {
            $scope.events.processing_info = true;
            $.ajax({
                url: '/save-group/' + $scope.user.id,
                type: 'post',
                data: {group: $('#group').val()},
                success: function (data) {
                    console.log(JSON.stringify(data));
                    $scope.events.processing_info = false;
                    $.notific8($window.msgs.pass_updated, {heading: $window.msgs.pass_updated_head, theme: 'lime'});
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

        $scope.loadProject = function (proj) {
            $window.myDropzone.removeAllFiles();
            $window.myDropzone.options.maxFiles = 15;
            if (proj == null) {
                $('input[name="id"]').val('null');
                $('#ntemp').val('');
                $('#dtemp').val('');
            } else {
                $('input[name="id"]').val(proj.id);
                $('#ntemp').val(proj.name);
                $('#dtemp').val(proj.description);
                for (var i = 0; i < proj.attachments.length; i++) {
                    //alert(JSON.stringify(proj.attachments[i]));
                    var mockFile = {name: proj.attachments[i].url, size: proj.attachments[i].size, id: proj.id};
                    $window.myDropzone.emit("addedfile", mockFile);
                    $window.myDropzone.emit("thumbnail", mockFile, 'http://ex.localhost/img/' + proj.attachments[i].url);
                    $window.myDropzone.emit("complete", mockFile);
                    $window.myDropzone.emit("success", mockFile);
                    $window.myDropzone.files.push(mockFile);
                    $window.myDropzone.options.maxFiles = $window.myDropzone.options.maxFiles - 1;
                }
            }
        }


        $scope.saveProject = function () {
            $('#proj_form').validate({
                rules: {
                    ntemp: {
                        required: true
                    },
                    dtemp: {
                        required: true,
                    }
                }
            });

            $scope.events.processing_info = true;
            if (!$('#proj_form').valid()) {
                $scope.events.processing_info = false;
                return;
            }

            $('input[name="name"]').val($('#ntemp').val());
            $('input[name="description"]').val($('#dtemp').val());
            $window.myDropzone.options.url = '/save-project/' + $scope.user.id;
            $window.myDropzone.processQueue();
            myDropzone.on("successmultiple", function (a, data) {
                console.log(data);
                $scope.reloadUser();
                $scope.$apply();
                $('#basic').modal('toggle');
                $scope.events.processing_info = false;
                $.notific8($window.msgs.project_updated, {heading: $window.msgs.project_updated_head, theme: 'lime'});
            });
            myDropzone.on("errormultiple", function (a, data) {
                console.log(data);
                $scope.events.processing_info = false;
                $.notific8($window.msgs.error, {heading: $window.msgs.error_head, theme: 'ruby'});
            });
            $scope.events.processing_info = false;
        }

        $scope.deleteProject = function (id) {
            $scope.events.processing_info = true;
            $.ajax({
                url: '/delete-project/' + $scope.user.id,
                type: 'post',
                data: {id: id},
                success: function (data) {
                    console.log(JSON.stringify(data));
                    $scope.events.processing_info = false;
                    $.notific8($window.msgs.proj_deleted, {heading: $window.msgs.proj_deleted_head, theme: 'lime'});
                    $scope.reloadUser();
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
        $scope.deleteAtt = function (file) {
            $scope.events.processing_info = true;
            $.ajax({
                url: '/delete-att/' + $scope.user.id,
                type: 'post',
                data: {id: file.id, url: file.name},
                success: function (data) {
                    console.log(JSON.stringify(data));
                    $scope.events.processing_info = false;
                    $.notific8($window.msgs.proj_deleted, {heading: $window.msgs.proj_deleted_head, theme: 'lime'});
                    $scope.reloadUser();
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