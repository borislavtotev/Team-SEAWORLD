<?php
if (!isset( $_SESSION[ 'userid' ] )) {
    // Not logged in? Get the fuck outta here!
    //header( 'Location: index.php' );
}

/*
 * TODO: Implement it
 */
var_dump (preg_split('/\//', $_SERVER['REQUEST_URI'], NULL, PREG_SPLIT_NO_EMPTY)[0]);