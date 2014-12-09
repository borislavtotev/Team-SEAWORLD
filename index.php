<?php
include( 'database/database.php' );
$database = new DataBase();

if (isset( $_POST[ 'firstName' ], $_POST[ 'lastName' ] )) {
    if (!empty( $_POST[ 'firstName' ] ) && !empty( $_POST[ 'lastName' ] )) {
        $user = [ 'firstName' => $_POST[ 'firstName' ], 'lastName' => $_POST[ 'lastName' ] ];
        $database->addToTable( 'users', $user );
    }
}
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
<form method="post">
    <fieldset>
        <legend>Add user</legend>
        <label for="firstName">First Name:</label>
        <input type="text" name="firstName" id="firstName">
        <label for="lastName">Last Name:</label>
        <input type="text" name="lastName" id="lastName">
        <input type="submit">
    </fieldset>
    <fieldset>
        <legend>Remove user</legend>
        <label for="id">ID:</label>
        <input type="text" name="id" id="id">
        <input type="submit" value="Delete">
    </fieldset>
</form>
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
            <td><?=htmlspecialchars( $user->firstName )?></td>
            <td><?=htmlspecialchars( $user->lastName )?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>