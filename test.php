<?php



?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>test</title>
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
            <div class="row-6">
                <div class="card mb-3">
                    <div class="card-header">
                        <input value="#000000" id="colorPicker" data-jscolor="{closeButton:true, closeText:'Close'}">
                        <input type="range" min="1" max="100" value="1" step="1" id="sizeSlider" class="form-range slider-width100" oninput="this.nextElementSibling.value = this.value">
                        <output id="range-num">1</output>      
                    </div>
                    <div class="card-body">
                        <canvas id="drawHere"></canvas>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-outline-primary" onclick="clearCanvas()" id="clear">Clear</button>
                        <button type="button" class="btn btn-outline-primary" onclick="saveDrawing()" id="save">Save</button>
                        <button type="button" class="btn btn-outline-primary" onclick="loadDrawing()" id="save">Load last Save</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="js/draw.js"></script>  

    </body>
</html>
