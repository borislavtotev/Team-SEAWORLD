<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset( $_SESSION[ 'is_logged' ] ) && $_SESSION[ 'is_logged' ] === true) {
    session_destroy();
    header("Location: index.php");
}