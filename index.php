<?php
const TOP_RATED_ELEMENTS_COUNT = 5;

include_once( 'views/partials/header.php' );


function sortById( $left, $right )
{
    $leftRating = $left->getRating();
    $leftTotalRating = $leftRating[ 'ups' ] - $leftRating[ 'downs' ];
    $rightRating = $right->GetRating();
    $rightTotalRating = $rightRating[ 'ups' ] - $rightRating[ 'downs' ];

    return $rightTotalRating-$leftTotalRating;
}

$albums = Album::getAllAlbums();
usort( $albums, 'sortById' );

$pictures = [];
foreach ($albums as $album) {
    $pictures = array_merge( $album->getPictures(), $pictures );
}
usort( $pictures, 'sortById' );
?>
<div class="container">
    <header class="row">
        <div class="col-md-12">
            <div class="jumbotron animated fadeInDownBig">
                <hgroup>
                    <h1 class="text-center">Programators!</h1>
                    <h2 class="text-center">Weird programmers. One place.</h2>
                </hgroup>
                <img src="img/hd_computer_guy_meme_by_zapgod16-d4t2jh3.png" alt="" id="baner" class="img-responsive" alt="Responsive image"/>
                <?php if (isset( $_SESSION[ 'user' ] )): ?>
                <div class="butt-group">
                    <button type="button" class="btn btn-primary" id="left-butt" data-modal-type="login" data-toggle="modal" data-target="#filesUpload">Upload Picture</button>
                    <button type="button" class="btn btn-primary" id="right-butt" data-modal-type="login" data-toggle="modal" data-target="#createAlbumModal">Make Album</button>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </header>
    <main class="row">
        <div class="col-md-6">
            <section class="panel panel-danger animated rotateInDownLeft">
                <header class="panel-heading">
                    <h3 class="panel-title">Top rated albums</h3>
                </header>
                <div class="panel-body">
                    <div class="list-group">
                    <?php foreach(array_slice( $albums, 0, TOP_RATED_ELEMENTS_COUNT ) as $album):
                        if ($album->getRating()[ 'ups' ] > 0):
                            if ($album->getPicturesCount() > 0 ): ?>
                            <a href="./albums.php?id=<?=$album->getId()?>" class="list-group-item">
                            <?php endif; ?>
                                <h4 class="list-group-item-heading">
                                    <?= htmlspecialchars( $album->getName() ) ?>
                                </h4>
                                <p class="list-group-item-text text-warning">
                                    <?php $owner = new User( $album->getOwnerId() ); ?>
                                    Made by <?= htmlspecialchars( $owner->getUserName() ) ?>
                                </p>
                            <?php if ($album->getPicturesCount() > 0): ?>
                            </a>
                            <?php endif;
                        endif;
                    endforeach; ?>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-md-6">
            <section class="panel panel-info animated rotateInDownRight">
                <header class="panel-heading">
                    <h3 class="panel-title">Top rated pictures</h3>
                </header>
                <div class="panel-body">
                    <div class="list-group">
                    <?php foreach(array_slice( $pictures, 0, TOP_RATED_ELEMENTS_COUNT ) as $picture):
                        if ($picture->getId() != null) : ?>
                        <a href="./pictures.php?id=<?=$picture->getId()?>" class="list-group-item">
                            <h4 class="list-group-item-heading">
                                <?= htmlspecialchars( $picture->getName() ) ?>
                            </h4>
                            <p class="list-group-item-text text-warning">
                                <?php $owner = new User( $picture->getOwnerId() ); ?>
                                Uploaded by <?= htmlspecialchars( $owner->getUserName() ) ?>
                            </p>
                        </a>
                        <?php endif;
                    endforeach; ?>
                    </div>
                </div>
            </section>
        </div>
    </main>
</div>
<?php include_once( 'views/partials/footer.php' ); ?>