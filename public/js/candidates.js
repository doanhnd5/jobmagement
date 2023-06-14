$(function() {
    $(document).on('click', '.btn-confirm-contact', function() {
        const url = $(this).data('url');
        const msg = $(this).data('cfm-msg');
        confirm(this, msg, url)
    });

    $(document).on('change', '#ddlContactStatus', function() {
        search($(this).data('url'));
    });

    $(document).on('click', '#btnSearch', function() {
        search($(this).data('url'));
    });

    $(document).on('keydown', '.remark', function(e) {
        if (e.keyCode === 13) {
            e.preventDefault();
            const crmMsg = $(this).data('cfm-msg');
            const url = $(this).data('url');
            confirm(this, crmMsg, url)
        }
    });
});

function confirm(item, crmMsg, url) {
    const id     = $(item).data('id');
    const remark = $(item).closest('tr').find('input[class*="remark"]').val();
    confirmExPromiseInfo(crmMsg).then(function() {
        openLoading();
        const param = {};
        param['id'] = id;
        param['date_time_display'] = $('#txtDateDisplay').val();
        param['name']              = $('#txtName').val();
        param['phone_number']      = $('#txtPhoneNumber').val();
        param['email']             = $('#txtEmail').val();
        param['contact_status']    = $('#ddlContactStatus').val();
        param['remark']            = remark;

        $.ajax({
            url      : url,
            type     : 'POST',
            data     : param,
            dataType : 'json'
        }).done(function (data) {
            if (data.status == PROCESS_STATUS_SUCCESS) {
                alertExPromiseSuccess(data.alertMsg).then(function() {
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
        }).always(function(data) {
            closeLoading();
        });
    }).catch(function(e) {});
}


function search(url) {
    // Loading
    openLoading();
    const param = {};
    param['name']              = $('#txtName').val();
    param['phone_number']      = $('#txtPhoneNumber').val();
    param['email']             = $('#txtEmail').val();
    param['job_name']          = $('#txtJobName').val();
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
