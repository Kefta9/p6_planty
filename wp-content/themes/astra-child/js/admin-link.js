document.addEventListener("DOMContentLoaded", function () {
    const adminLink = document.querySelector('.menu-admin');
    const mobileMenu = document.getElementById('ast-hf-mobile-menu');

    if (adminLink && mobileMenu) {
        // Vérifie si le lien admin est déjà présent dans le menu mobile
        if (!mobileMenu.querySelector('.menu-admin')) {
            const clone = adminLink.cloneNode(true);
            mobileMenu.insertBefore(clone, mobileMenu.children[1]);
        }
    }
});
