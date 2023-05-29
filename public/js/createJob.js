let urlParamIndex = {
    '_token' : $('meta[name="csrf-token"]').attr('content'),
    'page'   : getUrlParam('page'),
};

$(function() {

    let urlParamSearchKeyList = [
        'srchJobArea',
        'srchEmploymentType',
    ];

    urlParamSearchKeyList.forEach(value => {
        setUrlParamIndex(value, getUrlParam(value));
    });

    $(document).on('click', '#btnRegist', function() {
        confirmExPromiseInfo($(this).data('cfm-msg')).then(function() {
            // Loading
            openLoading();
            const param = {};
            param['id']                   = $('#txtJobId').val();
            param['date_time_display']    = $('#txtDatetimeDisplay').val();
            param['job_name']             = $('#txtJobName').val();
            param['employment_type_id']   = $('#ddlEmployeeType').val();
            param['workplace_prefecture'] = $('#ddlJobArea').val();
            param['tag']                  = $('input[name="chkTag"]:checked').map((index, item) => { return $(item).val() }).get();
            param['workplace_city']       = $('#txtWorkPlaceCity').val();
            param['work_time_from']       = getTimeParam('#txtWorkTimeFrom');
            param['work_time_to']         = getTimeParam('#txtWorkTimeTo');
            param['salary']               = $('#txtSalary').val();
            param['description']          = $('#txtDescription').val();
            param['company_name']         = $('#txtCompany').val();

            $.ajax({
                url      : $('#btnRegist').data('url'),
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
    setErrorMsg(errMstList['job_name'], '#txtJobName', className);
    setErrorMsg(errMstList['employment_type_id'], '#ddlEmployeeType', className);
    setErrorMsg(errMstList['workplace_city'], '#txtWorkPlaceCity', className);
    setErrorMsg(errMstList['workplace_prefecture'], '#ddlJobArea', className);
    setErrorMsg(errMstList['company_name'], '#txtCompany', className);
    setErrorMsg(errMstList['tag'], '#ddlTag', className);
    setErrorMsg(errMstList['salary'], '#txtSalary', className);
    setErrorMsg(errMstList['work_time_from'], '#txtWorkTimeFrom', className);
    setErrorMsg(errMstList['work_time_to'], '#txtWorkTimeFrom', className);
    setErrorMsg(errMstList['description'], '#txtDescription', className);
}

function addUrlParamToBackPageLnk(pUrl) {
    let url = setUrlParam(pUrl, urlParamIndex);
    return url;
}

function setUrlParamIndex(pKey, pVal) {
    urlParamIndex[pKey] = pVal;
}
