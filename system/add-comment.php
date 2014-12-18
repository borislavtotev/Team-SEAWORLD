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
    $pic = Picture::getPicById( $_POST[ 'id' ] );
    Comments::addComment( $_SESSION[ 'user' ]->getId(), $_POST[ 'id' ], $pic->getAlbumId(), $_POST[ 'comment' ] );
    $comments = Comments::getAllCommentsByPicId( $_POST[ 'id' ] );
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