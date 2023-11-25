document.addEventListener('DOMContentLoaded', function() {
    const menu = document.getElementById('menu-label');
    const sidebar = document.querySelector('.sidebar');
    const navbar = document.querySelector('.navbar');
    const content = document.querySelector('.content');

    menu.addEventListener('click', function() {
        menu.classList.toggle('active');
        sidebar.classList.toggle('hide');

        const isSidebarVisible = !sidebar.classList.contains('hide');

        if (isSidebarVisible) {
            navbar.style.marginLeft = '260px'; 
            content.style.marginLeft = '260px'; 
        } else {
            navbar.style.marginLeft = '0';
            content.style.marginLeft = '0';
        }

        console.log('ok');
    });
});
