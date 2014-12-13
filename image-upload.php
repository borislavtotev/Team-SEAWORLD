<?php include 'views/modals/file-upload.php'; ?>

<button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#filesUpload">
    Upload files
</button>
<?php
    if(isset ($_POST['files'])){
        echo "true";
    };
?>