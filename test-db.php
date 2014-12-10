<?php
include_once( 'system/db-connect.php' );
include_once( 'system/models/album.php' );

//$album->createNewAlbum( 'albumName', 'userId' );

$album = new Album( $mysqli );
$albums = $album->getAlbumsByName('');

if (count( $albums )): ?>
<table>
    <thead>
    <tr>
        <th>Album id</th>
        <th>Album Name</th>
        <th>Album owner id</th>
        <th>Created</th>
        <th>Pictures count</th>
        <th>Rating</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($albums as $album): ?>
        <tr>
            <td><?=htmlentities($album->id)?></td>
            <td><?=htmlentities($album->name)?></td>
            <td><?=htmlentities($album->userid)?></td>
            <td><?=htmlentities($album->dateCreated)?></td>
            <td><?=htmlentities($album->picturesCount)?></td>
            <td><?=htmlentities($album->rating)?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>