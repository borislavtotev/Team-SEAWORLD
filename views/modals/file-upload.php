<?php
include_once 'system/image-upload.php';
$albums = Album::getAlbumsByOwnerId( $_SESSION[ 'user' ]->getId() );
?>
<div class="modal fade" id="filesUpload" tabindex="-1" role="dialog" aria-labelledby="FilesUpload" aria-hidden="true">
    <form id="uploadForm" action="#" method="post" class="form-horizontal" enctype="multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Upload images</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="albumSelection" class="control-label col-lg-4">Select album:</label>
                        <div class="col-lg-8">
                            <select id="albumSelection" class="form-control" name="albumId">
                                <?php foreach ($albums as $album): ?>
                                <option value="<?=$album->getId()?>"><?=htmlspecialchars( $album->getName() )?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <input type="text" name="upl-img-name[]" class="form-control" placeholder="Name">
                        </div>
                        <div class="col-md-6">
                            <input type="file" name="files[]" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-warning btn-md pull-left" type="button" id="add-img-btn">More images</button>
                    <!--Hidden input used to get current URL (used function from the header)-->
                    <input type="hidden" name="getCurrentURL" value="<?= currentPageURL() ?>">

                    <input type="submit" class="btn btn-danger btn-tg pull-left" value="Upload"/>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </form>
</div>