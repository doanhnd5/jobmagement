

$(function() {
    $(document).on('click', '#list_post figure', function(e) {
        openLoading();
        window.location.href = $(this).data('url');
    });

    $(document).on('click', '.detailBtn', function(e) {
        e.preventDefault();
        openLoading();
        window.location.href = $(this).attr('href');
    });
});
