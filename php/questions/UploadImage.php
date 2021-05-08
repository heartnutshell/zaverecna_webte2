<?php
$target_dir = "files/"; //change to whatever we will be saving it to
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

if($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg") {
  echo "Filetype not allowed. Only jpg, jpeg and png is allowed!";
  $uploadOk = 0;
}

if ($_FILES["fileToUpload"]["size"] > 2000000) {
    echo "File is too large.";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "Your file was not uploaded.";
} else {
    // file name from studenID and questionID?
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir. $_GET["studentID"]."_".$_GET["questionID"].$fileType)) {
        echo "File has been uploaded.";
    } else {
        echo "There was an error uploading your file.";
    }
}
?>