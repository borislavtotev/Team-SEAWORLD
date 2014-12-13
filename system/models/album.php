<?php
/**
 * Album model.
 *
 */

class Album
{
    private $id;
    private $name;
    private $ownerId;
    private $dateCreated;
    private $picturesCount;
    private $rating;

    public function __construct( $id, $name, $ownerId, $dateCreated, $picturesCount = 0, $rating = 0 )
    {
        $this->id = $id;
        $this->name = $name;
        $this->ownerId = $ownerId;
        $this->dateCreated = $dateCreated;
        $this->picturesCount = $picturesCount;
        $this->rating = $rating;
    }

    public static function createUser( $mysqliConnection, $albumName, $ownerId )
    {
        if (empty( $name ) || empty( $userId )) {
            die ( 'Name and userID cannot be empty!' );
        }

        /*
         * We must check if that user already has album with this name... don't wanna any collisions!
         */

        $escapedName = Album::parseInput( $albumName );
        $escapedOwnerId = Album::parseInput( $ownerId );
        $insertQuery = "INSERT INTO albums(name, userid) VALUES('$escapedName', '$escapedOwnerId')";

        mysqli_query( $mysqliConnection, $insertQuery ) or die( mysqli_error( $mysqliConnection ) );

        /*
         * Now fetch the information of the user from the database and return instance!
         * return new User( $id, $name, $ownerId, $dateCreated );
         */
    }

    public static function getAlbumById( $mysqliConnection, $id )
    {
        if (empty( $id )) {
            die ( 'empty id, cannot get album! aborting...' );
        }

        $id = Album::parseInput( $id );
        $query = "SELECT * FROM albums WHERE id = '$id'";
        $result = $mysqliConnection->query( $query );

        if ($result->num_rows == 0) {
            return null;
        } else {
            $row = $result->fetch_assoc();
            return new Album( $row[ 'id' ], $row[ 'name' ], $row[ 'userid' ],
                $row[ 'date-created' ], $row[ 'pictures-count' ], $row[ 'rating' ] );
        }
    }

    public static function getAlbumsByOwnerId( $mysqliConnection, $ownerId )
    {
        if (empty( $ownerId )) {
            die( 'no userId provided, cannot get albums. aborting...' );
        }

        $escapedOwnerId = Album::parseInput( $ownerId );
        $query = "SELECT * FROM albums WHERE userid = '$escapedOwnerId'";

        $result = $mysqliConnection->query( $query ) or die( mysqli_error( $mysqliConnection ) );
        $albums = [];

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $album = new Album( $row[ 'id' ], $row[ 'name' ], $row[ 'userid' ],
                    $row[ 'date-created' ], $row[ 'pictures-count' ], $row[ 'rating' ] );
                $albums[] = $album;
            }
        }

        return $albums;
    }

    public static function removeAlbum( $mysqliConnection, $id )
    {
        if (empty( $id )) {
            die( 'empty id, cannot remove album! aborting...' );
        }

        $id = Album::parseInput( $id );
        $query = "REMOVE * FROM albums WHERE id = '$id'";

        mysqli_query( $mysqliConnection, $query ) or die ( mysqli_error( $mysqliConnection ) );
    }

    public function remove( $mysqliConnection )
    {
        Album::removeAlbum( $mysqliConnection, $this->id );
    }

    public function update( $name = null, $ownerId = null, $picturesCount = null, $rating = null )
    {
        $arguments = get_defined_vars();
        $changedFields = [];

        foreach($arguments as $argn => $argv) {
            if ($argv != null) {
                $fieldName = '';

                switch ($argn) {
                    case 'ownerId':
                        $fieldName = 'userid';
                        break;
                    case 'picturesCount':
                        $fieldName = 'pictures-count';
                        break;
                    default:
                        $fieldName = $argn;
                }

                $escapedValue = Album::parseInput( $argv );
                $fieldName .= "='$escapedValue'";

                $changedFields[] = $fieldName;
            }
        }

        $changesAsString = implode( ', ', $changedFields );
        $query = "UPDATE albums SET $changesAsString WHERE id='$this->id'";

        mysqli_query( $this->mysqli, $query ) or die( mysqli_error( $this->mysqli ) );
    }

    private static function parseInput( $input )
    {
        $regex = '/[^a-zA-Z0-9_]/';
        return preg_replace( $regex, '', $input );
    }
}