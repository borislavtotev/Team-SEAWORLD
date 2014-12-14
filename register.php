<?php
include_once( 'system/db-connect.php' );
include_once( 'system/models/user.php' );

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset( $_POST[ 'username' ], $_POST[ 'email' ], $_POST[ 'password' ] )) {
    if (!empty( $_POST[ 'username' ] ) && !empty( $_POST[ 'email' ] ) && !empty( $_POST[ 'password' ] ) ) {
        $user = User::createUser( $mysqli, $_POST[ 'username' ], $_POST[ 'email' ], $_POST[ 'password' ] );
        if ($user instanceof User) {
            session_start();
            $_SESSION[ 'user' ] = $user;
        } else {
            $_SESSION['error'] = $user;
			echo $_SESSION['error'];
        }
    }
}

header( "Location: index.php" );