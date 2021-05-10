<?php

?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test</title>
    <link rel="icon" type="image/png" href="img/favicon.png">
    <!-- CSS -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <link href="../../css/style.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <div class="row-6">
        <div class="card mb-3">
            <div class="card-body">
                <?php
                $question_id = 1;
                for ($i = 0; $i<4; $i++){
                    echo chr($i+ord('a')).') option  '.($i+1).') <select class="output" id="'.$question_id.'"> ';
                    for ($j = 0; $j<4; $j++)
                        echo '
                            <option class="output" id="'.$j.'">'.$j.'</option>
                        ';
                    echo '</select><br>';
                }
                ?>
            </div>
        </div>
    </div>
</div>

</body>
</html>
