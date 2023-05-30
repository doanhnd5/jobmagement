
let urlParamIndex = {};

$(function() {

    setUrlParamIndexSearchList();

    $(document).on('keydown', '#txtKeyAny', function(e) {
        e.stopPropagation();
        if (e.keyCode === 13) {
            search($(this).data('url'));
        }
    });

    $(document).on('click', '#btnSearch', function() {
        search($(this).data('url'));
    });

    $(document).on('click', 'a', function(e) {
        openLoading();
        e.preventDefault();
        window.location.href = $(this).attr('href');
    });

    $(document).on('click', '#btnSearch', function() {
        search($(this).data('url'));
    });

    $(document).on('click', '#list_job figure', function(e) {
        openLoading();
        window.location.href = $(this).data('url');
    });
});

function search(url) {
    // Loading
    openLoading();
    let reqData = setUrlParamIndexSearchList();
    $.ajax({
        url      : url,
        type     : 'POST',
        data     : reqData,
        dataType : 'json'
    }).done(function (data) {
        if (data.status == PROCESS_STATUS_SUCCESS) {
            $('#divWorkBasic ul').html(data.htmlJobWorkBasicArea);
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

function getAddParamSearchList() {
    const param = {};
    param['srchArea']    = $('#ddlArea').val();
    param['srchJobType'] = $('#ddlJobType').val();
    param['srchKeyAny']  = $('#txtKeyAny').val();
    param['srchTag']     = $('#ddlTag').val();
    return param;
}

function setUrlParamIndex(pKey, pVal) {
    urlParamIndex[pKey] = pVal;
}

function setUrlParamIndexSearchList() {
    let reqData = getAddParamSearchList();
    $.each(reqData, function (index, value) {
        setUrlParamIndex(index, value);
    });
    return reqData;
}

