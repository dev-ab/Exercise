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
                    if (data.success)
                        $.notific8($window.msgs.pass_updated, {heading: $window.msgs.pass_updated_head, theme: 'lime'});
                    else
                        $scope.vars.pass_err = true;
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
            if (!$('#pass_form').valid()) {
                $scope.events.processing_info = false;
                return;
            }
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


    }]);