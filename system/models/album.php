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
    private $imagesHandler;

    public function __construct( $id, $name, $ownerId, $dateCreated, $picturesCount = 0, $rating = 0 )
    {
        $this->id = $id;
        $this->name = $name;
        $this->ownerId = $ownerId;
        $this->dateCreated = $dateCreated;
        $this->picturesCount = $picturesCount;
        $this->rating = $rating;

        include 'system/images-handler.php';
        $this->imagesHandler = new ImagesHandler();
    }

    /*
     * Public Static methods
     */
    public static function createAlbum( $mysqliConnection, $albumName, $ownerId, $picturesCount )
    {
        if (empty( $albumName ) || empty( $ownerId )) {
            die ( 'Name and userID cannot be empty!' );
        }

        /*
         * We must check if that user already has album with this name... don't wanna any collisions!
         */

        $escapedName = Album::parseInput( $albumName );
        $escapedOwnerId = Album::parseInput( $ownerId );
        $insertQuery = "INSERT INTO albums(name, userid, pictures-count) VALUES('$escapedName', '$escapedOwnerId', '$picturesCount')";

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

    /*
     * Public Instance methods
     */
    public function remove( $mysqliConnection )
    {
        Album::removeAlbum( $mysqliConnection, $this->id );
    }

    public function save( $mysqliConnection )
    {
        // We skip the id and the dateCreated and we cant make album with rating more than 0!
        Album::createAlbum( $mysqliConnection, $this->name, $this->ownerId, $this->picturesCount );
    }

    /*
     * Getters
     */
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getOwnerId()
    {
        return $this->ownerId;
    }

    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    public function getPicturesCount()
    {
        return $this->picturesCount;
    }

    public function getRating()
    {
        return $this->rating;
    }

    /*
     * Setters
     */
    public function setName( $mysqliConnection, $name )
    {
        $this->update( $mysqliConnection, 'name', $name );
        $this->name = $name;
    }

    public function setRating( $mysqliConnection, $rating )
    {
        $this->update( $mysqliConnection, 'rating', $rating );
        $this->rating = $rating;
    }

    public function addPics( $mysqliConnection, $pics )
    {
        foreach ($pics as $pic) {
            $this->imagesHandler->addImage( $pic, $this->id );
            $this->picturesCount++;
        }
        $this->update( $mysqliConnection, 'pictures-count', $this->picturesCount );
    }

    public function removePic( $id )
    {
        $this->imagesHandler->removeImage( $this->id, $id );
        $this->$picturesCount--;
    }

    /*
     * Private functions
     */
    private function update( $mysqliConnection, $field, $value )
    {
        $query = "UPDATE albums SET ";
        $query .= $field . "='" . Album::parseInput( $value ) . "'";
        $query .= " WHERE id='$this->id'";

        mysqli_query( $mysqliConnection, $query ) or die( mysqli_error( $mysqliConnection ) );
    }

    private static function parseInput( $input )
    {
        $regex = '/[^a-zA-Z0-9_]/';
        return preg_replace( $regex, '', $input );
    }
}