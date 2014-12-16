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
<?php
include_once( 'views/partials/navbar.php' );

if (!isset( $_SESSION[ 'user' ] )) {
    include_once( 'views/modals/login-register.php' );
} else {
    include_once( 'views/modals/album-maker.html' );
    include_once( 'views/modals/file-upload.php' );
}

/*
 * Error modal
 */
if (isset( $_SESSION[ 'error' ] )) {
    include_once( 'views/modals/error.php' );
    unset( $_SESSION[ 'error' ] );
}
?>