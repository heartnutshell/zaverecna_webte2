<?php
date_default_timezone_set("Europe/Bratislava");

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

$start_time = $ctrl->getStudentTestsTimestamp($_GET['test_key'], $_GET['student_id']);

if($start_time) {
    $current = $ctrl->getStudentTest($_GET['test_key'], $_GET['student_id']);
    if ($current[0]['completed']) {
        header("Location: oops.php?error=testAlreadyCompleted");
        exit();
    }
    if(strtotime($start_time[0][0])+intval($time_limit) < time()){
       header("Location: oops.php?error=outOfTime&test_key={$_GET['test_key']}&student_id={$_GET['student_id']}");
       exit();
    }
} else {
    $ctrl->insertStudentTestsTimestamp($_GET['test_key'], $_GET['student_id'], date('Y-m-d H:i:s'));
}

?>
<!DOCTYPE html>
<html lang="sk">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
    <link rel="icon" type="image/png" href="img/favicon.png" />
    <!-- CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="lib/fabric.min.js"></script>
    <script src="lib/jscolor.min.js"></script>
    <script src="https://unpkg.com/mathlive/dist/mathlive.js"></script>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <header>
                <span class="title">TEST</span>
            </header>

        </div>
    </nav>

    <div class="container page-content">


        <?php
            echo "<p id='time_left'></p>";
            echo "<form method='post' action='evaluate.php' class='test-form' enctype='multipart/form-data'>";
            echo "<input type='hidden' id='test_key' name='test_key' value='{$_GET['test_key']}'>";
            echo "<input type='hidden' id='student_id' name='student_id' value='{$_GET['student_id']}'>";

        $ids = "";
        foreach($questions as $index => $question){
            $ids = $ids.$question['id'].";";
            $i = $index+1;
            echo "<h4>$i. {$question['question']}</h4>";
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

    </div>

    <?php include 'footer.php'; ?>

    <script src="js/draw.js"></script>
    <script src="js/math.js"></script>
    <script src="js/resize.js"></script>
    <script src="js/countdown.js"></script>
    <script src="js/api/pageVisibility.js"></script>

</body>
</html>