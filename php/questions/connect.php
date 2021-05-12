<?php
require_once __DIR__ . "/../database/DatabaseController.php";

$databaseController = new DatabaseController();

$question_id = 5;
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
            <div class="row">
                <?php
                $answers = $databaseController->getAnswersByQuestionId(5);

                $left_answers = array();
                $right_answers = array();

                foreach ($answers as $answer){
                    if (is_numeric($answer["answer_key"])){
                        array_push($right_answers, $answer);
                    }else{
                        array_push($left_answers, $answer);
                    }
                }

                usort($left_answers, function ($item1, $item2){
                   return ord($item1["answer_key"]) >  ord($item2["answer_key"]);
                });

                usort($right_answers, function ($item1, $item2){
                    return ord($item1["answer_key"]) >  ord($item2["answer_key"]);
                });

                echo '<div class="card-body col-6">';
                foreach ($left_answers as $answer){
                    echo $answer["answer_key"].") ".$answer["answer"]."<br>";
                }
                echo '</div>';
                echo '<div class="card-body col-6">';
                foreach ($left_answers as $answer){
                    echo '<select class="output" id="'.$question_id.'">';
                    foreach ($right_answers as $option) {
                        echo '
                        <option class="output" id="' . $option["answer_key"] . '">' . $option["answer"] . '</option>
                    ';
                    }
                    echo '</select><br>';

                }
                echo '</div>';
                ?>
            </div>
        </div>
    </div>
</div>

</body>
</html>
