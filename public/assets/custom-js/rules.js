$(document).ready(function () {
    jQuery.validator.addMethod('filesize', function (value, element, param) {
        var param = param * 1048576;
        // param = size (en bytes) 
        // element = element to validate (<input>)
        // value = value of the element (file name)
        return this.optional(element) || (element.files[0].size <= param)
    });
    jQuery.validator.addClassRules({
        //global class rules
        required: {
            required: true
        },
        name: {
            minlength: 10
        },
        text: {
            minlength: 10
        },
        email: {
            email: true
        },
        date: {
            dateISO: true
        },
        year: {
            digits: true,
            minlength: 4,
            maxlength: 4
        },
        int: {
            digits: true
        },
        decimal: {
            number: true
        },
        url: {
            url: true
        },
        document: {
            filesize: 20
        },
        image: {
            filesize: 2,
            accept: "image/*"
        },
        //custom class rules
        username: {
            required: function () {
                if ($("#pass").val() == '' && $("#passcon").val() == '') {
                    return false;
                } else {
                    return true;
                }
            },
            remote: {
                url: "check-username",
                type: "post",
                data: {
                    username: function () {
                        return $("#username").val();
                    }
                }
            }
        },
        passowrd: {
            required: function () {
                if ($("#username").val() == '') {
                    return false;
                } else {
                    return true;
                }
            },
        },
        confirm_password: {
            equalTo: '#pass'
        }
    }
    );
});
