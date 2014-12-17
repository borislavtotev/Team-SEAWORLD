<?php
include_once( 'views/partials/header.php' );

$elements = null;
if (isset( $_GET[ 'id' ] ) && is_numeric( $_GET[ 'id' ] )) {
    $album = Album::getAlbumById( $_GET[ 'id' ] );
    if ($album != null)
        $elements = $album -> getPictures();
}

if ($elements == null) {
    $elements = Album::getAllAlbums();
}

if (isset( $_GET[ 'orderBy' ], $_GET[ 'order' ] ) && !empty( $_GET[ 'orderBy' ] ) && !empty( $_GET[ 'order' ] )) {
    function getProps( $element )
    {
        $props = [ 'id' => $element->getId(), 'name' => $element->getName(), 'rating' => $element->getRating() ];
        $props[ 'date-posted' ] = $element instanceof Album ? $element->getDateCreated() : $element->getDateUploaded();
        return $props;
    }
    usort( $elements, function( $left, $right )
    {
        $leftProps = $_GET[ 'order' ] == 'ascending' ? getProps( $left ) : getProps( $right );
        $rightProps = $_GET[ 'order' ] == 'ascending' ? getProps( $right ) : getProps( $left );
        if (is_numeric( $leftProps[ $_GET[ 'orderBy' ] ] )) {
            return $leftProps[ $_GET[ 'orderBy' ] ] - $rightProps[ $_GET[ 'orderBy' ] ];
        } else {
            return strcmp( $leftProps[ $_GET[ 'orderBy' ] ], $rightProps[ $_GET[ 'orderBy' ] ] );
        }
    });
}

$ownerId = -1;
if (isset( $_SESSION[ 'user' ] )) {
    $ownerId = $_SESSION[ 'user' ] -> getId();
}
?>
    <main class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="navbar navbar-default">
                    <div class="navbar-collapse collapse navbar-responsive-collapse">
                        <form class="navbar-form navbar-left" action="#" method="get">
                            <?php if (isset( $_GET[ 'id' ] ) && is_numeric( $_GET[ 'id' ] )): ?>
                            <input type="hidden" name="id" value="<?=$_GET[ 'id' ]?>">
                            <?php endif; ?>
                            <div class="form-group">
                                <label for="orderBy" class="control-label">Order By: </label>
                                <select name="orderBy" class="form-control" id="orderBy">
                                    <option value="name">Name</option>
                                    <option value="rating">Rating</option>
                                    <option value="date-posted">Date</option>
                                </select>
                            </div>
                            <div class="form-group order-holder">
                                <label for="order" class="control-label">Order: </label>
                                <select name="order" class="form-control" id="order">
                                    <option value="ascending">Ascending</option>
                                    <option value="desc">Descending</option>
                                </select>
                            </div>
                            <button type="submit" class="sort-btn btn btn-default btn-success">Sort</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <section id="albums-container">
                    <div class="row">
                        <?php foreach ($elements as $element) :
                            $creator = new User( $element->getOwnerId() );
                            $picId = '';
                            $albumId = '';
                            if ($element instanceof Album) {
                                $src = $element->getFirstPic()->getFullPath();
                                $dateCreated = $element->getDateCreated();
                                $albumId = $element->getId();
                            } else {
                                $src = $element->getFullPath();
                                $picId = $element->getId();
                                $dateCreated = $element->getDateUploaded();
                            } ?>
                            <div class="col-md-4 figure-holder">
                                <?php if ($ownerId == $element -> getOwnerId()): ?>
                                    <button data-picid="<?=$picId?>" data-albumid="<?=$albumId?>" class="delete-btn"></button>
                                <?php endif; ?>
                                <figure>
                                    <a href="./albums.php?id=<?= $element -> getId()?>">
                                        <img class="img-responsive" src=<?= $src ?>>
                                    </a>
                                    <figcaption class="text-center text-success">Name: <?= htmlentities($element->getName()) ?></figcaption>
                                    <figcaption class="text-center text-danger">Date created: <?= $dateCreated ?></figcaption>
                                    <figcaption class="text-center text-warning">Created by: <?= htmlentities($creator->getUserName()) ?></figcaption>
                                    <figcaption class="text-center text-success">
                                        <button class="vote-up"></button>
                                        Up votes: <?=$element->getRating()['ups']?> |
                                        Down votes: <?=$element->getRating()['downs']?>
                                        <button class="vote-down"></button>
                                    </figcaption>
                                </figure>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>
            </div>
        </div>
    </main>
<?php include_once( 'views/partials/footer.php' );