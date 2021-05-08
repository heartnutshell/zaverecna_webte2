<?php

require_once __DIR__ . "/../php/database/DatabaseController.php";
require_once __DIR__ . "/../php/questions/CreateQuestion.php";
require_once __DIR__ . "/partials/Partial.php";

$createQ = new CreateQuestion();
$service = new DatabaseController();
$partial = new Partial();

$partial->createHeader("Teacher | Create Test");
?>

<main>
    <h1>Test</h1>
</main>