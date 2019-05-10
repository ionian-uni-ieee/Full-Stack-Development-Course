<?php

require('functions.php');

function logout() {
    unset($_SESSION['login']);
    redirect("/");
}

logout();

?>
