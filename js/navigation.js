jQuery(document).ready(function($){
    $('#mobile-menu-toggle').click(function() {
        $('.fa-bars').toggle();
        $('.fa-times').toggle();
        $('#mobile-menu').toggleClass('hidden');
    });

    $('.menu-item-has-children > a').click(function(e) {
        e.preventDefault();
        $(this).siblings('.sub-menu').toggleClass('show');
        $(this).toggleClass('active');
    });
});
