var contact_count = 10;
var edu_count = 10;
var lang_count = 10;
var cer_count = 10;
var id_count = 10;
var allow_count = 10;
var insur_count = 10;
var nat_count = 10;
var family_count = 10;
var att_count = 10;

$('body').on('click', '.add_something', function () {
    if ($(this).hasClass("edu_degree")) {
        edu_count++;
        var str = $('#edu_temp').html().replace(/:num/g, edu_count);
        $(str).appendTo($(this).parent().parent().parent(".something_container"));
    } else if ($(this).hasClass("phone")) {
        contact_count++;
        var str = $('#phone_temp').html().replace(/:num/g, contact_count);
        $(str).appendTo($(this).parent().parent().parent(".something_container"));
    } else if ($(this).hasClass("address")) {
        contact_count++;
        var str = $('#address_temp').html().replace(/:num/g, contact_count);
        $(str).appendTo($(this).parent().parent().parent(".something_container"));
    } else if ($(this).hasClass("email")) {
        contact_count++;
        var str = $('#email_temp').html().replace(/:num/g, contact_count);
        $(str).appendTo($(this).parent().parent().parent(".something_container"));
    } else if ($(this).hasClass("social")) {
        contact_count++;
        var str = $('#social_temp').html().replace(/:num/g, contact_count);
        $(str).appendTo($(this).parent().parent().parent(".something_container"));
    }
    else if ($(this).hasClass("extraLang")) {
        lang_count++;
        var str = $('#lang_temp').html().replace(/:num/g, lang_count);
        $(str).appendTo($(this).parent().parent().parent(".something_container"));
    } else if ($(this).hasClass("certifcatee")) {
        cer_count++;
        var str = $('#cer_temp').html().replace(/:num/g, cer_count);
        $(str).appendTo($(this).parent().parent().parent(".something_container"));
    } else if ($(this).hasClass("extraid")) {
        id_count++;
        var str = $('#id_temp').html().replace(/:num/g, id_count);
        $(str).appendTo($(this).parent().parent().parent(".something_container"));
    } else if ($(this).hasClass("extrainsur")) {
        insur_count++;
        var str = $('#insur_temp').html().replace(/:num/g, insur_count);
        $(str).appendTo($(this).parent().parent().parent(".something_container"));
    } else if ($(this).hasClass("extranat")) {
        nat_count++;
        var str = $('#nat_temp').html().replace(/:num/g, nat_count);
        $(str).appendTo($(this).parent().parent().parent(".something_container"));
    } else if ($(this).hasClass("extraallow")) {
        allow_count++;
        var str = $('#allow_temp').html().replace(/:num/g, allow_count);
        $(str).appendTo($(this).parent().parent().parent(".something_container"));
        $("input[name='allowances[" + allow_count + "][type]']").uniform();
    } else if ($(this).hasClass("extrafamily")) {
        family_count++;
        var str = $('#family_temp').html().replace(/:num/g, family_count);
        $(str).appendTo($(this).parent().parent(".something_container"));
    } else if ($(this).hasClass("fnat")) {
        nat_count++;
        var fnum = $(this).attr('data');
        var str = $('#nat_temp').html().replace(/nationalities\[:num\]/g, 'family[' + fnum + '][nationalities][' + nat_count + ']');
        $(str).appendTo($(this).parent().parent().parent(".something_container"));
    } else if ($(this).hasClass("fid")) {
        id_count++;
        var fnum = $(this).attr('data');
        var str = $('#id_temp').html().replace(/ids\[:num\]/g, 'family[' + fnum + '][ids][' + id_count + ']');
        $(str).appendTo($(this).parent().parent().parent(".something_container"));
    } else if ($(this).hasClass("finsur")) {
        insur_count++;
        var fnum = $(this).attr('data');
        var str = $('#insur_temp').html().replace(/insurances\[:num\]/g, 'family[' + fnum + '][insurances][' + insur_count + ']');
        $(str).appendTo($(this).parent().parent().parent(".something_container"));
    } else if ($(this).hasClass("fadr")) {
        contact_count++;
        var fnum = $(this).attr('data');
        var str = $('#address_temp').html().replace(/contacts\[:num\]/g, 'family[' + fnum + '][contacts][' + contact_count + ']');
        $(str).appendTo($(this).parent().parent().parent(".something_container"));
    } else if ($(this).hasClass("fph")) {
        contact_count++;
        var fnum = $(this).attr('data');
        var str = $('#phone_temp').html().replace(/contacts\[:num\]/g, 'family[' + fnum + '][contacts][' + contact_count + ']');
        $(str).appendTo($(this).parent().parent().parent(".something_container"));
    } else if ($(this).hasClass("fatt")) {
        att_count++;
        var fnum = $(this).attr('data');
        var str = $('#fatt_temp').html().replace(/:name/g, 'family[' + fnum + '][attachments][' + att_count + ']');
        $(str).appendTo($(this).parent().parent(".something"));
    }

    $(".delete_something").click(function () {
        $(this).parent().parent().remove();
    })

});

