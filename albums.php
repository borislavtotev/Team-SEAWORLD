<?php
include_once( 'views/partials/header.php' );

$elements = null;
if (isset( $_GET[ 'id' ] )) {
    $album = Album::getAlbumById( $_GET[ 'id' ] );
    if ($album != null)
        $elements = $album -> getPictures();
}

if ($elements == null) {
    $elements = Album::getAllAlbums();
}

$ownerId = -1;
if (isset( $_SESSION[ 'user' ] )) {
    $ownerId = $_SESSION[ 'user' ] -> getId();
}
?>
    <main class="container">
        <div class="row">
            <div class="col-md-12">
                <section id="albums-container">
                    <div class="row">
                        <?php foreach ($elements as $element) :
                            $picId = '';
                            $albumId = '';
                            if ($element instanceof Album) {
                                $src = $element->getFirstPic();
                                $albumId = $element->getId();
                            } else {
                                $src = $element->getFullPath();
                                $picId = $element->getId();
                            } ?>
                            <div class="col-md-4 figure-holder">
                                <?php if ($ownerId == $element -> getOwnerId()): ?>
                                    <button data-picid="<?=$picId?>" data-albumid="<?=$albumId?>" class="delete-btn"></button>
                                <?php endif; ?>
                                <figure>
                                    <a href="./albums.php?id=<?=$element -> getId()?>">
                                        <img class="img-responsive" src=<?= $src ?>>
                                    </a>
                                    <figcaption class="text-center"><?= htmlentities($element->getName()) ?></figcaption>
                                </figure>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>
            </div>
        </div>
    </main>
<?php include_once( 'views/partials/footer.php' );