<?php
include_once( 'views/partials/header.php' );

$albums = Album::getAllAlbums();
$rows = ceil( count($albums) / 3 );
$userId = $_SESSION['user']->getID();

if (!isset($_GET['id'])) {
?>
<main class="container">
    <div class="row">
        <div class="col-md-12">
            <section>
                <?php for ($row = 0, $pics = 0; $row < $rows; $row++): ?>
                <div class="row">
                    <?php for($col = 0; $col < 3 && $pics < count($albums); $col++, $pics++) :
                    	$albumId = $albums[$pics]->getId();
						$albumName = $albums[$pics]->getName();
						$sourcePath = $albums[$pics]->getFirstPic($userId,$albumId);
                    	?>
                        <div class="col-md-4">
                            <figure>
                                <a href="./albums.php?id=<?=$albums[$pics]->getId()?>">
                                    <img class="img-responsive" src=<?= $sourcePath ?>>
                                </a>
                                <figcaption class="text-center"><?= htmlentities($albumName) ?></figcaption>
                            </figure>
                        </div>
                    <?php endfor; ?>
                </div>
                <?php endfor; ?>
            </section>
        </div>
    </div>
</main>
<?php 
	}
else {
	$album = Album::getAlbumById($_GET['id']);	
	
	if (!$album instanceof Album) {
		$_SESSION['error'] = "Invalid Album Id";
	}
	
	$count=$album->getPicturesCount();
	$rows = ceil( $count / 3 );
	$picPaths = $album->getAllPicturesPath($userId, $_GET['id']);
?>
<main class="container">
    <div class="row">
        <div class="col-md-12">
            <section>
                <?php for ($row = 0, $pics = 0; $row < $rows; $row++): ?>
                <div class="row">
                    <?php for($col = 0; $col < 3 && $pics < $count; $col++, $pics++) :?>
                        <div class="col-md-4">
                            <figure>
                                    <img class="img-responsive" src=<?= $picPaths[$pics] ?>>
                                <figcaption class="text-center">To do</figcaption>
                            </figure>
                        </div>
                    <?php endfor; ?>
                </div>
                <?php endfor; ?>
            </section>
        </div>
    </div>
</main>
<?php
}
include_once( 'views/partials/footer.php' );