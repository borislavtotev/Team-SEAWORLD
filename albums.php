<?php
include_once( 'views/partials/header.php' );

$albumsCount = 9;
$rows = ceil( $albumsCount / 3 );
?>
<main class="container">
    <div class="row">
        <div class="col-md-12">
            <section>
                <?php for ($row = 0, $pics = 0; $row < $rows; $row++): ?>
                <div class="row">
                    <?php for($col = 0; $col < 3 && $pics < $albumsCount; $col++, $pics++) :?>
                        <div class="col-md-4">
                            <figure>
                                <a href="./album.php?id=">
                                    <img class="img-responsive" src="http://oleaass.com/wp-content/uploads/2014/09/PHP.png">
                                </a>
                                <figcaption class="text-center">Album Name</figcaption>
                            </figure>
                        </div>
                    <?php endfor; ?>
                </div>
                <?php endfor; ?>
            </section>
        </div>
    </div>
</main>
<?php include_once( 'views/partials/footer.php' );