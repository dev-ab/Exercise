var contact_count = 10;

$('body').on('click', '.add_something', function () {
    if ($(this).hasClass("phone")) {
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
    $(".delete_something").click(function () {
        $(this).parent().parent().remove();
    })

});



$(".individual_client").click(function () {
    ComponentsPickers.init();
    $("#entity_holder").html($("#ind_temp").html().replace(/ununiformed/g, 'uniform'));
    $(".uniform").uniform();
    $(".client_type").children("#ind").attr('selected', 'selected');
});

$(".organizaton_client").click(function () {
    ComponentsPickers.init();
    $("#entity_holder").html($("#org_temp").html());
    $(".client_type").children("#org").attr('selected', 'selected');
});

