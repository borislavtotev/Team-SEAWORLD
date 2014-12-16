<?php
class SearchEngine
{
    public static function searchFor( $pattern )
    {
        $users = SearchEngine::searchUsers(  $pattern );
        $albums = SearchEngine::searchAlbums(  $pattern );
        $comments = SearchEngine::searchComments(  $pattern );

        return [ 'users' => $users, 'albums' => $albums, 'comments' => $comments ];
    }

    private static function searchUsers( $pattern )
    {
        $users = User::getAllUsers();
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

    private static function searchAlbums( $pattern )
    {
        return [];
        $albums = Album::getAllAlbums();
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

    private static function searchComments( $pattern )
    {
        // TODO: Implement it!
        return [];
    }
}