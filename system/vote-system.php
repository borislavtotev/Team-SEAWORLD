<?php
include './db-connect.php';
include './models/album.php';
include './models/picture.php';

function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

if (isset( $_POST[ 'target' ], $_POST[ 'isVoteUp' ], $_POST[ 'targetType' ] ) &&
    !empty( $_POST[ 'target' ] ) && !empty( $_POST[ 'isVoteUp' ] ) &&
    !empty( $_POST[ 'targetType' ] )) {
    $client = get_client_ip();
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