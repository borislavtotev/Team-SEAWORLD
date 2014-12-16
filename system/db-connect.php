<?php
//$mysql_host = "mysql17.000webhost.com";
//$mysql_database = "a6289514_maindb";
//$mysql_user = "a6289514_admin";
//$mysql_password = "whatsmyname1";

$slavDb = 'php_teamproject';
$d0ntth1nc_DBname = 'somedb';

$dbName = 'firstDB';
$dbUser = 'root';
$dbPass = '';
$dbLocation = 'localhost';

$mysqli = mysqli_connect( $dbLocation, 'root', '', $d0ntth1nc_DBname );

if ($mysqli->connect_errno) {
    die( "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error );
}