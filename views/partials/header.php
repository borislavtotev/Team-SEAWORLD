<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Programators</title>
    <link rel="stylesheet" href="css/bootstrap.css"/>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/style.css"/>
</head>
<body>
<!-- Add jQuery to use it for 'Back to top' button -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
//Get current page URL; the method can be called whenever we include the header.php
function currentPageURL() {
    $pageURL = 'http';
    if (isset($_SERVER['HTTPS']))
    if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}

function __autoload( $classname )
{
    $filename = "./system/models/". strtolower( $classname ) .".php";
    include_once( $filename );
}

include_once( 'system/db-connect.php' );
include_once( 'views/partials/navbar.php' );

if (!isset( $_SESSION[ 'user' ] )) {
    include_once( 'views/modals/login-register.php' );
} else {
    include_once( 'views/modals/album-maker.php' );
    include_once( 'views/modals/file-upload.php' );
}

/*
 * Error modal
 */
if (isset( $_SESSION[ 'error' ] )) {
    include_once( 'views/modals/error.php' );
    unset( $_SESSION[ 'error' ] );
}