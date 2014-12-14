<?php
include_once( 'system/models/user.php' );
include_once( 'system/db-connect.php' );

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset( $_POST[ 'username' ], $_POST[ 'password' ] )) {
    mb_internal_encoding('UTF-8');
	
    $rememberMe = false;
    if (isset( $_POST[ 'rememberMe' ] )) {
        $rememberMe = $_POST[ 'rememberMe' ];
    }

    $user = User::login( $mysqli, $_POST[ 'username' ], $_POST[ 'password' ] );
	if ($user instanceof User) {
	    $_SESSION[ 'user' ] = $user;
    } else {
        $_SESSION['error'] = $user;
    }
}

$redirectLocation = 'index.php';

if (isset( $_POST[ 'redirectTo' ] )) {
    $redirectLocation = $_POST[ 'redirectTo' ];
}

header("Location: $redirectLocation"); // Logged in, or logged not... we redirect!