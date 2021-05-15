<?php
date_default_timezone_set("Europe/Bratislava");
include_once "php/questions/GenerateQuestion.php";

include_once "php/database/DatabaseController.php";

$ctrl = new DatabaseController();
$generator = new GenerateQuestion();

$student = $ctrl->getStudentByID($_GET['student_id']);
$test = $ctrl->getTestByKey($_GET['test_key']);

$time_limit = $test[0]['time_limit'];
$finish_time = "";

var_dump(intval($time_limit));

$start_time = $ctrl->getStudentTestsTimestamp($_GET['test_key'], $_GET['student_id']);
if($start_time) {
   var_dump(strtotime($start_time[0][0]));
   $finish_time = strtotime($start_time[0][0]) + intval($time_limit)*60;
} else {
    $ctrl->insertStudentTestsTimestamp($_GET['test_key'], $_GET['student_id'], date('Y-m-d H:i:s'));
    $start_time = $ctrl->getStudentTestsTimestamp($_GET['test_key'], $_GET['student_id']);
    $finish_time = strtotime($start_time[0][0]) + intval($time_limit)*60;
}
var_dump($finish_time);

$time_left = date("H:i:s",$finish_time - strtotime($start_time[0][0]) - 3600);



$currentTime = date('Y-m-d H:i:s');

$questions = $ctrl->getQuestionsByTestKey("OS2021");

?>
<html lang="sk">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registrácia</title>
        <link rel="icon" type="image/png" href="img/favicon.png" />
        <!-- CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <!-- JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
        <script src="lib/fabric.min.js"></script>
        <script src="lib/jscolor.min.js"></script>
        <script src="https://unpkg.com/mathlive/dist/mathlive.js"></script>
    </head>
    <body>
    <?php
        echo "<p id='time_left'></p>";
        echo "<form method='post' action='evaluate.php'>";
        echo "<input type='hidden' id='test_key' name='test_key' value='{$_GET['test_key']}'>";
        echo "<input type='hidden' id='student_id' name='student_id' value='{$_GET['student_id']}'>";
    $ids = "";
    foreach($questions as $question){
        $ids = $ids.$question['id'].";";
        echo "{$question['question']}";
        switch ($question['type']) {
            case "open":
            {
                $generator->generateText($question);
                break;
            }
            case "choose":
            {
                $generator->generateSelect($question);
                break;
            }
            case "connect":
            {
                $generator->generateConnect($question);
                break;
            }
            case "draw":
            {
                $generator->generateDraw($question['id']);
                break;
            }
            case "math":
            {
                $generator->generateEquation($question['id']);
                break;
            }
            default:
            {
                break;
            }
        }
    }
    echo "<input type='hidden' value={$ids} name='ids'>";
    echo "<input type='submit' id='submit_test' class='btn btn-primary' value='Odoslať'>";
    echo "</form>";
    ?>
    <script src="js/draw.js"></script>
    <script src="js/api/studentAnswer.js"></script>
    <script src="js/math.js"></script>
    <script src="js/countdown.js"></script>
    </body>
</html>
