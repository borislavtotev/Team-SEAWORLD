<?php
class User
{
    private $userId;
	private $userName;
    private $email;

    public function __construct( $id )
    {
        $getUserIdQuery = "SELECT username, email FROM users WHERE userid='$id'";
        $result = $GLOBALS[ 'mysqli' ]->query( $getUserIdQuery ) or die( mysqli_error( $GLOBALS[ 'mysqli' ] ) );
        $userData = $result->fetch_assoc();

        $this->userId = $id;
        $this->userName = $userData[ 'username' ];
        $this->email = $userData[ 'email' ];;
    }

    /*
     * Static methods
     */
    public static function createUser( $userName, $email, $password )
    {
		$checkedUser = User::checkUserInputs( $userName, $email, $password);
		$hashPass = md5( $password );
		
		if ($checkedUser===true) {
	        $insertUserQuery = "INSERT INTO users(username, email, password) VALUES('$userName', '$email', '$hashPass')";
	        $password = null; // Delete that info from the memory!!
	        mysqli_query( $GLOBALS[ 'mysqli' ], $insertUserQuery ) or die( mysqli_error( $GLOBALS[ 'mysqli' ] ) );
	
	        $getUserIdQuery = "SELECT userid FROM users WHERE username='$userName'";
	        $result = $GLOBALS[ 'mysqli' ]->query( $getUserIdQuery ) or die( mysqli_error( $GLOBALS[ 'mysqli' ] ) );
	
	        return new User( $result->fetch_assoc()[ 'userid' ] );
		} else {
			return $checkedUser;
		}
    }

    public static function login( $username, $password )
    {
        $hashPass = md5( $password );

        $errors = '';
		$findError = false;
        
        if ( empty( $username ) ) {
        	$errors.="The user name can not be empty!<br>";
			$findError = true;
        }
		
		if ( empty( $password ) ) {
        	$errors.="The password can not be empty!<br>";
			$findError = true;
        }

        if (! $findError ) {
	        $query = "SELECT userid FROM users WHERE username='$username' AND password='$hashPass'";
	        $checkMatch = mysqli_query( $GLOBALS[ 'mysqli' ], $query ) or die( mysqli_error( $GLOBALS[ 'mysqli' ] ) );
	
	        if ($checkMatch->num_rows == 1) {
	            return new User( $checkMatch->fetch_assoc()[ 'userid' ] );
	        } else {
	        	$errors.="Wrong user name and/or password!<br>";
				return $errors;
	        }
		} else {
			return $errors;
		}
    }

    public static function getAllUsers()
    {
        $query = "SELECT userid FROM users";
        $result = $GLOBALS[ 'mysqli' ]->query( $query ) or die ( mysqli_error( $GLOBALS[ 'mysqli' ] ) );
        $users = [];
        if ($result->num_rows > 0) {
            while ($userData = $result->fetch_assoc()) {
                $users[] = new User( $userData[ 'userid' ] );
            }
        }

        return $users;
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

    public function getAlbums()
    {
        include_once 'system/models/album.php';
        return Album::getAlbumsByOwnerId( $this->userId );
    }

    public function getEmail()
    {
        return $this->email;
    }

    /*
     * Setters
     */
    public function changePassword( $password )
    {
        $password = md5( $password );
        $query = "UPDATE users SET password='$password' WHERE userid='$this->userId'";
        $password = null;
        mysqli_query( $GLOBALS[ 'mysqli' ], $query ) or die( mysqli_error( $GLOBALS[ 'mysqli' ] ) );
    }

    /*
     * Private methods
     */
	private static function checkUserInputs ($userName, $email, $password) {

        $selectByUserNameQuery = "SELECT * FROM users WHERE username='$userName'";
        $result = $GLOBALS[ 'mysqli' ]->query( $selectByUserNameQuery );
        
        $errors = '';
		$findError = false;
		
        if ( $result->num_rows > 0 ) {
            $errors.='User with that username already exists!<br>';
			$findError = true;
        }

	    if (mb_strlen($userName) < 3 || mb_strlen($userName) > 15) {
	        $errors.= 'The user name must have more than 3 and less than 15 symbols!<br>';	
			$findError = true;
	    }
	
	    if (preg_match('/[^A-Za-z0-9]+/', $userName)) {
	        $errors.= 'The user name must have only latin letter and numbers!<br>';	
			$findError = true;
	    }
	
	    if (!preg_match('/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,6}$/', $email)) {
	        $errors.= 'The email address is not valid!<br>';	
			$findError = true;
	    }
	    
	    if (mb_strlen($password) < 3 || mb_strlen($password) > 30) {
	        $errors.= 'The password must have more than 3 and less than 30 symbols!<br>';	
			$findError = true;
	    } 
	
	    if (! $findError) {
	    	return true;
		} else {
			return $errors;
		}
	}
}