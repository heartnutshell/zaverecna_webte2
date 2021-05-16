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

$csv = "id,meno,priezvisko,body\r\n";

foreach ($databaseController->getStudentTestsByTestKey($test_key) as $test){
    $student = $databaseController->getStudentByID($test["student_id"])[0];
    $csv .= $student["id"] . "," . $student["name"] . "," . $student["surname"] . "," . $test["points"]. "\r\n";
}

$myfile = fopen("csv/vysledky".$test_key.".csv", "w");
fwrite($myfile, $csv);
?>
<!DOCTYPE html>
<html lang="sk">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSV</title>
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
<?php echo '<div class="containter m-2"><a class="btn btn-success" href="csv/vysledky'.$test_key.'.csv" download>Uložiť</a></div>';
echo nl2br($csv);
?>
</body>



</html>