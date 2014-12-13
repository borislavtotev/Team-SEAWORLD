<?php
class User
{
    private $userId;
	private $userName;

    public function __construct( $mysqli, $userName )
    {
        $escapedUserName = User::parseInput( $userName );
        $getUserIdQuery = "SELECT userid FROM user WHERE username='$escapedUserName'";
        $result = $mysqli->query( $getUserIdQuery ) or die( mysqli_error( $mysqli ) );
        $id = $result->fetch_assoc()[ 'userid' ];

        $this->userId = $id;
        $this->userName = $userName;
    }

    /*
     * Static methods
     */
    public static function createUser( $mysqli, $userName, $password )
    {
        $escapedUserName = User::parseInput( $userName );
        $password = md5( $password );


        $selectByUserNameQuery = "SELECT * FROM user WHERE username='$escapedUserName'";
        $result = $mysqli->query( $selectByUserNameQuery );
        if ( $result->num_rows > 0 ) {
            die( 'User with that username already exists!' );
        }

        $insertUserQuery = "INSERT INTO user(username, password) VALUES('$escapedUserName', '$password')";
        $password = null; // Delete that info from the memory!!
        mysqli_query( $mysqli, $insertUserQuery ) or die( mysqli_error( $mysqli ) );

        return new User( $mysqli, $userName );
    }

    public static function isLoginDataValid( $mysqli, $username, $password )
    {
        $parsedUsrName = User::parseInput( $username );
        $parsedPass = User::parseInput( $password );

        if (empty( $parsedUsrName ) || empty( $parsedPass ) ) {
            die ( 'Name and pass cannot be empty!' );
        }

        $query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
        $checkMatch = mysqli_query( $mysqli, $query ) or die( mysqli_error( $mysqli ) );

        if ($checkMatch->num_rows == 1) {
            return true;
        } else {
            return false;
        }
    }

    /*
     * Getters
     */
    public function getId()
    {
        return $this->userId;
    }

    public function getUserName()
    {
        return $this->userName;
    }

    public function getAlbums( $mysqli )
    {
        include_once 'system/models/album.php';
        return Album::getAlbumsByOwnerId( $mysqli, $this->userId );
    }

    /*
     * Setters
     */
    public function changePassword( $mysqli, $password )
    {
        $password = md5( $password );
        $query = "UPDATE user SET password='$password' WHERE userid='$this->userId'";
        $password = null;
        mysqli_query( $mysqli, $query ) or die( mysqli_error( $mysqli ) );
    }

    /*
     * Private methods
     */
    private static function parseInput( $input )
    {
        $regex = '/[^a-zA-Z0-9_]/';
        return preg_replace( $regex, '', $input );
    }
}