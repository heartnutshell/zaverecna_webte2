<?php

require_once __DIR__ . "/../../php/session/Session.php";

        $session = new Session();
        $session->sessionStart(0, "/", "wt100.fei.stuba.sk", true, true);
        if (!isset($_SESSION["isLogged"])) {
            header("Location: index.php");
        }
        if ($_SESSION["isLogged"] != true) {
            header("Location: index.php");
        }
        
include_once "php/database/DatabaseController.php";
include_once "php/questions/QuestionType.php";

$databaseController = new DatabaseController();

$test_key = $_GET["test_key"];

?>
<!DOCTYPE html>
<html lang="sk">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF</title>
    <link rel="icon" type="image/png" href="img/favicon.png" />
    <!-- CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="lib/html2pdf.bundle.min.js"></script>
    <script src="https://unpkg.com/mathlive/dist/mathlive.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
</head>

<body>

    <div class="container m-2">
        <button class="btn btn-success" onclick="exportToPdf()">Uložiť</button>
    </div>

    <div id="export">
        <?php
        foreach ($databaseController->getQuestionsByTestKey($test_key) as $question) {
            echo "<div class='card'>";
            echo "<div class='card-header'>" . $question["question"] . " (" . $question["type"] . ")</div>";
            echo "<div class='card-body'>";
            foreach ($databaseController->getStudentAnswersByTestKeyAndQuestionId($test_key, $question["id"]) as $student_answer) {
                $student = $databaseController->getStudentByID($student_answer["student_id"]);
                echo "<div><u>" . $student[0]["id"] . " " . $student[0]["name"] . " " . $student[0]["surname"] . "</u><br>";
                if ($question["type"] == QuestionType::MATH) {
                    if (is_file('uploadedAnswers/' . json_decode($student_answer["answer"])->answer)) {
                        $answer = "<img src='uploadedAnswers/" . json_decode($student_answer["answer"])->answer . "'>";
                    } else {
                        $answer = "$$" . json_decode($student_answer["answer"])->answer . "$$";
                    }
                } else if ($question["type"] == QuestionType::DRAW) {
                    if (is_file('uploadedAnswers/' . json_decode($student_answer["answer"])->answer)) {
                        $answer = "<img src='uploadedAnswers/" . json_decode($student_answer["answer"])->answer . "'>";
                    } else {
                        $answer = json_decode($student_answer["answer"])->answer;
                    }
                } else if ($question["type"] == QuestionType::OPEN) {
                    $answer = json_decode($student_answer["answer"])->answer;
                } else if ($question["type"] == QuestionType::CONNECT) {
                    $current_answer = json_decode($student_answer["answer"], true);
                    $answer = "<br>";
                    foreach (array_keys($current_answer) as $key) {
                        $answer .= $key . " -> " . $current_answer[$key] . "<br>";
                    }
                } else if ($question["type"] == QuestionType::CHOOSE) {
                    $current_answer = json_decode($student_answer["answer"], true);
                    $answer = "<br>";
                    foreach (array_keys($current_answer) as $key) {
                        $answer .= $key . ": " . ($current_answer[$key] == "1" ? "1" : "x") . "<br>";
                    }
                } else {
                    $answer = $student_answer["answer"];
                }
                //if ($answer->answer)
                echo "<i>Odpoveď:</i> " . $answer . "</div>";
            }
            echo "</div>";
            echo "</div>";
        }
        ?>
    </div>

    <script src="js/exportToPdf.js"></script>

    <script>
    MathJax.Hub.Config({
        tex2jax: {
            inlineMath: [
                ['$', '$'],
                ['\(', '\)']
            ]
        }
    });
    </script>

</body>



</html>