<?php
function __autoload( $classname )
{
    $filename = "system/models/". strtolower( $classname ) .".php";
    include_once( $filename );
}
include 'system/db-connect.php';

session_start();

if (!isset( $_SESSION[ 'user' ] )) {
    die( 'not logged in' );
} else if (isset( $_POST[ 'albumId' ] ) && !empty( $_POST[ 'albumId' ] )) {
    $album = Album::getAlbumById( $_POST[ 'albumId' ] );
    if ($album->getOwnerId() != $_SESSION[ 'user' ]->getId()) {
        die( 'cannot delete foreign album' );
    } else {
        $album->remove();
        echo '';
    }
} else if (isset( $_POST[ 'picId' ] ) && !empty( $_POST[ 'picId' ] )) {
    $pic = Picture::getPicById( $_POST[ 'picId' ] );
    if ($pic->getOwnerId() != $_SESSION[ 'user' ]->getId()) {
        die( 'cannot delete foreign pic' );
    } else {
        $album = Album::getAlbumById( $pic->getAlbumId() );
        $album->removePic( $_POST[ 'picId' ] );
        echo '';
    }
} else {
    echo 'no id selected';
}