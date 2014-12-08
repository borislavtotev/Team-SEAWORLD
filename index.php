<?php
include( 'database/database.php' );
$database = new DataBase();

$user = [ 'firstName' => 'Smotanqk', 'lastName' => 'Prost' ];
$usersArray = [
    [ 'firstName' => 'Gosho', 'lastName' => 'Goshev' ],
    [ 'firstName' => 'Kak', 'lastName' => 'Si' ]
];
$userAsObject = (object)[ 'firstName' => 'Pinokio', 'lastName' => 'Pinokiev' ];

$database->addToTable( 'users', $user );
$database->addToTable( 'users', $usersArray );
$database->addToTable( 'users', $userAsObject );
?>
<!DOCTYPE html>
<html>
<head>
    <title>ASd</title>
    <style type="text/css">
        table { width: 800px; margin: auto }
        td, th, table { border: 1px solid black; }
    </style>
</head>
<body>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
    </tr>
    </thead>
    <tbody>
        <?php foreach ($database->getTableContents( 'users' ) as $user): ?>
        <tr>
            <td><?=$user->id?></td>
            <td><?=$user->firstName?></td>
            <td><?=$user->lastName?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>