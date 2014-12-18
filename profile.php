<?php
include_once( 'views/partials/header.php' );

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset( $_GET[ 'id' ] )) {
    $user = new User( $_GET[ 'id' ] );
} else if (isset( $_SESSION[ 'user' ] )) {
    $user = $_SESSION[ 'user' ];
} else {
    // No id? Get the fuck outta here!
    header( 'Location: index.php' );
}
?>
<main class="container">
    <div class="row">
        <div class="col-md-12">
            <header class="jumbotron">
                <hgroup>
                    <h1 class="text-center">
                        <?=htmlspecialchars( $user->getUserName() )?>
                    </h1>
                    <h3 class="text-right">
                        <?=htmlspecialchars( $user->getEmail() )?>
                    </h3>
                </hgroup>
                <?php if (isset( $_SESSION[ 'user' ] ) && $user == $_SESSION[ 'user' ]): ?>
                <div class="butt-group">
                    <button type="button" class="btn btn-primary" id="left-butt"  data-modal-type="login" data-toggle="modal" data-target="#filesUpload">Upload Picture</button>
                    <button type="button" class="btn btn-primary" id="right-butt" data-modal-type="login" data-toggle="modal" data-target="#createAlbumModal">Make Album</button>
                </div>
                <?php endif; ?>
            </header>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <section id="albums-container">
                <div class="jumbotron">
                <div class="row">
                    <?php foreach(Album::getAlbumsByOwnerId( $user->getId() ) as $album) :?>
                        <div class="col-md-4 figure-holder animated zoomIn">
                            <?php if (isset( $_SESSION[ 'user' ] ) && $album->getOwnerId() == $_SESSION['user']->getId()): ?>
                            <button data-albumid="<?=$album->getId()?>" class="delete-btn"></button>
                            <?php endif; ?>
                            <figure>
                                <a href="./albums.php?id=<?=$album->getId()?>">
                                    <img class="img-responsive" src=<?= $album->getFirstPic()->getFullPath() ?>>
                                </a>
                                <figcaption class="text-center text-success">Name: <?= htmlentities($album->getName()) ?></figcaption>
                                <figcaption class="text-center text-danger">Date created: <?= $album->getDateCreated() ?></figcaption>
                                <?php $creator = new User( $album->getOwnerId() ); ?>
                                <figcaption class="text-center text-warning">Created by: <?= htmlentities($creator->getUserName()) ?></figcaption>
                                <figcaption class="text-center text-success">
                                    <button class="vote vote-up" data-target-type="1" data-target="<?= $album -> getId()?>"></button>
                                    Up votes: <span class="up"><?=$album->getRating()['ups']?></span> |
                                    Down votes: <span class="down"><?=$album->getRating()['downs']?></span>
                                    <button class="vote vote-down" data-target-type="1" data-target="<?= $album -> getId()?>"></button>
                                </figcaption>
                                <?php $numberOfComments = Comments::countAlbumComments($album -> getId()); ?>
                                <figcaption class="text-center text-success">Comments: <?= $numberOfComments ?></figcaption>
                            </figure>
                        </div>
                    <?php endforeach; ?>
                </div>
                    </div>
            </section>
        </div>
    </div>
</main>
<?php include_once( 'views/partials/footer.php' );