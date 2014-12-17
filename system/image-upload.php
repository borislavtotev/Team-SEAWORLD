<?php
const MAX_FILE_SIZE = 10000000; // 10 MB

$uploadedFiles = [];
$errors = [];
if (isset( $_FILES[ 'files' ] )) {
    for ($i = 0; $i < count( $_FILES[ 'files' ][ 'name' ] ); $i++) {
    	$ext = pathinfo($_FILES['files']['name'][$i], PATHINFO_EXTENSION);
        $fileName = $_POST['upl-img-name'][$i] . '.' . $ext;

        if (empty( $_POST[ 'upl-img-name' ][ $i ] )) {
            $fileName = $_FILES[ 'files' ][ 'name' ];
        }

        $fileType = $_FILES[ 'files' ][ 'type' ][ $i ];
        $fileSize = $_FILES[ 'files' ][ 'size' ][ $i ];
        $filePath = $_FILES[ 'files' ][ 'tmp_name' ][$i ];

        if ($fileSize > MAX_FILE_SIZE) {
            $errors[] = "Skipped file $fileName! Too large! Maximum size = " . MAX_FILE_SIZE .'!';
        } else if (!preg_match( '/image\/png|jpg|gif|jpeg/', $fileType )) {
            $errors[] = "Skipped file $fileName! File type is not image!";
        } else {
            $uploadedFiles[] = [ 'name' => $fileName, 'size' => $fileSize, 'location' => $filePath ];
        }
    }
}

if (isset( $_POST[ 'albumId' ] ) || !empty( $_POST[ 'albumId' ] )) {
    $album = Album::getAlbumById( $_POST[ 'albumId' ] );
    if ($album->getOwnerId() != $_SESSION[ 'user' ]->getId()) {
        die( 'No chance to upload pic in foreign album! :D:D' );
    }

    foreach ($uploadedFiles as $file) {
        $album->addPic( $file[ 'name' ], $file[ 'location' ] );
    }

    if (count( $errors )) {
        $_SESSION[ 'error' ] = implode( ' ', $errors );
    }
}