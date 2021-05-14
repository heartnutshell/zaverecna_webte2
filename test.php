<?php
include_once "php/questions/GenerateQuestion.php";

include_once "php/database/DatabaseController.php";

$ctrl = new DatabaseController();
$generator = new GenerateQuestion();

if (isset($_GET['test_key'])) {
    $test_key = $_GET['test_key'];
}

$student = $ctrl->getStudentByID($_GET['student_id']);
$test = $ctrl->getTestByKey($_GET['test_key']);
$questions = $ctrl->getQuestionsByTestKey($_GET['test_key']);

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
        echo "<form method='post' action='evaluate.php'>";
        echo "<input type='hidden' name='test_key' value='{$_GET['test_key']}'>";
        echo "<input type='hidden' name='student_id' value='{$_GET['student_id']}'>";
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
    echo "<input type='submit' class='btn btn-primary' value='Odoslať'>";
    echo "</form>";
    ?>



    <script src="js/draw.js"></script>
    <script src="js/api/studentAnswer.js"></script>
    <script src="js/math.js"></script>

    </body>
</html>
