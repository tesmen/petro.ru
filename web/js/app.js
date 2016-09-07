$(function() {
    $('.image_pop').on('click', function(e) {
        e.preventDefault();
        $('.imagepreview').attr('src', $(this).find('img').attr('src'));
        $('#imagemodal').modal('show');
    });
});