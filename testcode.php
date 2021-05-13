<?php

require_once 'php/database/DatabaseController.php';

$db = new DatabaseController;

if(isset($_POST['testCode'])){

    $test_key = $_POST['testCode'];
    $result = $db->getTestByKey($test_key);

    if($result == NULL){
        $message = "Zlý kód testu. Test sa nenašiel.";
        echo "<script type='text/javascript'>alert('$message');</script>";
    } else {
        header('Location: student.php');
    }
}

?>

<!DOCTYPE html>
<html lang="sk">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Student</title>
        <link rel="icon" type="image/png" href="img/favicon.png" />
        <!-- CSS --> 
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">    
        <!-- JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
        <script src="lib/fabric.min.js"></script>
        <script src="lib/jscolor.min.js"></script>
    </head>
    <body>

        <div class="container">

            <legend>Zadaj kód testu.</legend>
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="form-row">  
                <div class="form-group col">            
                    <input
                        type="text"
                        class="form-control"
                        id="testCode"
                        name="testCode"
                        required
                    />
                </div>
                <div class="form-group col">
                    <input class="btn btn-primary" type="submit" value="Ďalej.">                        
                </div>               
            </form>

        </div>

    </body>
</html>