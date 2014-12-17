<?php
class SearchEngine
{
    public static function searchFor( $pattern )
    {
        $users = SearchEngine::searchUsers(  $pattern );
        $albums = SearchEngine::searchAlbums(  $pattern );
        $comments = SearchEngine::searchComments( $pattern );
        $pics = SearchEngine::searchPics( $pattern );

        return [
            'users' => $users, 'albums' => $albums, 'comments' => $comments,
            'pics' => $pics
        ];
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
        $albums = Album::getAllAlbums();
        $matches = [];
        foreach ($albums as $album) {
            if (preg_match( "/$pattern/", $album->getId() ) ||
                preg_match( "/$pattern/", $album->getName() ) ||
                preg_match( "/$pattern/", $album->getOwnerId() )) {
                $matches[] = $album;
            }
        }
        return $matches;
    }

    private static function searchPics( $pattern )
    {
        $matches = [];
        foreach (Album::getAllAlbums() as $album) {
            foreach (Picture::getPicturesFromAlbum( $album->getId(), $album->getOwnerId() ) as $pic) {
                if (preg_match( "/$pattern/", $pic->getName() )) {
                    $matches[] = $pic;
                }
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