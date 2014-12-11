<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$userId = '';
if (isset( $_GET[ 'id' ] )) {
    $userId = $_GET[ 'id' ];
} else if (isset( $_SESSION[ 'userid' ] )) {
    $userId = $_SESSION[ 'userid' ];
} else {
    // I'm useless without id! Get the fuck outta here!
    header( 'Location: index.php' );
}

/*
 * Here we must get some information for the user with this id!
 * Also if the id matches the id of the logged user,
 * we must provide a way for him to update his profile!
 *
 *
 */
$userName = 'unknown'; // For now :D

if (isset( $_SESSION[ 'username' ] )) {
    $userName = $_SESSION[ 'username' ];
}

$user = (object)[
    'username' => $userName
];
include_once( 'views/partials/header.php' ); ?>
<main class="container">
    <div class="row">
        <div class="col-md-12">
            <header class="jumbotron">
                <div class="row">
                    <div class="col-md-6">
                        <img src="" alt="avatar">
                    </div>
                    <div class="col-md-6">
                        <h1><?=htmlspecialchars( $user->username )?></h1>
                    </div>
                </div>
            </header>
            <section>
                Maybe albums here?
            </section>
        </div>
    </div>
</main>
<?php include_once( 'views/partials/footer.php' );