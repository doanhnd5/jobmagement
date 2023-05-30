

$(function() {
    $(document).on('click', '#list_job figure', '' , function(e) {
        openLoading();
        window.location.href = $(this).data('url');
    });

    $(document).on('click', '#list_job .detailBtn ', function(e) {
        e.preventDefault();
        openLoading();
        window.location.href = $(this).attr('href');
    });
});
