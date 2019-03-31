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

function getError() {
    if (isset($_SESSION['error'])) {
        return $_SESSION['error'];
        unset($_SESSION['error']);
    }
    else {
        return false;
    }
}

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Redirect to admin area is user is logged in
if (isset($_SESSION['login'])) {
    redirect("/admin");
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
        <div id="login">
            <form action="/backend/login" method="post">
                <input class="username" name="username" type="text">
                <input class="password" name="password" type="password">
                <button class="submit-btn" type="submit">Login</button>
            </form>
            <span><?php echo getError(); ?>
        </div>
    </body>
</html>
