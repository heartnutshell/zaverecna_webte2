<?php

    $question = "tu ide otazka?";

?>
<!DOCTYPE html>
<html lang="sk">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>test</title>
        <link rel="icon" type="image/png" href="img/favicon.png" />
        <!-- CSS --> 
        <link href="../../css/bootstrap.min.css" rel="stylesheet">
        <link href="../../css/style.css" rel="stylesheet">    
        <!-- JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
        <script src="../../lib/fabric.min.js"></script>
        <script src="../../lib/jscolor.min.js"></script>
    </head>

    <body>

        <div class="container">
            <div class="row-6">
                <?php echo'
                <div class="card mb-3">
                    <div class="card-header">
                        <span>'.$question.'</span>
                        <input value="#000000" id="jednacolor" data-jscolor="{closeButton:true, closeText:"Close"}">
                        <input type="range" min="1" max="100" value="1" step="1" id="jednasize" class="form-range slider-width100" oninput="this.nextElementSibling.value = this.value">
                        <output id="range-num">1</output>      
                    </div>
                    <div class="card-body">
                        <canvas id="jedna"></canvas>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-outline-primary" onclick="clearCanvas()" id="jednaclear">Clear</button>
                    </div>
                </div>
                ';?>
                <?php echo'
                <div class="card mb-3">
                    <div class="card-header">
                        <span>'.$question.'</span>
                        <input value="#000000" id="dvacolor" data-jscolor="{closeButton:true, closeText:"Close"}">
                        <input type="range" min="1" max="100" value="1" step="1" id="dvasize" class="form-range slider-width100" oninput="this.nextElementSibling.value = this.value">
                        <output id="range-num">1</output>      
                    </div>
                    <div class="card-body">
                        <canvas id="dva"></canvas>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-outline-primary" onclick="clearCanvas()" id="dvaclear">Clear</button>
                    </div>
                </div>
                ';?>
            </div>
        </div>

        <script src="../../js/api/studentAnswer.js"></script>
        <script src="../../js/draw.js"></script>       

    </body>
</html>
