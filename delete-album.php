<?php
function __autoload( $classname )
{
    $filename = "system/models/". strtolower( $classname ) .".php";
    include_once( $filename );
}
include 'system/db-connect.php';

session_start();

if (!isset( $_SESSION[ 'user' ] )) {
    echo 'not logged in';
}

$album = Album::getAlbumById( $_POST[ 'albumId' ] );
if ($album->getOwnerId() != $_SESSION[ 'user' ]->getId()) {
    echo 'cannot delete foreign album';
} else {
    $album->remove();
    echo '';
}