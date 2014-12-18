<?php
include_once( 'system/db-connect.php' );
include_once( 'system/models/user.php' );

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset( $_POST[ 'username' ], $_POST[ 'email' ], $_POST[ 'password' ] )) {
    $user = User::createUser( $_POST[ 'username' ], $_POST[ 'email' ], $_POST[ 'password' ] );
    if ($user instanceof User) {
        session_start();
        $_SESSION[ 'user' ] = $user;
    } else {
        $_SESSION['error'] = $user;
		echo $_SESSION['error'];
    }   
}

$redirectLocation = 'index.php';

if (isset( $_POST[ 'redirectTo' ]) && !empty( $_POST['redirectTo'])) {
    $redirectLocation = $_POST[ 'redirectTo' ];
}

header("Location: $redirectLocation");