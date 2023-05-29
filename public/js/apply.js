let urlParamIndex = {
    '_token' : $('meta[name="csrf-token"]').attr('content'),
    'page'   : getUrlParam('page'),
};

$(function() {

    let urlParamSearchKeyList = [
        'srchJobArea',
        'srchEmploymentType',
        'srchTag',
    ];

    urlParamSearchKeyList.forEach(value => {
        setUrlParamIndex(value, getUrlParam(value));
    });

    $(document).on('click', '#btnApply', function() {
        confirmExPromiseInfo($(this).data('cfm-msg')).then(function() {
            // Loading
            openLoading();
            const param = {};
            param['id']                = $('#txtJobId').val();
            param['first_name']        = $('#txtFirstName').val();
            param['last_name']         = $('#txtLastName').val();
            param['email']             = $('#txtEmail').val();
            param['phone_number']      = $('#txtPhoneNumber').val();
            param['residence']         = $('#txtResidence').val();
            param['japanese_skill_id'] = $('#txtJapaneseSkill').val();
            param['facebook_url']      = $('#txtFacebookUrl').val();
            param['address']           = $('#txtAddress').val();
            param['gender']            = $('input[name="rdoGender"]:checked').val();
            param['date_of_birth']     = getDateOfBirth();

            $.ajax({
                url      : $('#btnApply').data('url'),
                type     : 'POST',
                data     : param,
                dataType : 'json'
            }).done(function (data) {
                if (data.status == PROCESS_STATUS_SUCCESS) {
                    alertExPromiseSuccess(data.alertMsg).then(function(){
                        window.location.href = data.url;
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
    });

    $('#btnBack').click(function(e) {
        // Loading
        openLoading();
        let url = $(this).data('url');
        url = addUrlParamToBackPageLnk(url);
        window.location.href = url;
    });

});

function setErrorMsgListRegist(errMstList) {
    const className = 'mb-6';
    setErrorMsg(errMstList['first_name'], '#txtFirstName', className);
    setErrorMsg(errMstList['last_name'], '#txtLastName', className);
    setErrorMsg(errMstList['email'], '#txtEmail', className);
    setErrorMsg(errMstList['phone_number'], '#txtPhoneNumber', className);
    setErrorMsg(errMstList['residence'], '#txtResidence', className);
    setErrorMsg(errMstList['japanese_skill_id'], '#txtJapaneseSkill', className);
    setErrorMsg(errMstList['facebook_url'], '#txtFacebookUrl', 'mb-0');
    setErrorMsg(errMstList['address'], '#txtAddress', className);
    setErrorMsg(errMstList['gender'], 'input[name="rdoGender"]', className);
    setErrorMsg(errMstList['date_of_birth'], '#ddlBirthDay', className);
}

function addUrlParamToBackPageLnk(pUrl) {
    let url = setUrlParam(pUrl, urlParamIndex);
    return url;
}

function setUrlParamIndex(pKey, pVal) {
    urlParamIndex[pKey] = pVal;
}

function getDateOfBirth() {
    const date = $('#ddlBirthDay').val();
    const month = $('#ddlBirthMonth').val();
    const year = $('#ddlBirthYear').val();
    return [year, month, date].join('/');
}
