<?php
function __autoload( $classname )
{
    $filename = "./models/". strtolower( $classname ) .".php";
    include_once( $filename );
}
session_start();
include_once( 'db-connect.php' );
//include( './models/picture.php' );

if (isset( $_POST[ 'comment' ] ) && !empty( $_POST[ 'comment' ] )) {
    $picId = $_POST[ 'picid' ];
    
    if (empty($picId)) {
        $picId = NUll;
    }
    
    $albumId = $_POST['albumid'];
    
    Comments::addComment( $_SESSION[ 'user' ]->getId(), $picId, $albumId, $_POST[ 'comment' ] );
    
    if (!is_null($picId)) {
        $comments = Comments::getAllCommentsByPicId( $_POST[ 'picid' ] );
    } else {
        $comments = Comments::getAllCommentsByAlbumId( $_POST[ 'albumid' ] );
    }
    $comment = $comments[ count( $comments ) - 1 ];
    $owner = new User( $comment[ 'userid' ] );

    $parsedComment = (object)[
        'content' => $comment[ 'content' ],
        'date' => $comment[ 'date' ],
        'owner' => $owner->getUserName()
    ];
    echo (json_encode( $parsedComment ));
    exit();
}