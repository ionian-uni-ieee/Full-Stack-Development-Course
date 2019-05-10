<?php

include('functions.php');

function logout() {
    unset($_SESSION['login']);
    redirect("/");
}


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

logout();

?>
