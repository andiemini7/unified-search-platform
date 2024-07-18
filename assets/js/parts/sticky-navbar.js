document.addEventListener('DOMContentLoaded', function() {
    const navbar = document.getElementById('main-navbar');
    window.addEventListener('scroll', function() {
        if (window.scrollY > 0) {
            navbar.classList.add('sticky');
        } else {
            navbar.classList.remove('sticky');
        }
    });
});