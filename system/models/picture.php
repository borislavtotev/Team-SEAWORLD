<?php
class Picture
{
    private $id;
    private $name;
    private $albumId;
    private $ownerId;
    private $dateUploaded;
    private $fullPath;
    private static $picsLocation = '/uploads/';

    private function __construct( $id, $name, $albumId, $dateUploaded, $ownerId, $fullPath )
    {
        $this->id = $id;
        $this->name = $name;
        $this->albumId = $albumId;
        $this->dateUploaded = $dateUploaded;
        $this->ownerId = $ownerId;
        $this->fullPath = $fullPath;
    }

    public static function addPicture( $name, $path, $albumId )
    {
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
                $fullPath = "./uploads/$ownerId/$albumId/" . $row['id'] . '-' . $row['name'];
                $images[] =
                    new Picture( $row[ 'id' ], $row[ 'name' ],
                        $row[ 'albumid' ], $row[ 'date-uploaded' ], $ownerId, $fullPath );
            }
        } else {
            $images[] = new Picture( null, null, null, null, null, "http://oleaass.com/wp-content/uploads/2014/09/PHP.png" );
        }
        return $images;
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
}