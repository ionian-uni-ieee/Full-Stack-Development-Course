<?php

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

// Redirect to login page and stop execution if not logged in
if (!isset($_SESSION['login'])) {
    redirect("/login");
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
        <a href="/">Home</a>
        <a href="/logout">Logout</a>

        Admin Area
    </body>
</html>
