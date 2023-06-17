
const MESSAGE_DIALOG_TYPE_DEFAULT = 0;
const MESSAGE_DIALOG_TYPE_INFO    = 1;
const MESSAGE_DIALOG_TYPE_SUCCESS = 2;
const MESSAGE_DIALOG_TYPE_ERROR   = 4;
const MESSAGE_DIALOG_TYPE_TITLEBAR_CLASS = {
    [MESSAGE_DIALOG_TYPE_DEFAULT] : '',
    [MESSAGE_DIALOG_TYPE_INFO]    : 'ui-dialog-titlebar-info',
    [MESSAGE_DIALOG_TYPE_SUCCESS] : 'ui-dialog-titlebar-success',
    [MESSAGE_DIALOG_TYPE_ERROR]   : 'ui-dialog-titlebar-error',
};

const PROCESS_STATUS_SUCCESS = 'success';
const PROCESS_STATUS_ERROR   = 'error';

$(function() {

    window.addEventListener('pageshow', function(event) {
        closeLoading();
    });

    window.addEventListener("pagehide", function(event) {
        closeLoading();
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.form-input-time').on('focusin', function(e) {
        focusIn(this);
    });

    $('.form-input-time').on('focusout', function(e) {
        let hhMMIIList = getTimeHHMMIIArr(this, $(this).val());
        $(this).val(hhMMIIList.join(':'));
    });

    $('#btnShowModalChangePassword').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        $('#modalChangePassword').removeClass('hidden');
    });

    $('#btnCloseModal').on('click', function(e) {
        $('#modalChangePassword').addClass('hidden');
    });

    window.onclick = function(e) {
        if (e.target.id === "modalChangePassword") {
            $('#modalChangePassword').addClass('hidden');
        }
    }

    $(document).on('click', '#btnChangePassword', function() {
        confirmExPromiseInfo($(this).data('cfm-msg')).then(function() {
            openLoading();
            let reqData = {};
            reqData['email']            = $('#txtMdlEmail').val();
            reqData['current_password'] = $('#txtCurrentPassword').val();
            reqData['new_password']     = $('#txtNewPassword').val();
            $.ajax({
                url      : $('#btnChangePassword').data('url'),
                type     : 'POST',
                data     : reqData,
            }).done(function (data) {
                if (data.status == PROCESS_STATUS_SUCCESS) {
                    alertExPromiseSuccess(data.alertMsg).then(function() {
                        $('#modalChangePassword').addClass('hidden');
                    });
                } else if (data.status == PROCESS_STATUS_ERROR) {
                    resetErrorMsg('#modalChangePassword');
                    if (data.errorMsg) {
                        const errMstList = data.errorMsg;
                        setErrorMsg(errMstList['email'], '#txtMdlEmail', 'mdl-change-password');
                        setErrorMsg(errMstList['current_password'], '#txtCurrentPassword', 'mdl-change-password');
                        setErrorMsg(errMstList['new_password'], '#txtNewPassword', 'mdl-change-password');
                    }
                } else {
                    alertExPromiseError(data.alertMsg).then(() => {
                        openLoading();
                        window.location.href = data.url;
                    });
                }
            }).fail(function (data) {
                showMessageFail(data.status);
            }).always(function(data) {
                closeLoading();
            });
        }).catch(function(e) {});
    })
});

function openLoading() {
    $('#spinerLoading').removeClass('hidden');
}

function closeLoading() {
    $('#spinerLoading').addClass('hidden');
}

function focusIn(input) {
    let timeVal = $(input).val();
    if (timeVal) {
        timeVal = timeVal.replace(/[^\w\s]/gi, '');
        $(input).val(timeVal);
    }
}

function getTimeHHMMIIArr(targetInput, timeVal) {
    if (!timeVal || timeVal.match(/[^\d]/)) {
        return new Array();
    }
    let maxLength = $(targetInput).attr('maxlength');
    if (!maxLength) {
        maxLength = 4;
    }
    if (timeVal.length < maxLength) {
        timeVal = timeVal.padStart(maxLength, '0');
    }
    let result = getTimeInArrCommon(timeVal, maxLength);
    result.push('00');
    return caclTime(result);
}

function caclTime(timeInArray) {
    let timeInSeconds = timeInArray.reduce((acc, curr) => acc * 60 + + curr, 0);
    return convertSecondTime(timeInSeconds);
}

function convertSecondTime(timeInSeconds) {
    let hours = Math.floor(timeInSeconds / 3600).toString().padStart(2, 0);
    let minutes = Math.floor(timeInSeconds % 3600 / 60).toString().padStart(2, 0);
    return [hours, minutes];
}


function getTimeInArrCommon(strTime, maxLength) {
    let result      = [];
    let countSubStr = maxLength / 2;
    for (let index = 0; index < countSubStr; index++) {
        result.push(strTime.substr(index * 2, 2));
    }
    return result;
}

function getTimeParam(targetEle) {
    return $(targetEle).val().replace(/[^\w\s]/gi, '');
}

function getUrlParam(pName, pUrl = null) {
    let url = window.location.href;
    if (pUrl != null) {
        url = pUrl;
    }
    pName = pName.replace(/[\[\]]/g, "\\$&");
    let regex = new RegExp("[?&]" + pName + "(=([^&#]*)|&|#|$)"),
    results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}

