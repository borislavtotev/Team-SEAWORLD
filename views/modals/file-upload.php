<?php
include 'views/partials/header.php';
?>
<div class="modal fade" id="filesUpload" tabindex="-1" role="dialog" aria-labelledby="FilesUpload" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Upload images</h4>
            </div>
            <div class="modal-body">
                <form id="uploadForm" action="#" method="post" class="form-horizontal" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="col-lg-10">
                            <input type="file" name="files[]">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div>
                    <button id="add-img-btn" type="button" class="btn btn-default pull-left">Add More Images</button>
                </div>
                <div>
                    <input type="submit" class="btn btn-danger btn-tg"/>
                </div>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php include 'views/partials/footer.php'; ?>