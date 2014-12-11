<?php
include_once( 'system/models/user.php' );
include_once( 'system/db-connect.php' );

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset( $_POST[ 'username' ], $_POST[ 'password' ] ) &&
    !empty( $_POST[ 'username' ] ) && !empty( $_POST[ 'password' ] )) {
    mb_internal_encoding('UTF-8');

    $username = trim( $_POST[ 'username' ] );
    //$password = md5( trim( $_POST[ 'password' ] ) ); // Encrypt password with md5 hash algorithm
    $password = trim( $_POST[ 'password' ] ); //Tested without md5 :)
	
    $rememberMe = false;
    if (isset( $_POST[ 'rememberMe' ] )) {
        $rememberMe = $_POST[ 'rememberMe' ];
    }

	//Create always new user - just for testing. Should be moved in register.php
	//$testUser = new User($mysqli, $username, $password);
	
    //$user = new User($username, $password);
    $correctUser = User::checkUser($mysqli,$username, $password);
    
	if ($correctUser) {
		$user = new User($mysqli, $username, $password);	
		$userId = $user->getUserId();
	    $_SESSION[ 'is_logged' ] = true;
	    $_SESSION[ 'username' ] = $username;
        $_SESSION[ 'userid' ] = $userId; // We also need user id since it's the key for all user data
    } else {
        $loginError = 'Грешен потребител или парола!';
    }
}

$redirectLocation = 'index.php';

if (isset( $_POST[ 'redirectTo' ] )) {
    $redirectLocation = $_POST[ 'redirectTo' ];
}

if (isset( $loginError )) {
   $redirectLocation .= "?error=$loginError";
}

header("Location: $redirectLocation"); // Logged in, or logged not... we redirect!