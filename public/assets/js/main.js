
document.addEventListener('DOMContentLoaded', function () {
    const menuToggle = document.querySelectorAll('.menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');

    menuToggle.forEach(toggle => {
        toggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('menu-open');
        });
    });
}); 