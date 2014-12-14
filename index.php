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
?>
<div class="container">
    <header class="row">
        <div class="col-md-12">
            <div class="jumbotron animated fadeInDownBig">
                <hgroup>
                    <h1 class="text-center">Programators!</h1>
                    <h2 class="text-center">Изпрограмирайте се най - шашаво!</h2>
                </hgroup>
                <img src="img/hd_computer_guy_meme_by_zapgod16-d4t2jh3.png" alt="" id="baner" class="img-responsive" alt="Responsive image"/>
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
                    <?php foreach($albums as $album): ?>
                        <a href="#" class="list-group-item">
                            <h4 class="list-group-item-heading">
                                <?= htmlspecialchars( $album->name ) ?>
                            </h4>
                            <p class="list-group-item-text text-warning">
                                Made by <?= htmlspecialchars( $album->owner ) ?>
                            </p>
                        </a>
                    <?php endforeach; ?>
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
                    <?php foreach($pictures as $picture): ?>
                        <a href="#" class="list-group-item">
                            <h4 class="list-group-item-heading">
                                <?= htmlspecialchars( $picture->title ) ?>
                            </h4>
                            <p class="list-group-item-text text-warning">
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