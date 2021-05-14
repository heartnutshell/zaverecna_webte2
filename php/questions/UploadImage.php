<?php
    $target_dir = "uploadedAnswers/"; //change to whatever we will be saving it to
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg") {
        echo "<script type='text/javascript'>alert('Typ súboru nepovolený. Len jpg, jpeg a png sú povolené!');</script>";
    $uploadOk = 0;
    }

    if ($_FILES["fileToUpload"]["size"] > 2000000) {
        echo "<script type='text/javascript'>alert('Súbor je príliš veľký.');</script>";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "<script type='text/javascript'>alert('Súbor nebol nahratý.');</script>";
    } else {
        // file name from studenID and questionID?
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir. $_GET["studentID"]."_".$_GET["questionID"].$fileType)) {
            echo "<script type='text/javascript'>alert('Súbor sa nahral.');</script>";
        } else {
            echo "<script type='text/javascript'>alert('Nastala chyba pri nahrávaní súboru.');</script>";
        }
    }
?>
