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

?>
<main class="container">
    <div class="row">
        <div class="col-md-12">
            <header class="jumbotron">
                <h1 class="text-center">
                    <?=htmlspecialchars( $user->getUserName() )?>
                </h1>
            </header>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <section class="well">

            </section>
        </div>
    </div>
</main>
<?php include_once( 'views/partials/footer.php' );