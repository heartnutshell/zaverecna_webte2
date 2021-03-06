<?php

    $question = "tu ide otazka?";

?>
<!DOCTYPE html>
<html lang="sk">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>test</title>
        <link rel="icon" type="image/png" href="img/favicon.png">
        <!-- CSS --> 
        <link href="../../css/bootstrap.min.css" rel="stylesheet">
        <link href="../../css/style.css" rel="stylesheet">
        <!-- JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
        <script src="https://unpkg.com/mathlive/dist/mathlive.js"></script>      
    </head>

    <body>

        <div class="container">
            <div class="row-6">
                <?php echo'
                <div class="card mb-3">
                    <div class="card-header">
                        <span><?php echo $question ?></span>
                    </div>
                    <div class="card-body">
                        <math-field id="mf-68" class="mathfield" smartMode="true" virtual-keyboard-mode="manual"></math-field>
                    </div>
                    <div class="card-footer">
                        <input type="hidden" id="68">
                        <button type="button" class="btn btn-outline-primary" id="save" onclick="saveMath()">Save</button>
                        <button type="button" class="btn btn-outline-primary" id="load" onclick="loadMath()">Load</button>
                    </div>
                </div>
                ';?>
                <?php echo'
                <div class="card mb-3">
                    <div class="card-header">
                        <span><?php echo $question ?></span>
                    </div>
                    <div class="card-body">
                        <math-field id="mf-69" class="mathfield" smartMode="true" virtual-keyboard-mode="manual"></math-field>
                    </div>
                    <div class="card-footer">
                        <input type="hidden" id="69">
                    </div>
                </div>
                ';?>
            </div>
        </div>

        <script src="../../js/api/studentAnswer.js"></script>
        <script src="../../js/math.js"></script>         

    </body>
</html>
