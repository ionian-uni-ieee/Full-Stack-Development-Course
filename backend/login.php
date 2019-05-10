<?php

// One level up
require("../functions.php");

// Verify request method is POST (GET encodes key-values on URL - unsafe!)
if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    redirect("/login.php");
}

// If the requested parameters are not set, redirect to login page
if ( !isset($_POST['username']) || !isset($_POST['password']) ) {
    redirect("/login.php");
}

// If username or password are empty, set error and redirect to login page
if ($_POST['username'] === "" || $_POST['password'] === "") {
    error("EMPTY_USERNAME_OR_PASSWORD");
    redirect("/login.php");
}

// Make sure account exists
if (!file_exists($_SERVER['DOCUMENT_ROOT'] . "/users/" . $_POST['username'] . ".json")) {
    error("ACCOUNT_DOES_NOT_EXIST");
    redirect("/login.php");
}

// Read user data and decode the json into a dictionary
$userdata = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/users/" . $_POST['username'] . ".json");
// Decode json into associative array
$userdata = json_decode($userdata, true);

// Get password hash from the user data
$password_hash = $userdata['password_hash'];

// Verify password hash matches the given password
if (password_verify($_POST['password'], $password_hash) === false) {
    error("INCORRECT_PASSWORD");
    redirect("/login.php");
}

// username and password correct, log the user in!
$_SESSION['login'] = $_POST['username'];

// Redirect to admin area
redirect("/admin.php");
