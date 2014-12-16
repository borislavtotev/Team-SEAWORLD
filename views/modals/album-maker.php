<?php
include_once 'system/models/album.php';
include_once 'system/db-connect.php';
if (isset( $_POST[ 'albumName' ] ) && !empty( $_POST[ 'albumName' ] )) {
    Album::createAlbum( $mysqli, $_POST[ 'albumName' ], $_SESSION[ 'user' ]->getId() );
}
?>
<div class="modal fade" id="createAlbumModal" tabindex="-1" role="dialog" aria-labelledby="CreateAlbum" aria-hidden="true">
    <form id="albumMaker" action="./index.php" method="post" class="form-horizontal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Create album</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-lg-10">
                            <label for="inputName">Album name:</label>
                            <input type="text" name="albumName" id="inputName">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-warning pull-left btn-md" value="Create"/>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </form>
</div>