<?php

include_once "php/database/DatabaseController.php";

$ctrl = new DatabaseController();




?>
<!DOCTYPE html>
<html lang="sk">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="refresh" content="5;URL='student.php'">
        <title>Vitaj v testovacom systéme!</title>
        <link rel="icon" type="image/png" href="img/favicon.png"/>
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

        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container center">
                <header>
                    <span class="title">Testovací systém</span>
                </header>
            </div>
        </nav>

        <div class="container page-content">
            <div class="other-center">
                <?php
                
                if(isset($_GET['error'])) {
                    switch ($_GET['error']) {
                        case "testAlreadyCompleted":
                        {
                            echo "Test bol ukončený a nie je možné ho vyplniť znova!";
                            break;
                        }
                        case "wrong_name":
                        {
                            echo "Zadané meno sa nezhoduje s menom študenta v databáze!";
                            break;
                        }
                        case "outOfTime":
                            {
                                if (isset($_GET['student_id']) && isset($_GET['test_key'])) {
                                    $ctrl->updateStudentTest($_GET['test_key'], $_GET['student_id'], date('Y-m-d H:i:s'), 0);
                                    echo "Vypršal čas pre vyplnenie testu!";
                                    break;
                                }
                            }
                        default:
                        {
                            break;
                        }
                    }
                }
                           
                ?>
            </div>
        </div>

    <?php include 'footer.php';?>

    </body>

</html>