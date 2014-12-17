<?php
include_once( 'views/partials/header.php' );

$picture = null;
if (isset( $_GET[ 'id' ] ) && is_numeric( $_GET[ 'id' ] )) {
    $picture = Picture::getPicById( $_GET[ 'id' ] );
    if ($picture != null) {
        $_SESSION['errors'] = "This picture is not available!";
		
		$creator = new User( $picture->getOwnerId() );
	}
} else {
	//To do redirect
}

?>
                            <div class="col-md-12 figure-holder">
                                <figure>
                                    <img class="img-responsive" src=<?= $picture->getFullPath() ?>>
                                    <figcaption class="text-center text-success">Name: <?= htmlentities($picture->getName()) ?></figcaption>
                                    <figcaption class="text-center text-danger">Date created: <?= $picture->getDateUploaded() ?></figcaption>
                                    <figcaption class="text-center text-warning">Created by: <?= htmlentities($creator->getUserName()) ?></figcaption>
                                    <figcaption class="text-center text-success">
                                        <button class="vote-up"></button>
                                        Up votes: <?=$picture->getRating()['ups']?> |
                                        Down votes: <?=$picture->getRating()['downs']?>
                                        <button class="vote-down"></button>
                                    </figcaption>
                                    <figcaption class="text-center text-success">Comments: <?=Comments::countPicComments($_GET['id']) ?></figcaption>
                                </figure>
<?php 
if ($_SESSION['user'] instanceof User) {

    if (isset($_POST['addComment'])) {

       Comments::addComment($_SESSION['user']->getId(), $_GET[ 'id' ], $picture->getAlbumId(), $_POST['comment']);;
    }
    ?>
                                <form method="post">
                                	<label>Add Comment:</label>
                                	<textarea name="comment"></textarea>
                                	<input type="submit" name="addComment" />
                                </form>
                            </div>
<?php
}
$comments = Comments::getAllCommentsByPicId($_GET[ 'id' ]);
if ($comments) {
	foreach ($comments as $key => $value) {
		echo $value['content'].' '.$value['date'].' '.$value['userid'].'<br>';
	}
}
?>
