<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (session_status() == PHP_SESSION_ACTIVE) {
    session_destroy();
    echo "
    <script>
        alert('Berhasil Logout!');
        document.location = 'index.php';
    </script>
    ";
}
