<?php

/*
 * Returns http or https depending on the enabled protocol on the web server
 */
function getProtocol() {
    if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) {
        return "https";
    }
    else {
        return "http";
    }
}

/*
 * Redirects the user on an absolute (from document root) path and stops execution.
 * "/" is document root
 */
function redirect($path) {
    $protocol = getProtocol();
    $domain = $_SERVER['HTTP_HOST'];
    header("Location: $protocol://$domain$path");
    exit;
}

/*
 * Set the error key on the session array
 */
function error($message) {
    $_SESSION['error'] = $message;
}

/*
 * Returns the error and unsets it
 */
function getError($message) {
    if (isset($_SESSION['error'])) {
        return $_SESSION['error'];
        unset($_SESSION['error']);
    }
    else {
        return false;
    }
}

// Start the session if it has not yet started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verify request method is POST (GET encodes key-values on URL - unsafe!)
if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    redirect("/login");
}

// If the requested parameters are not set, redirect to login page
if ( !isset($_POST['username']) || !isset($_POST['password']) ) {
    redirect("/login");
}

// If username or password are empty, set error and redirect to login page
if ($_POST['username'] === "" || $_POST['password'] === "") {
    error("EMPTY_USERNAME_OR_PASSWORD");
    redirect("/login");
}

// Make sure account exists
if (!file_exists($_SERVER['DOCUMENT_ROOT'] . "/users/" . $_POST['username'] . ".json")) {
    error("ACCOUNT_DOES_NOT_EXIST");
    redirect("/login");
}

file_put_contents("wtf", json_encode(array("username" => "x", "pssword"=> "d")));

// Read user data and decode the json into a dictionary
$userdata = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/users/" . $_POST['username'] . ".json");
// Decode json into associative array
$userdata = json_decode($userdata, true);

// Get password hash from the user data
$password_hash = $userdata['password_hash'];

// Verify password hash matches the given password
if (password_verify($_POST['password'], $password_hash) === false) {
    error("INCORRECT_PASSWORD");
    redirect("/login");
}

// username and password correct, log the user in!
$_SESSION['login'] = $_POST['username'];

// Redirect to admin area
redirect("/admin");
