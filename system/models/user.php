<?php
include_once( 'system/db-connect.php' );

class User
{
    private $mysqli;
	private $username;
	private $password;

    public function __construct( $mysqli )
    {
        $this->mysqli = $mysqli;

        /*
         * We can check here if such table exists
         * If not... we must create it
         */
    }

    public function createNewUser ( $username, $password )
    {
        if (!$this->checkInputs($username, $password)) {
            die ( 'Name and userID cannot be empty!' );
        } 

        $query = "INSERT INTO user(username, password) VALUES('$this->username', '$this->password')";

        return mysqli_query( $this->mysqli, $query ) or die( mysqli_error( $this->mysqli ) );
    }

    public function checkUser( $username, $password )
    {
        if (!$this->checkInputs($username, $password)) {
            die ( 'Name and userID cannot be empty!' );
		}		
		$query = "SELECT * FROM user WHERE username='$this->username' AND password='$this->password'";
        $checkMatch = mysqli_query($this->mysqli,$query) or die( mysqli_error( $this->mysqli ));
		echo var_dump($checkMatch);
        if ($checkMatch->num_rows == 1) {
        	return true;
		} else {
			return false;
		}
    }
	
	public function getUserId ( $username, $password )
	{
		$query = "SELECT userid FROM user WHERE username='$this->username' AND password='$this->password'";
        $checkMatch = mysqli_query($this->mysqli,$query) or die( mysqli_error( $this->mysqli ));
		echo var_dump($checkMatch);
        if ($checkMatch->num_rows == 1) {
        	while ($row=mysqli_fetch_assoc($checkMatch)){
                echo var_dump($row);	
                return $row['userid'];     
            }
		} else {
			return false;
		}					
	}

    private function parseInput( $input )
    {
        $regex = '/[^a-zA-Z0-9_]/';
        return preg_replace( $regex, '', $input );
    }
	
	private function checkInputs( $username, $password )
	{

        if (empty( $this->parseInput($username) ) || empty( $this->parseInput($password) ) ) {
            return false;
        } else {
        	$this->username = $this->parseInput($username);
        	$this->password = $this->parseInput($password);
        	return true;
        }
		
	}
	

}