<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["file"]["size"] > 50000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg"
&& $fileType != "gif" && $fileType != "pdf" ) {
    echo "Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["file"]["name"])). " has been uploaded.";
        // Save information to a file or database here
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
