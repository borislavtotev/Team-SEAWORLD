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
                <div class="row">
                    <?php foreach(Album::getAlbumsByOwnerId( $user->getId() ) as $album) :?>
                        <div class="col-md-4 figure-holder">
                            <?php if (isset( $_SESSION[ 'user' ] ) && $album->getOwnerId() == $_SESSION['user']->getId()): ?>
                            <button data-albumid="<?=$album->getId()?>" class="delete-btn"></button>
                            <?php endif; ?>
                            <figure>
                                <a href="./albums.php?id=<?=$album->getId()?>">
                                    <img class="img-responsive" src=<?= $album->getFirstPic() ?>>
                                </a>
                                <figcaption class="text-center"><?= htmlspecialchars( $album->getName() )?></figcaption>
                            </figure>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        </div>
    </div>
</main>
<?php include_once( 'views/partials/footer.php' );