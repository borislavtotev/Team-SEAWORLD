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

$albumsCount = 10;
$rows = ceil( $albumsCount / 3 );

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
            </header>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <section>
                <?php for ($row = 0, $pics = 0; $row < $rows; $row++): ?>
                <div class="row">
                    <?php for($col = 0; $col < 3 && $pics < $albumsCount; $col++, $pics++) :?>
                        <div class="col-md-4">
                            <figure>
                                <a href="/album.php?id=">
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