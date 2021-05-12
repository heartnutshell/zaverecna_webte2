<?php
require_once __DIR__ . "/../database/DatabaseController.php";

$databaseController = new DatabaseController();

$question_id = 7;
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
                $answers = $databaseController->getAnswersByQuestionId($question_id);
                foreach ($answers as $answer){
                    echo $answer["answer"].'<input type="checkbox" class="output" id="'.$question_id.'"><br>';
                }
                ?>
            </div>
        </div>
    </div>
</div>

</body>
</html>
