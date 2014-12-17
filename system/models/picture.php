<?php
class Picture
{
    private $id;
    private $name;
    private $albumId;
    private $ownerId;
    private $dateUploaded;
    private $fullPath;
    private $rating;
    private static $picsLocation = '/uploads/';
    const MIN_RATING = 0;
    const MAX_RATING = 10;

    private function __construct( $id, $name, $albumId, $dateUploaded, $ownerId, $fullPath, $rating )
    {
        $this->id = $id;
        $this->name = $name;
        $this->albumId = $albumId;
        $this->dateUploaded = $dateUploaded;
        $this->ownerId = $ownerId;
        $this->fullPath = $fullPath;
        $this->rating = $rating;
    }

    public static function addPicture( $name, $path, $albumId )
    {
        $name = preg_replace( '/[^a-zA-Z0-9._]/', '', $name );

        $query = "INSERT INTO images(name, albumid) VALUES('$name', '$albumId')";
        $GLOBALS[ 'mysqli' ]->query( $query ) or die( mysqli_error( $GLOBALS[ 'mysqli' ] ) );

        $query = "SELECT `id` FROM `images` WHERE `name`='$name' AND `albumid`='$albumId'";
        $result = $GLOBALS[ 'mysqli' ]->query( $query ) or die( mysqli_error( $GLOBALS[ 'mysqli' ] ) );

        $picId = $result->fetch_assoc()[ 'id' ];
        $userId = $_SESSION[ 'user' ]->getId();

        $newPath = Picture::$picsLocation . "$userId/$albumId/$picId-$name";

        move_uploaded_file( $path, "./".$newPath );
    }

    public static function getPicturesFromAlbum( $albumId, $ownerId )
    {
        $query = "SELECT * FROM images WHERE albumid = '$albumId'";
        $result = $GLOBALS['mysqli'] -> query($query) or die(mysqli_error($GLOBALS['mysqli']));

        $images = [];
        if ($result -> num_rows > 0) {
            while ($row = $result -> fetch_assoc()) {
                $fullPath = "./uploads/$ownerId/$albumId/" . $row['id'] . '-' . $row[ 'name' ];
                $rating = [ 'ups' => $row[ 'votes-up' ], 'downs' => $row[ 'votes-down' ] ];
                $images[] =
                    new Picture( $row[ 'id' ], $row[ 'name' ],
                        $row[ 'albumid' ], $row[ 'date-uploaded' ], $ownerId, $fullPath, $rating );
            }
        } else {
            $images[] = new Picture( null, null, null, null, null, "http://oleaass.com/wp-content/uploads/2014/09/PHP.png", null );
        }
        return $images;
    }

    public static function getPicById( $id )
    {
        $query = "SELECT * FROM `images` WHERE `id`='$id'";
        $result = $GLOBALS[ 'mysqli' ] -> query( $query ) or die( mysqli_error( $GLOBALS[ 'mysqli' ] ) );
        if ($result->num_rows == 0) {
            return null;
        }

        $info = $result->fetch_assoc();
        $album = Album::getAlbumById( $info[ 'albumid' ] );
        if ($album == null) die("no album with this id");
        $ownerId = $album->getOwnerId();
        $albumId = $album->getId();

        $rating = [ 'ups' => $info[ 'votes-up' ], 'downs' => $info[ 'votes-down' ] ];
        $fullPath = "./uploads/$ownerId/$albumId/" . $info[ 'id' ] . '-' . $info[ 'name' ];
        return new Picture( $info['id'], $info['name'], $album->getId(),
            $info[ 'date-uploaded' ], $album->getOwnerId(), $fullPath, $rating );
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getAlbumId()
    {
        return $this->albumId;
    }

    public function getOwnerId()
    {
        return $this->ownerId;
    }

    public function getDateUploaded()
    {
        return $this->dateUploaded;
    }

    public function getFullPath()
    {
        return $this->fullPath;
    }

    public function getRating()
    {
        return $this->rating;
    }

    public function voteUp()
    {
        $this->rating[ 'ups' ]++;
        $this->changeRating();
    }

    public function voteDown()
    {
        $this->rating[ 'downs' ]++;
        $this->changeRating();
    }

    public function remove()
    {
        $query = "DELETE FROM `images` WHERE `id` = '$this->id'";
        mysqli_query( $GLOBALS[ 'mysqli' ], $query ) or die( mysqli_error( $GLOBALS[ 'mysqli' ] ) );

        $query = "DELETE FROM `votes` WHERE `target-id` = '$this->id' AND `target-type` = 'pic'";
        mysqli_query( $GLOBALS[ 'mysqli' ], $query ) or die( mysqli_error( $GLOBALS[ 'mysqli' ] ) );

        if (file_exists( $this->fullPath ))
            unlink( $this->fullPath );
    }

    private function changeRating()
    {
        $ups = $this->rating[ 'ups' ];
        $downs = $this->rating[ 'downs' ];
        $query = "UPDATE `images` SET `votes-up`='$ups', `votes-down`='$downs' WHERE `id`='$this->id'";
        $GLOBALS[ 'mysqli' ]->query( $query ) or die( mysqli_error( $GLOBALS[ 'mysqli' ] ) );
    }
}