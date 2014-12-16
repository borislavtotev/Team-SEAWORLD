<?php
class SearchEngine
{
    public static function searchFor( $mysqli, $pattern )
    {
        $users = SearchEngine::searchUsers( $mysqli, $pattern );
        $albums = SearchEngine::searchAlbums( $mysqli, $pattern );
        $comments = SearchEngine::searchComments( $mysqli, $pattern );

        return [ 'users' => $users, 'albums' => $albums, 'comments' => $comments ];
    }

    private static function searchUsers( $mysqli, $pattern )
    {
        include_once( 'system/models/user.php' );

        $users = User::getAllUsers( $mysqli );
        $matches = [];
        foreach ($users as $user) {
            if (preg_match( "/$pattern/", $user->getId() ) ||
                preg_match( "/$pattern/", $user->getUserName() ) ||
                preg_match( "/$pattern/", $user->getEmail() )) {
                $matches[] = $user;
            }
        }

        return $matches;
    }

    private static function searchAlbums( $mysqli, $pattern )
    {
	return [];
    
        include_once 'system/models/album.php';

        $albums = Album::getAllAlbums( $mysqli );
        $matches = [];
        foreach ($albums as $album) {
            var_dump( $album );
            if (preg_match( "/$pattern/", $album->getId() ) ||
                preg_match( "/$pattern/", $album->getName() ||
                preg_match( "/$pattern/", $album->getOwnerId() ))) {
                $matches[] = $album;
            }
        }

        return $matches;
    }

    private static function searchComments( $mysqli, $pattern )
    {
        // TODO: Implement it!
        return [];
    }
}