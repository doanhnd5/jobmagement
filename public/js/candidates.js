$(function() {
    $(document).on('click', '.btn-confirm-contact', function() {
        const id  = $(this).data('id');
        const url = $(this).data('url');
        confirmExPromiseInfo($(this).data('cfm-msg')).then(function() {
            const param = {};
            param['id'] = id;
            param['date_time_display'] = $('#txtDateDisplay').val();
            param['name']              = $('#txtName').val();
            param['phone_number']      = $('#txtPhoneNumber').val();
            param['email']             = $('#txtEmail').val();
            param['contact_status']    = $('#ddlContactStatus').val();

            $.ajax({
                url      : url,
                type     : 'POST',
                data     : param,
                dataType : 'json'
            }).done(function (data) {
                if (data.status == PROCESS_STATUS_SUCCESS) {
                    alertExPromiseSuccess(data.alertMsg).then(function(){
                        $('#divTableList').html(data.htmCandidatesArea);
                    });
                } else if (data.status == PROCESS_STATUS_ERROR) {
                    resetErrorMsg('#formBox');
                    if (data.errorMsg) {
                        setErrorMsgListRegist(data.errorMsg);
                    } else {
                        alertExPromiseError(data.alertMsg);
                    }
                } else {
                    alertExPromiseError(data.alertMsg);
                }
            }).fail(function (data) {
                showMessageFail(data.status);
            })
        }).catch(function(e) {});
    });

    $(document).on('change', '#ddlContactStatus', function() {
        search($(this).data('url'));
    });

    $(document).on('click', '#btnSearch', function() {
        search($(this).data('url'));
    });
});

function search(url) {
    // Loading
    openLoading();
    const param = {};
    param['name']              = $('#txtName').val();
    param['phone_number']      = $('#txtPhoneNumber').val();
    param['email']             = $('#txtEmail').val();
    param['contact_status']    = $('#ddlContactStatus').val();
    $.ajax({
        url      : url,
        type     : 'POST',
        data     : param,
        dataType : 'json'
    }).done(function (data) {
        if (data.status == PROCESS_STATUS_SUCCESS) {
            $('#divTableList').html(data.htmCandidatesArea);
        } else if (data.status == PROCESS_STATUS_ERROR) {
            alertExPromiseError(data.alertMsg).then(() => {
                window.location.href = data.url;
            });
        } else {
            alertExPromiseError(data.alertMsg);
        }
    }).fail(function (data) {
        showMessageFail(data.status);
    }).always(function(data) {
        closeLoading();
    });
}
