<?php
class Picture
{
    private $id;
    private $name;
    private $albumId;
    private $dateUploaded;
    private static $picsLocation = '/uploads/';

    private function __construct( $name, $albumId, $pictureResource )
    {
        //$this->name = $name;
        //$this->albumId = $albumId;
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

    public static function remove( $id )
    {
        // TODO: implement it!
    }

    public function save()
    {
        // TODO: implement it!
        // Get a unique id somehow
        // Set proper date of uploading
        // Move the pic resource to its folder
        // Anything else?
    }
}