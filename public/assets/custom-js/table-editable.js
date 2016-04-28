$('body').on('click', '.editable .edit', function () {
    var table = $(this).parent().parent().parent().parent();
    var row = $(this).parent().parent();
    var edit_id = table.attr('data-edit');
    editRow(row, edit_id);
});

$('body').on('click', '.editable .save', function () {
    var table = $(this).parent().parent().parent().parent();
    var row = $(this).parent().parent();
    var lang = table.attr('data-lang');
    var link = table.attr('data-link-save');
    saveRow(row, link, lang);
});

$('body').on('click', '.editable .cancel', function () {
    var row = $(this).parent().parent();
    cancelRow(row);
});

$('body').on('click', '.editable .delete', function () {
    var table = $(this).parent().parent().parent().parent();
    var row = $(this).parent().parent();
    var lang = table.attr('data-lang');
    var link = table.attr('data-link-delete');
    deleteRow(row, link, lang);
});
function editRow(row, temp_id) {
    var temp = $('#' + temp_id);
    row.children().each(function (k, elm) {
        var cur = temp.children(':nth-child(' + (k + 1) + ')');
        if (cur.has('input').html()) {
            cur.children('input').attr('value', '');
            cur.children('input').attr('value', $(elm).text());
        } else if (cur.has('select').html()) {
            cur.children('select').children().each(function (k, val) {
                $(val).removeAttr('selected');
            });
            if ($(elm).text() != '')
                cur.children('select').children("option:contains('" + $(elm).text() + "')").attr('selected', true);
        }
    });

    row.data('old', row.html());
    row.html(temp.html());
}

function saveRow(row, link, lang) {
    var temp = $('<div>').append(row.data('old'));
    var data = {id: row.attr('data')};
    row.children().each(function (k, elm) {
        var cur = temp.children(':nth-child(' + (k + 1) + ')');
        if ($(elm).has('input').html()) {
            data[$(elm).children('input').attr('name')] = $(elm).children('input').val();
            if (cur.hasClass('none')) {
                cur.html('');
            } else {
                cur.html($(elm).children('input').val());
            }
        } else if ($(elm).has('select').html()) {
            data[$(elm).children('select').attr('name')] = $(elm).children('select').val();
            if (cur.hasClass('none')) {
                cur.html('');
            } else {
                if ($(elm).children('select').val() != "")
                    cur.html($(elm).children('select').children('option:selected').text());
                else
                    cur.html('');
            }
        }
    });

    if (lang == 'ar') {
        var msg = {
            title: 'تعديل البيانات',
            success: 'تم تعديل البيانات',
            error: 'لم يتمكن من تعديل البيانات'
        }
    } else {
        var msg = {
            title: 'Update',
            success: 'Updated Successfully',
            error: "Couldn't update the record"
        }
    }

    Metronic.blockUI({message: 'Processing...'});
    $.ajax({
        url: link,
        type: 'post',
        data: data,
        success: function (data) {
            Metronic.unblockUI();
            row.html(temp.html());
            toastr['success'](msg.success, msg.title);
        },
        error: function (err) {
            Metronic.unblockUI();
            //row.html(row.data('old'));
            toastr['error'](msg.error, msg.title);
        }
    });
}

function cancelRow(row) {
    row.html(row.data('old'));
}

function deleteRow(row, link, lang) {
    if (lang == 'ar') {
        var msg = {
            title: 'حذف',
            body: 'هل أنت متأكد من الحذف؟',
            cancel: 'الغاء',
            confirm: 'تأكيد',
            deleted: 'تم الحذف بنجاح',
            error: 'لم يتمكن من الحذف'
        }
    } else {
        var msg = {
            title: 'Delete',
            body: 'Are you sure?',
            cancel: 'Cancel',
            confirm: 'Confirm',
            deleted: 'Deleted Successfully',
            error: "Couldn't delete the record"
        }
    }
    var data = {id: row.attr('data')};
    swal({title: msg.title,
        text: msg.body,
        type: "warning",
        showCancelButton: true,
        cancelButtonText: msg.cancel,
        confirmButtonText: msg.confirm,
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
    }, function () {
        Metronic.blockUI({message: 'Processing...'});
        $.ajax({
            url: link,
            type: 'post',
            data: data,
            success: function (data) {
                Metronic.unblockUI();
                row.remove();
                swal.close();
                toastr['success'](msg.deleted, msg.title);
            },
            error: function (err) {
                Metronic.unblockUI();
                swal.close();
                toastr['error'](msg.error, msg.title);
            }
        });
    });
}