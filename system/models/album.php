<?php
/**
 * Album model.
 *
 * The constructor accepts mysqli connection!
 *
 * ============ Public API =============
 * Accepts album id as first parameter
 * Returns album as object or null if no album with this id exists
 * ---function getAlbumById( $id )
 *
 * Accepts album name as first parameter and user id as second parameter
 * If `name` param is empty, returns all albums from the db
 * Upon error stops the script and prints error message
 * ---function createNewAlbum( $name, $userId )
 *
 * Accepts album name as first parameter
 * Returns array with matching results, or empty array if there is no albums with this name
 * ---function getAlbumsByName( $name )
 *
 * Accepts user id as first parameter
 * Returns array of album entries as objects or empty array in case no matches
 * ---function getAlbumsByUserId( $userId )
 *
 * Removes album with given id
 * Stops the script if error or empty id!
 * ---function removeAlbum( $id )
 *
 * Updates album with id, given as first parameter
 * The second parameter must be object like the one returned by getAlbumById
 * Updates valid fields only! Stops the script if no id is provided!
 * ---function updateAlbum( $id, $newAlbum )
 */

class Album
{
    private $mysqli;

    public function __construct( $mysqli )
    {
        $this->mysqli = $mysqli;

        /*
         * We can check here if such table exists
         * If not... we must create it
         */
    }

    public function createNewAlbum( $name, $userId )
    {
        if (empty( $name ) || empty( $userId )) {
            die ( 'Name and userID cannot be empty!' );
        }

        $escapedName = $this->parseInput( $name );
        $escapedUserId = $this->parseInput( $userId );
        $insertQuery = "INSERT INTO albums(name, userid) VALUES('$escapedName', '$escapedUserId')";

        mysqli_query( $this->mysqli, $insertQuery ) or die( mysqli_error( $this->mysqli ) );
    }

    public function getAlbumById( $id )
    {
        if (empty( $id )) {
            die ( 'empty id, cannot get album! aborting...' );
        }

        $id = $this->parseInput( $id );
        $query = "SELECT * FROM albums WHERE id = '$id'";
        $result = $this->mysqli->query( $query );

        if ($result->num_rows == 0) {
            return null;
        } else {
            $row = $result->fetch_assoc();
            return (object)[
                'id' => $row[ 'id' ],
                'name' => $row[ 'name' ],
                'userid' => $row[ 'userid' ],
                'dateCreated' => $row[ 'date-created' ],
                'picturesCount' => $row[ 'pictures-count' ],
                'rating' => $row[ 'rating' ]
            ];
        }
    }

    public function getAlbumsByName( $name )
    {
        $query = "SELECT * FROM albums";

        if (!empty( $name )) {
            $escapedName = $this->parseInput( $name );
            $query = $query . " WHERE name = '$escapedName'";
        }

        $result = $this->mysqli->query( $query );

        return $this->getAlbumsFromMysqliResult( $result );
    }

    public function getAlbumsByUserId( $userId )
    {
        if (empty( $userId )) {
            die( 'no userId provided, cannot get albums. aborting...' );
        }

        $escapedUserId = $this->parseInput( $userId );
        $query = "SELECT * FROM albums WHERE userid = '$escapedUserId'";

        $result = $this->mysqli->query( $query );

        return $this->getAlbumsFromMysqliResult( $result );
    }

    public function removeAlbum( $id )
    {
        if (empty( $id )) {
            die( 'empty id, cannot remove album! aborting...' );
        }

        $id = $this->parseInput( $id );
        $query = "REMOVE * FROM albums WHERE id = '$id'";

        mysqli_query( $this->mysqli, $query ) or die ( mysqli_error( $this->mysqli ) );
    }

    public function updateAlbum( $id, $newAlbum )
    {
        if (empty( $id )) {
            die( 'cannot update album, no id provided! aborting...' );
        }
        $id = $this->parseInput( $id );

        // We cannot update date created or id columns, ignore them!!!
        $albumName = $this->parseInput( $newAlbum->name );
        $albumUserId = $this->parseInput( $newAlbum->userid );
        $albumPicturesCnt = $this->parseInput( $newAlbum->picturesCount );
        $albumRating = $this->parseInput( $newAlbum->rating );

        $changedFields = [];
        // We are going to update valid fields only!
        if (!empty( $albumName )) {
            $changedFields[] = "name='$albumName'";
        }
        if (!empty( $albumUserId )) {
            $changedFields[] = "userid='$albumUserId'";
        }
        if (!empty( $albumPicturesCnt ) && is_numeric( $albumPicturesCnt )) {
            $changedFields[] = "pictures-count='$albumPicturesCnt'";
        }
        if (!empty( $albumRating ) && is_numeric( $albumRating )) {
            $changedFields[] = "rating='$albumRating'";
        }

        $changesAsString = implode( ', ', $changedFields );
        $query = "UPDATE albums SET $changesAsString WHERE id='$id'";

        mysqli_query( $this->mysqli, $query ) or die( mysqli_error( $this->mysqli ) );
    }

    private function parseInput( $input )
    {
        $regex = '/[^a-zA-Z0-9_]/';
        return preg_replace( $regex, '', $input );
    }

    private function getAlbumsFromMysqliResult( $result )
    {
        $albums = [];

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $album = (object)[
                    'id' => $row[ 'id' ],
                    'name' => $row[ 'name' ],
                    'userid' => $row[ 'userid' ],
                    'dateCreated' => $row[ 'date-created' ],
                    'picturesCount' => $row[ 'pictures-count' ],
                    'rating' => $row[ 'rating' ]
                ];
                $albums[] = $album;
            }
        }

        return $albums;
    }
}