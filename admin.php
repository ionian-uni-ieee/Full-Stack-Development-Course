<?php

require('functions.php');

// Redirect to login page and stop execution if not logged in
if (!isset($_SESSION['login'])) {
    redirect("/login.php");
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <link rel="stylesheet" type="text/css" href="/css/style.css">
    </head>
    <body>
        <a href="/">Home</a>
        <a href="/logout.php">Logout</a>

        Admin Area
    </body>
</html>
