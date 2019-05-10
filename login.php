<?php

require('functions.php');

// Redirect to admin area is user is logged in
if (isset($_SESSION['login'])) {
    redirect("/admin.php");
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <link rel="stylesheet" type="text/css" href="/css/reset.css">
        <link rel="stylesheet" type="text/css" href="/css/style.css">
    </head>
    <body>
        <a href="/">Home</a>
        <div id="login">
            <form action="/backend/login.php" method="post">
                <input class="username" name="username" type="text">
                <input class="password" name="password" type="password">
                <button class="submit-btn" type="submit">Login</button>
            </form>
            <span><?php echo getError(); ?>
        </div>
    </body>
</html>
