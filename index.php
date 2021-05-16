<?php



?>

<!DOCTYPE html>
<html lang="sk">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <?php
                if(isset($_GET['sent'])){
                    if($_GET['sent'] == 1){
                        echo'
                        <div class="alert alert-dismissible alert-success">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <span>Test bol úspečne odoslaný!</span>
                        </div>';
                    }
                }
            ?>
            <div class="other-center">
                    <a type="button" class="btn btn-primary btn-lg m-5" href="student.php">Vyplniť test</a>
                    <a type="button" class="btn btn-primary btn-lg m-5" href="login.php">Prihlásiť sa ako učiteľ</a>
            </div>
        </div>

        <?php include 'footer.php';?>

    </body>
</html>