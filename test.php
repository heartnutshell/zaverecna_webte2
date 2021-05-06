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
        <!-- JS -->
        <script src="lib/fabric.min.js"></script>
        <script src="lib/jscolor.min.js"></script>
    </head>

    <body>

        <header>
            <h1>test</h1>
        </header>

        <div>
            <input value="#000000" id="colorPicker" data-jscolor="{closeButton:true, closeText:'Close'}">
            <input type="range" min="1" max="100" value="1" id="sizeSlider">
            <button onclick="clearCanvas()" id="clear">Clear</button>
            <button onclick="saveDrawing()" id="save">Save</button>
            <button onclick="loadDrawing()" id="save">Load last Save</button>
            <canvas id="drawHere"></canvas>
        </div>
        
        <footer>           
            <span>© 2021 HNS</span>
        </footer>

        <script src="js/draw.js"></script>  

    </body>
</html>
