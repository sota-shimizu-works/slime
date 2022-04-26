$(function () {
    $('#wp-admin-bar-debug-dtn').on('click', function () {
        $('#debug-kit').toggleClass('active');
    });

    $('.head-ul li').on('click', function () {
        let index = $(this).data('index');
        $('.head-ul li').removeClass('active');
        $('.value-ul li').removeClass('active');
        $('.head-ul li[data-index="' + index + '"]').addClass('active');
        $('.value-ul li[data-index="' + index + '"]').addClass('active');
    });
});