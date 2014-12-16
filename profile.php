<?php
include_once( 'views/partials/header.php' );
include_once( 'system/db-connect.php' );
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset( $_GET[ 'id' ] )) {
    $user = new User( $mysqli, $_GET[ 'id' ] );
} else if (isset( $_SESSION[ 'user' ] )) {
    $user = $_SESSION[ 'user' ];
} else {
    // No id? Get the fuck outta here!
    header( 'Location: index.php' );
}

$albums = Album::getAlbumsByOwnerId( $mysqli, $user->getId() );
$rows = ceil( count( $albums ) / 3 );
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
            <section>
                <?php //for ($row = 0, $pics = 0; $row < $rows; $row++): ?>
                <div class="row">
                    <?php foreach($albums as $album) :?>
                        <div class="col-md-4">
                            <figure>
                                <a href="./album.php?id=<?=$album->getId()?>">
                                    <img class="img-responsive" src="http://oleaass.com/wp-content/uploads/2014/09/PHP.png">
                                </a>
                                <figcaption class="text-center"><?=$album->getName()?></figcaption>
                            </figure>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php //endfor; ?>
            </section>
        </div>
    </div>
</main>
<?php
include( 'views/modals/file-upload.php' );
include_once( 'views/partials/footer.php' );