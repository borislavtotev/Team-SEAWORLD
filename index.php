<?php
include_once( 'views/partials/header.php' );
/*
 * Simulate extraction from db
 */

$albums = [
    (object)[ 'name' => 'Nai-qkiq', 'owner' => 'Unknown' ],
    (object)[ 'name' => 'Second album', 'owner' => 'Known' ]
];
$pictures = [
    (object)[ 'title' => 'Porn pic', 'owner' => 'Unknown' ],
    (object)[ 'title' => 'Second pic', 'owner' => 'Known' ]
];

// This should be printed in better place! It's just sample!
if (isset( $_GET[ 'error' ] )) {
    echo $_GET[ 'error' ];
}

?>
<div class="container">
    <header class="row">
        <div class="col-md-12">
            <div class="jumbotron">
                <h1 class="text-center">Programators!</h1>
                <h2 class="text-center">Изпрограмирайте се най - шашаво!</h2>
            </div>
        </div>
    </header>
    <main class="row">
        <div class="col-md-6">
            <section class="panel panel-danger">
                <header class="panel-heading">
                    <h3 class="panel-title">Top rated albums</h3>
                </header>
                <div class="panel-body">
                    <div class="list-group">
                    <?php foreach($albums as $album): ?>
                        <a href="#" class="list-group-item">
                            <h4 class="list-group-item-heading">
                                <?= htmlspecialchars( $album->name ) ?>
                            </h4>
                            <p class="list-group-item-text">
                                Made by <?= htmlspecialchars( $album->owner ) ?>
                            </p>
                        </a>
                    <?php endforeach; ?>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-md-6">
            <section class="panel panel-info">
                <header class="panel-heading">
                    <h3 class="panel-title">Top rated pictures</h3>
                </header>
                <div class="panel-body">
                    <div class="list-group">
                    <?php foreach($pictures as $picture): ?>
                        <a href="#" class="list-group-item">
                            <h4 class="list-group-item-heading">
                                <?= htmlspecialchars( $picture->title ) ?>
                            </h4>
                            <p class="list-group-item-text">
                                Uploaded by <?= htmlspecialchars( $picture->owner ) ?>
                            </p>
                        </a>
                    <?php endforeach; ?>
                    </div>
                </div>
            </section>
        </div>
    </main>
</div>
<?php include_once( 'views/partials/footer.php' ); ?>