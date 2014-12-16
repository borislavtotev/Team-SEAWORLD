<?php
class Picture
{
    private $id;
    private $name;
    private $albumId;
    private $dateUploaded;
    private $picsLocation = '/uploads/';

    public function __construct( $name, $albumId, $pictureResource )
    {
        $this->name = $name;
        $this->albumId = $albumId;
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