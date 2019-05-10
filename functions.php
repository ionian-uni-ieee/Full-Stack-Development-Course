<?php
/*
 * Common functions used on all scripts and initialization logic
 */

/*
 * Starts the session if it has not yet started
 */
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

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
 * Set an error and store it on the session
 */
function error($message) {
    $_SESSION['error'] = $message;
}

/*
 * Gets the last error from the session
 */
function getError() {
    if (isset($_SESSION['error'])) {
        return $_SESSION['error'];
        unset($_SESSION['error']);
    }
    else {
        return false;
    }
}

?>
