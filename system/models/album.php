<?php
/**
 * Album model.
 *
 * The constructor accepts mysqli connection!
 *
 * ============ Public API =============
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

        mysqli_query( $this->mysqli, $insertQuery )
            or die(mysqli_error( $this->mysqli ));
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
            die( 'no userId provided. aborting...' );
        }

        $escapedUserId = $this->parseInput( $userId );
        $query = "SELECT * FROM albums WHERE userid = '$escapedUserId'";

        $result = $this->mysqli->query( $query );

        return $this->getAlbumsFromMysqliResult( $result );
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