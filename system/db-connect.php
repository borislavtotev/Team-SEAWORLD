<?php
//$mysql_host = "mysql17.000webhost.com";
//$mysql_database = "a6289514_maindb";
//$mysql_user = "a6289514_admin";
//$mysql_password = "https1";

$mysqli = mysqli_connect( 'localhost', 'test', 'test', 'SEAWORLD' );

if ($mysqli->connect_errno) {
    die( "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error );
}