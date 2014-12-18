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

// Check for add comment request

?>
<main class="container-fluid">
    <div class="jumbotron">
    <div class="row">

            <section class="col-md-8">
                <img id="big-img" class="img-responsive" src="<?= $picture->getFullPath() ?>">
            </section>
            <aside class="col-md-4">
                <p class="text-center text-success">Name: <?= htmlentities($picture->getName()) ?></p>
                <p class="text-center text-danger">Date created: <?= $picture->getDateUploaded() ?></p>
                <p class="text-center text-warning">Created by: <?= htmlentities($creator->getUserName()) ?></p>
                <p class="text-center text-success">
                    <button data-target-type="false" data-target="<?=$picture->getId()?>" class="vote vote-up"></button>
                    Up votes: <span class="up"><?=$picture->getRating()['ups']?></span> |
                    Down votes: <span class="down"><?=$picture->getRating()['downs']?></span>
                    <button data-target-type="false" data-target="<?=$picture->getId()?>" class="vote vote-down"></button>
                </p>
                <p class="text-center text-success">Comments: <?=Comments::countPicComments($_GET['id']) ?></p>
            </aside>
        </div>
    </div>
    <section class="row animated">
        <div class="comments-holder">
            <article id="comment-template" style="display: none;" class="col-md-12 comment-container animated fadeInDown">
                <div class="jumbotron">
                    <p></p>
                    <span class="pull-left text-danger"></span>
                    <span class="pull-right text-danger"></span>
                </div>
            </article>
            <?php foreach(Comments::getAllCommentsByPicId( $_GET[ 'id' ] ) as $comment): ?>
            <article class="col-md-12 comment-container animated fadeInDown">
                <div class="jumbotron">
                    <p><?=htmlspecialchars( $comment[ 'content' ] )?></p>
                    <?php $commentOwner = new User( $comment[ 'userid' ] ); ?>
                    <span class="pull-left text-danger">By <?=htmlspecialchars( $commentOwner->getUserName() )?></span>
                    <span class="pull-right text-danger"><?=$comment[ 'date' ]?></span>
                </div>
            </article>
            <?php endforeach;
            if (isset( $_SESSION[ 'user' ] )): ?>
            <section class="col-md-12">
                <div class="comment-form-container">
                    <form id="comment-form" role="form" method="post" action="#">
                        <input type="hidden" value="<?=$_GET[ 'id' ]?>" id="picId">
                        <div class="form-group">
                            <textarea name="comment" class="form-control" id="inputComment"></textarea>
                        </div>
                        <div class="center-block">
                            <button id="submit-comment-btn" type="submit" class="btn btn-warning">Post comment</button>
                        </div>
                    </form>
                </div>
            </section>
            <?php endif; ?>
        </div>
    </section>

</main>
<?php include_once 'views/partials/footer.php'; ?>
