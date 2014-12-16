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

    private function __construct($id, $name, $ownerId, $dateCreated, $picturesCount = 0, $rating = 0)
    {
        $this->id = $id;
        $this->name = $name;
        $this->ownerId = $ownerId;
        $this->dateCreated = $dateCreated;
        $this->picturesCount = $picturesCount;
        $this->rating = $rating;
    }

    /*
     * Public Static methods
     */
    public static function createAlbum($albumName, $ownerId)
    {
        if (empty($albumName) || empty($ownerId)) {
            die ('Name and userID cannot be empty!');
        }

        /*
         * We must check if that user already has album with this name... don't wanna any collisions!
         */

        $escapedName = Album::parseInput($albumName);
        $escapedOwnerId = Album::parseInput($ownerId);
        $insertQuery = "INSERT INTO albums(name, userid) VALUES('$escapedName', '$escapedOwnerId')";

        mysqli_query($GLOBALS[ 'mysqli' ], $insertQuery) or die(mysqli_error($GLOBALS[ 'mysqli' ]));

        $query = "SELECT `id` FROM `albums` WHERE `name`='$escapedName' AND `userid`='$escapedOwnerId'";
        $result = $GLOBALS['mysqli']->query( $query ) or die(mysqli_error($GLOBALS['mysqli']));
        $id = $result->fetch_assoc()['id'];

        mkdir( "uploads/$ownerId/$id" );
    }

    public static function getAlbumById( $id )
    {
        if (empty( $id )) {
            die ('empty id, cannot get album! aborting...');
        }

        $id = Album::parseInput( $id );
        $query = "SELECT * FROM albums WHERE id = '$id'";
        $result = $GLOBALS[ 'mysqli' ]->query( $query );

        if ($result->num_rows == 0) {
            return null;
        } else {
            $row = $result->fetch_assoc();
            return new Album($row['id'], $row['name'], $row['userid'],
                $row['date-created'], $row['pictures-count'], $row['rating']);
        }
    }

    public static function getAlbumsByOwnerId( $ownerId )
    {
        if (empty($ownerId)) {
            die('no userId provided, cannot get albums. aborting...');
        }

        $escapedOwnerId = Album::parseInput($ownerId);
        $query = "SELECT * FROM albums WHERE userid = '$escapedOwnerId'";

        $result = $GLOBALS[ 'mysqli' ]->query($query) or die( mysqli_error( $GLOBALS[ 'mysqli' ] ) );
        $albums = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $album = new Album($row['id'], $row['name'], $row['userid'],
                    $row['date-created'], $row['pictures-count'], $row['rating']);
                $albums[] = $album;
            }
        }

        return $albums;
    }

    public static function removeAlbum( $id )
    {
        if (empty($id)) {
            die('empty id, cannot remove album! aborting...');
        }

        $id = Album::parseInput($id);
        $query = "REMOVE * FROM albums WHERE id = '$id'";

        mysqli_query($GLOBALS[ 'mysqli' ], $query) or die (mysqli_error($GLOBALS[ 'mysqli' ]));
    }

    public static function getAllAlbums()
    {
        $users = User::getAllUsers();
        $allAlbums = [];
        foreach ($users as $user) {
            foreach (Album::getAlbumsByOwnerId( $user->getId() ) as $album) {
                $allAlbums[] = $album;
            };
        }

        return $allAlbums;
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

    public function getPictures()
    {
        // TODO: implement it!
    }

    public function getRating()
    {
        return $this->rating;
    }

    /*
     * Setters
     */
    public function setName( $name )
    {
        $this->update( 'name', $name );
        $this->name = $name;
    }

    public function setRating( $rating )
    {
        $this->update( 'rating', $rating );
        $this->rating = $rating;
    }

    public function addPic( $picName, $picResource )
    {
        Picture::addPicture( $picName, $picResource, $this->id );
        $this->picturesCount++;
        $this->update( 'pictures-count', $this->picturesCount );
    }

    public function removePic( $id )
    {
        $this->picturesCount--;
        $this->update( 'pictures-count', $this->picturesCount );
    }
	
	public function getFirstPic ($userId, $albumId) {
		$foundFile = false;		
		foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator("./uploads/$userId/$albumId")) as $filename) {	
        	if (preg_match("/\.jpg$/",$filename) || preg_match("/\.png/",$filename) || preg_match("/\.gif$/",$filename) || preg_match("/\.jpeg$/",$filename)) {
				$foundFile = true;	
				break;
			}
		}
		
		if ($foundFile) {
			return $filename;
		} else {
			return "http://oleaass.com/wp-content/uploads/2014/09/PHP.png"; 
		}
	}

    /*
     * Private functions
     */
    private function update( $field, $value )
    {
        $query = "UPDATE `albums` SET `$field`='$value' WHERE `id` = '$this->id'";

        mysqli_query( $GLOBALS[ 'mysqli' ], $query ) or die( mysqli_error( $GLOBALS[ 'mysqli' ] ) );
    }

    private static function parseInput( $input )
    {
        $regex = '/\'|\"/';
        return preg_replace( $regex, '', $input );
    }
}