<?php

require_once 'php/database/DatabaseController.php';

$db = new DatabaseController;

    if(isset($_POST['id'])){
        try {
                   
            $id = $_POST['id'];
            $test = $db->getTestByKey($_POST['test_key']);
            if($test == NULL){
                $message = "Zlý kód testu. Test sa nenašiel.";
                echo "<script type='text/javascript'>alert('$message');</script>";
            } else {
                $result = $db->getStudentByID($id);

                if ($result == NULL){
                    echo 'pridanie noveho studenta';
                    //treba pridat studenta
                    $name = $_POST['name'];
                    $surname = $_POST['surname'];
                    $db->insertStudent($id, $name, $surname);
                    //mozeme spustit test
                } else {
                    echo 'student uz je';
                    //student uz existuje netreba ho znovba pridat
                    //mozeme stupistit test
                }
                header("Location: test.php?test_key={$_POST['test_key']}&student_id={$_POST['id']}");
            }


        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
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

            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="form-row">  
                <div class="form-group col">
                    <label for='id'>ID</label>            
                    <input
                        type="text"
                        class="form-control"
                        id="id"
                        name="id"
                        required
                    />
                </div>               
                <div class="form-group col">
                <label for='Name'>Meno</label>                    
                    <input
                        type="text"
                        class="form-control"
                        id="name"
                        name="name"
                        placeholder=""
                        required
                    />
                </div>
                <div class="form-group col">
                    <label for='surname'>Priezvisko</label>          
                    <input
                        type="text"
                        class="form-control"
                        id="surname"
                        name="surname"
                        required
                    />
                </div>
                <div class="form-group col">
                    <label for='test_key'>Kód testu</label>
                    <input
                            type="text"
                            class="form-control"
                            id="test_key"
                            name="test_key"
                            required
                    />
                </div>
                <div class="form-group col">
                    <input class="btn btn-primary" type="submit" value="Spustiť test!">                        
                </div>               
            </form>

        </div>

    </body>
</html>