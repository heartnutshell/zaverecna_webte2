<?php

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

echo '<div class="containter m-2"><a class="btn btn-success" href="csv/vysledky'.$test_key.'.csv" download>Uložiť</a></div>';