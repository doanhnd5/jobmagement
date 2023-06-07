let urlParamIndex = {
    '_token' : $('meta[name="csrf-token"]').attr('content'),
    'page'   : getUrlParam('page'),
};

$(function() {

    setUrlParamIndexSearchList();

    $(document).on('click', '#btnCreatePost', function() {
        // Loading
        openLoading();
        const url = $(this).data('url');
        window.location.href = url;
    });

    $(document).on('click', '.detail', function(e) {
        // Loading
        openLoading();
        e.preventDefault();
        let url = $(this).attr('href');
        transitionScreenListToDetail(url);
    });

    $(document).on('click', '#btnSearch', function(e) {
        // Loading
        openLoading();
        setUrlParamIndex('page', null);
        let reqData = setUrlParamIndexSearchList();
        reqData['page'] = urlParamIndex['page'];
        $.ajax({
            url      : $(this).data('url'),
            type     : 'POST',
            data     : reqData,
            dataType : 'json'
        }).done(function (data) {
            if (data.status == PROCESS_STATUS_SUCCESS) {
                $('#divTableList').html(data.htmlTableArea);
            } else {
                alertExPromiseError(data.alertMsg).then(function() {
                    if (data.url) {
                        window.location.href = data.url;
                    }
                });
            }
        }).fail(function (data) {
            showMessageFail(data.status);
        }).always(function(data) {
            closeLoading();
        });
    });

    $(document).on('click', '.btn-delete', function(e) {
        e.preventDefault();
        const postId = $(this).data('id');
        const url   = $(this).attr('href');
        confirmExPromiseInfo($(this).data('cfm-msg')).then(function() {
            // Loading
            openLoading();
            const param = {};
            param['id'] = postId;
            $.ajax({
                url      : url,
                type     : 'POST',
                data     : param,
                dataType : 'json'
            }).done(function (data) {
                if (data.status == PROCESS_STATUS_SUCCESS) {
                    alertExPromiseSuccess(data.alertMsg).then(function() {
                        // Loading
                        openLoading();
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
        }).catch(function(e) {});
    });

    $(document).on('click', '.btn-publish', function() {
        const id  = $(this).data('id');
        const url = $(this).data('url');
        confirmExPromiseInfo($(this).data('cfm-msg')).then(function() {
            openLoading();
            const param = {};
            param['id'] = id;
            param['date_time_display'] = $('#txtDateDisplay').val();
            param['post_title']        = $('#txtPostTitle').val();

            $.ajax({
                url      : url,
                type     : 'POST',
                data     : param,
                dataType : 'json'
            }).done(function (data) {
                if (data.status == PROCESS_STATUS_SUCCESS) {
                    alertExPromiseSuccess(data.alertMsg).then(function(){
                        $('#divTableList').html(data.htmlTableArea);
                    });
                } else if (data.status == PROCESS_STATUS_ERROR) {
                    alertExPromiseError(data.alertMsg);
                }
            }).fail(function (data) {
                showMessageFail(data.status);
            }).always(function(data) {
                closeLoading();
            });
        }).catch(function(e) {});
    });
});

function transitionScreenListToDetail(pUrl) {
    pUrl = setUrlParam(pUrl, urlParamIndex);
    window.location.href = pUrl;
}

function getAddParamSearchList() {
    let reqData = {};
    reqData['srchPostTitle'] = $('#txtPostTitle').val();
    return reqData;
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
