<?php
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

    private function parseInput( $input )
    {
        $regex = '/[^a-zA-Z0-9]/';
        return preg_replace( $regex, '', $input );
    }
}