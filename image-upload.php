<?php
    if((!isset($_SESSION['user']))) {
       header("Location:index.php");
}
?>
<?php include 'views/modals/file-upload.php'; ?>
<!--<input type="file" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#filesUpload" name="imgUpload">
    Upload files
</input>->
<?php
    $target_dir = "upload/";
    $target_file = $target_dir . basename($_FILES["imgUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    if(isset($_POST["imgUpload"])) {
        $check = getimagesize($_FILES["imgUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    // Check if file exists...ebem go
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check file size(kolko e goem)
    if ($_FILES["imgUpload"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats(formati)
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error(kyr demek)
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["imgUpload"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["imgUpload"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
?>