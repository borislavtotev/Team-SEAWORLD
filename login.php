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

    $user = User::login( $_POST[ 'username' ], $_POST[ 'password' ] );
	if ($user instanceof User) {
	    $_SESSION[ 'user' ] = $user;
    } else {
        $_SESSION['error'] = $user;
    }
}
//Get current page URL
function currentPageURL() {
    $pageURL = 'http';
    if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}
$redirectLocation = currentPageURL();

if (isset( $_POST[ 'redirectTo' ] )) {
    $redirectLocation = $_POST[ 'redirectTo' ];
}

header("Location: $redirectLocation"); // Logged in, or logged not... we redirect!