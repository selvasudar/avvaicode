$(document).ready(function () {
    
    $(".single-url-list h5").on('click', function () {
        $(this).parent(".single-url-list").toggleClass("active");
    });
});