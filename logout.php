<?php
session_start();
session_unset();
session_destroy();

if (isset($_COOKIE['login_user'])) {
    setcookie('login_user', '', time() - 3600, "/");
    setcookie('id_user', '', time() - 3600, "/");
    setcookie('nama_user', '', time() - 3600, "/");
    setcookie('role_user', '', time() - 3600, "/");
}

header("Location: index.php");
exit;
?>