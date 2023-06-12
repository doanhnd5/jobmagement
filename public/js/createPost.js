let urlParamIndex = {
    '_token' : $('meta[name="csrf-token"]').attr('content'),
    'page'   : getUrlParam('page'),
};

$(function() {

    // TODO
    // ClassicEditor.create(document.querySelector('#txtPostContent'), {
    //     language: 'vi',
    // });

    let urlParamSearchKeyList = [
        'srchPostTitle'
    ];

    urlParamSearchKeyList.forEach(value => {
        setUrlParamIndex(value, getUrlParam(value));
    });

    $(document).on('click', '#btnRegist', function() {
        confirmExPromiseInfo($(this).data('cfm-msg')).then(function() {
            // Loading
            openLoading();
            let imageEle    = document.getElementById('txtImage');
            let formData    = new FormData();
            let registParam = getRegistParam();
            let imageFile   = imageEle.files[0];
            formData.append('image', imageFile);
            formData.append('paramRegist', JSON.stringify(registParam));

            $.ajax({
                url      : $('#btnRegist').data('url'),
                type     : 'POST',
                data     : formData,
                contentType: false,
                enctype: 'multipart/form-data',
                processData: false,
            }).done(function (data) {
                if (data.status == PROCESS_STATUS_SUCCESS) {
                    alertExPromiseSuccess(data.alertMsg).then(function() {
                        // Loading
                        openLoading();
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

function getRegistParam() {
    const param = {};
    param['id']                = $('#txtPostId').val();
    param['date_time_display'] = $('#txtDatetimeDisplay').val();
    param['post_title']        = $('#txtPostTitle').val();
    param['post_content']      = $('#txtPostContent').val();
    return param;
}

function setErrorMsgListRegist(errMstList) {
    const className = 'mb-6';
    setErrorMsg(errMstList['post_title'], '#txtPostTitle', className);
    setErrorMsg(errMstList['post_content'], '#txtPostContent', className);
}

function addUrlParamToBackPageLnk(pUrl) {
    let url = setUrlParam(pUrl, urlParamIndex);
    return url;
}

function setUrlParamIndex(pKey, pVal) {
    urlParamIndex[pKey] = pVal;
}

function loadFile(event) {
    const output = document.getElementById('preview_img');
    $(output).removeClass('hidden');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
        URL.revokeObjectURL(output.src);
    }
}
