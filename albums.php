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
                            $hasLink = true;
                            $path = '';
                            if ($element instanceof Album) {
                                $src = $element->getFirstPic()->getFullPath();
                                $dateCreated = $element->getDateCreated();
                                $albumId = $element->getId();
								$numberOfComments = Comments::countAlbumComments($albumId);
                                $hasLink = $element->getPicturesCount() == 0 ? false : true;
                                $path = "./albums.php?id=".$element->getId();
                            } else {
                                $src = $element->getFullPath();
                                $picId = $element->getId();
                                $dateCreated = $element->getDateUploaded();
								$numberOfComments = Comments::countPicComments($picId);
                                $hasLink = $element->getId() == null ? false : true;
                                $path = "./pictures.php?id=".$element->getId();
                            } ?>
                            <div class="col-md-4 figure-holder animated zoomIn">
                                <?php if ($ownerId == $element -> getOwnerId()): ?>
                                    <button data-picid="<?=$picId?>" data-albumid="<?=$albumId?>" class="delete-btn"></button>
                                <?php endif; ?>
                                <figure>
                                    <?php if( $hasLink ): ?>
                                    <a href="<?= $path ?>">
                                    <?php endif; ?>
                                        <img class="img-responsive" src="<?= $src ?>">
                                    <?php if( $hasLink ): ?>
                                    </a>
                                    <?php endif; ?>
                                    <figcaption class="text-center text-success">Name: <?= htmlentities($element->getName()) ?></figcaption>
                                    <figcaption class="text-center text-danger">Date created: <?= $dateCreated ?></figcaption>
                                    <figcaption class="text-center text-warning">Created by: <?= htmlentities($creator->getUserName()) ?></figcaption>
                                    <figcaption class="text-center text-success">
                                        <button class="vote vote-up" data-target-type="<?=$element instanceof Album?>" data-target="<?= $element -> getId()?>"></button>
                                        Up votes: <span class="up"><?=$element->getRating()['ups']?></span> |
                                        Down votes: <span class="down"><?=$element->getRating()['downs']?></span>
                                        <button class="vote vote-down" data-target-type="<?=$element instanceof Album?>" data-target="<?= $element -> getId()?>"></button>
                                    </figcaption>
                                    <figcaption class="text-center text-success">Comments: <?= $numberOfComments ?></figcaption>
                                </figure>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>
            </div>
        </div>
     <section class="row animated">
        <div class="comments-holder">
            <article id="comment-template" style="display: none;" class="col-md-12 comment-container animated fadeInDown">
                <div class="jumbotron">
                    <p></p>
                    <span class="pull-left text-danger"></span>
                    <span class="pull-right text-danger"></span>
                </div>
            </article>
            <?php 
            if (isset($_GET[ 'id' ])) :
                foreach(Comments::getAllCommentsByAlbumId( $_GET[ 'id' ] ) as $comment): ?>
            <article class="col-md-12 comment-container animated fadeInDown">
                <div class="jumbotron">
                    <p><?=htmlspecialchars( $comment[ 'content' ] )?></p>
                    <?php $commentOwner = new User( $comment[ 'userid' ] ); ?>
                    <span class="pull-left text-danger">By <?=htmlspecialchars( $commentOwner->getUserName() )?></span>
                    <span class="pull-right text-danger"><?=$comment[ 'date' ]?></span>
                </div>
            </article>
            <?php endforeach;
            if (isset( $_SESSION[ 'user' ] )): ?>
            <section class="col-md-12">
                <div class="comment-form-container">
                    <form id="comment-form" role="form" method="post" action="#">
                        <input type="hidden" value="<?=$_GET[ 'id' ]?>" id="albumId">
                        <input type="hidden" value="" id="picId">
                        <div class="form-group">
                            <textarea name="comment" class="form-control" id="inputComment"></textarea>
                        </div>
                        <div class="center-block">
                            <button id="submit-comment-btn" type="submit" class="btn btn-warning">Post comment</button>
                        </div>
                    </form>
                </div>
            </section>
            <?php endif;
            endif; ?>
        </div>
    </section>
 
    </main>
<?php include_once( 'views/partials/footer.php' );