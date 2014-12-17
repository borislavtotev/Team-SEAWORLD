<?php
include './db-connect.php';
include './models/album.php';
include './models/picture.php';

if (isset( $_POST[ 'target' ], $_POST[ 'isVoteUp' ], $_POST[ 'targetType' ] ) &&
    !empty( $_POST[ 'target' ] ) && !empty( $_POST[ 'isVoteUp' ] ) &&
    !empty( $_POST[ 'targetType' ] )) {
    $client = $_SERVER[ 'REMOTE_ADDR' ];
    $targetId = $_POST[ 'target' ];
    $targetType = $_POST[ 'targetType' ] == 'true' ? 'album' : 'pic';

    $query = "SELECT * FROM `votes` WHERE `client-addr`='$client' AND `target-id`='$targetId' AND `target-type`='$targetType'";
    $result = mysqli_query( $mysqli, $query ) or die( mysqli_error( $mysqli ) );
    if ($result->num_rows == 0) {
        $query = "INSERT INTO votes(`client-addr`, `target-id`, `target-type`) VALUES('$client', '$targetId', '$targetType')";
        mysqli_query( $mysqli, $query ) or die( mysqli_error( $mysqli ) );

        if ($targetType == 'album') {
            $album = Album::getAlbumById( $targetId );
            if ( $_POST[ 'isVoteUp' ] == 'true') $album->voteUp();
            else $album->voteDown();
        } else {
            $pic = Picture::getPicById( $targetId );
            if ( $_POST[ 'isVoteUp' ] == 'true') $pic->voteUp();
            else $pic->voteDown();
        }
    } else {
        echo 'noooo';
    }
}