function setUrlParam(url, pUrlParam) {
    let params = [];
    $.each(pUrlParam, function (index, value) {
        if (value != null && value != '') {
            if (Array.isArray(value)) {
                value.forEach(function (value) {
                    params.push(encodeURIComponent(index) + '=' + encodeURIComponent(value));
                });
            } else {
                params.push(encodeURIComponent(index) + '=' + encodeURIComponent(value));
            }
        }
    });
    if (params.length) {
        url += '?' + params.join('&');
    }
    return url;
}

function confirmExPromise(message, msgType, isSelectionCancel = false) {
    let _showConfirmDialog = function(message, okFunction, cancelFunction) {
        let _destroyDialog = function(dialogElement) {
            dialogElement.dialog('destroy');
            dialogElement.remove();
        };

        let $dialog = $('<div class="text-left"></div>').html(message.replace(/\r?\n/g, '<br>'));

        let _funcOk     = null;
        let _funcCancel = null;
        {
            _funcOk     = function() { _destroyDialog($dialog); if (okFunction)     { okFunction();     } };
            _funcCancel = function() { _destroyDialog($dialog); if (cancelFunction) { cancelFunction(); } };
        }

        $dialog.dialog({
            modal     : true,
            title     : 'Confirm',
            minWidth  : 400,
            minHeight : 200,

            closeText     : 'Cancel',
            closeOnEscape : true,
            close         : _funcCancel,

            classes : {
                "ui-dialog-titlebar" : MESSAGE_DIALOG_TYPE_TITLEBAR_CLASS[msgType]
            },
            buttons: [
                { text: 'Yes',   class: 'ui-button ui-corner-all ui-widget', click: _funcOk ,},
                { text: 'No', class: 'ui-button ui-corner-all ui-widget', click: function() { $(this).dialog('close'); } }
            ],

            open: function() {
                if (isSelectionCancel == true) {
                    $( this ).siblings('.ui-dialog-buttonpane').find('button:eq(1)').focus();
                } else {
                    $( this ).siblings('.ui-dialog-buttonpane').find('button:eq(0)').focus();
                }

                $(this).closest('.ui-dialog')
                    .find('.ui-dialog-titlebar .ui-dialog-titlebar-close')
                    .addClass('ui-button ui-corner-all ui-widget ui-button-icon-only')
                    .html('<span class="ui-button-icon ui-icon ui-icon-closethick"></span><span class="ui-button-icon-space"></span>');
            }
        });
    };

    return new Promise(function(resolve, reject) {
        _showConfirmDialog(message, resolve, reject);
    });
}

function alertExPromise(message, msgType) {
    let _showConfirmDialog = function(message, okFunction) {
        let _destroyDialog = function(dialogElement) {
            dialogElement.dialog('destroy');
            dialogElement.remove();
        };

        let $dialog = $('<div class="text-left"></div>').html(message.replace(/\r?\n/g, '<br>'));

        let _funcOk = null;
        {
            _funcOk = function() { _destroyDialog($dialog); if (okFunction) { okFunction();} };
        }

        $dialog.dialog({
            modal    : true,
            title    : 'Message',
            minWidth : 400,
            minHeight: 200,

            closeText    : 'Cancel',
            closeOnEscape: true,
            close        : _funcOk,

            classes : {
                "ui-dialog-titlebar" : MESSAGE_DIALOG_TYPE_TITLEBAR_CLASS[msgType]
            },

            buttons: [
                { text: 'OK', class: 'ui-button ui-corner-all ui-widget', click: _funcOk ,},
            ],

            open: function() {
                $(this).closest('.ui-dialog')
                    .find('.ui-dialog-titlebar .ui-dialog-titlebar-close')
                    .addClass('ui-button ui-corner-all ui-widget ui-button-icon-only')
                    .html('<span class="ui-button-icon ui-icon ui-icon-closethick"></span><span class="ui-button-icon-space"></span>');
            }

        });
    };

    return new Promise(function(resolve, reject) {
        _showConfirmDialog(message, resolve, reject);
    });
}

function showMessageFail(pStatus) {
    let msg = 'Phát sinh lỗi hệ thống。\r\n (status:' + pStatus + ') ';
    alertExPromiseError(msg);
}

function confirmExPromiseInfo(message) {
    return confirmExPromise(message, MESSAGE_DIALOG_TYPE_INFO);
}

function alertExPromiseSuccess(message) {
    return alertExPromise(message, MESSAGE_DIALOG_TYPE_SUCCESS);
}

function alertExPromiseError(message) {
    return alertExPromise(message, MESSAGE_DIALOG_TYPE_ERROR);
}

function setErrorMsg(pValue, pInputArea, className) {
    if (pValue) {
        const pDisplayArea = $(pInputArea).parents('div[class='+ className +']');
        $(pDisplayArea).append('<p class="mt-1 text-[#ff5b5b] bg-[#ffebeb]" style="margin-bottom: 0px;">' + pValue + '</p>');
    }
}

function resetErrorMsg(parent) {
    const pDisplayArea = $(parent);
    pDisplayArea.find('p[class*="text-[#ff5b5b]"]').remove();
}





