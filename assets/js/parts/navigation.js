function navigation($) {
    var mobileMenuToggle = $('#mobile-menu-toggle');
    var menuItemsWithChildren = $('.menu-item-has-children > a');

    $(document).ready(function() {
        mobileMenuToggle.click(function() {
            $('.fa-bars').toggle();
            $('.fa-times').toggle();
            $('#mobile-menu').toggleClass('hidden');
        });

        menuItemsWithChildren.click(function(e) {
            e.preventDefault();
            $(this).siblings('.sub-menu').toggleClass('show');
            $(this).toggleClass('active');
        });
    });
}

export default navigation;