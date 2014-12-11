<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

session_destroy();

if (isset( $_GET[ 'redirectTo' ] ) && !empty( $_GET[ 'redirectTo' ] )) {
    header( "Location: ". $_GET[ 'redirectTo' ] );
} else {
    header( "Location: index.php" );
}