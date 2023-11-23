document.addEventListener('DOMContentLoaded', function() {
    const menu = document.getElementById('menu-label');
    const sidebar = document.querySelector('.sidebar');
    const navbar = document.querySelector('.navbar');
    const content = document.querySelector('.content');

    menu.addEventListener('click', function() {
        menu.classList.toggle('active');
        sidebar.classList.toggle('hide');

        // Check if the sidebar is visible
        const isSidebarVisible = !sidebar.classList.contains('hide');

        // Update the styles of the navbar and content based on sidebar visibility
        if (isSidebarVisible) {
            navbar.style.marginLeft = '260px'; // Adjust this value based on your sidebar width
            content.style.marginLeft = '260px'; // Adjust this value based on your sidebar width
        } else {
            navbar.style.marginLeft = '0';
            content.style.marginLeft = '0';
        }

        console.log('ok');
    });
});
