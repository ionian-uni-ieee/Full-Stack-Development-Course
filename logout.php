<?php

function logout() {
    unset($_SESSION['login']);
    redirect("/");
}

function getProtocol() {
    if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) {
        return "https";
    }
    else {
        return "http";
    }
}

function redirect($path) {
    $protocol = getProtocol();
    $domain = $_SERVER['HTTP_HOST'];
    header("Location: $protocol://$domain$path");
    exit;
}

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

logout();

?>