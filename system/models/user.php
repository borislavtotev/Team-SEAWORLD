<?php
class User
{
    private $userId;
	private $userName;
    private $email;

    public function __construct( $mysqli, $id )
    {
        $getUserIdQuery = "SELECT username, email FROM users WHERE userid='$id'";
        $result = $mysqli->query( $getUserIdQuery ) or die( mysqli_error( $mysqli ) );
        $userData = $result->fetch_assoc();

        $this->userId = $id;
        $this->userName = $userData[ 'username' ];
        $this->email = $userData[ 'email' ];;
    }

    /*
     * Static methods
     */
    public static function createUser( $mysqli, $userName, $email, $password )
    {
        $escapedUserName = User::parseInput( $userName );
        $password = md5( $password );


        $selectByUserNameQuery = "SELECT * FROM users WHERE username='$escapedUserName'";
        $result = $mysqli->query( $selectByUserNameQuery );
        if ( $result->num_rows > 0 ) {
            return 'User with that username already exists!';
        }

        $insertUserQuery = "INSERT INTO users(username, email, password) VALUES('$escapedUserName', '$email', '$password')";
        $password = null; // Delete that info from the memory!!
        mysqli_query( $mysqli, $insertUserQuery ) or die( mysqli_error( $mysqli ) );

        $getUserIdQuery = "SELECT userid FROM users WHERE username='$escapedUserName'";
        $result = $mysqli->query( $getUserIdQuery ) or die( mysqli_error( $mysqli ) );

        return new User( $mysqli, $result->fetch_assoc()[ 'userid' ] );
    }

    public static function login( $mysqli, $username, $password )
    {
        $parsedUsrName = User::parseInput( $username );
        $hashPass = md5( $password );

        if (empty( $parsedUsrName ) || empty( $hashPass ) ) {
            return null; // Empty fields means invalid login!
        }

        $query = "SELECT userid FROM users WHERE username='$parsedUsrName' AND password='$hashPass'";
        $checkMatch = mysqli_query( $mysqli, $query ) or die( mysqli_error( $mysqli ) );

        echo $checkMatch->num_rows;

        if ($checkMatch->num_rows == 1) {
            return new User( $mysqli, $checkMatch->fetch_assoc()[ 'userid' ] );
        } else {
            return null;
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
        $query = "UPDATE users SET password='$password' WHERE userid='$this->userId'";
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