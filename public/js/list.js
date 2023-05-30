

$(function() {
    $(document).on('click', '#list_job figure', function(e) {
        openLoading();
        window.location.href = $(this).data('url');
    });
});
