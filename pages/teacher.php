<?php

require_once __DIR__ . "/../php/database/DatabaseController.php";
require_once __DIR__ . "/../php/questions/CreateQuestion.php";
require_once __DIR__ . "/partials/Partial.php";

$createQ = new CreateQuestion();
$controller = new DatabaseController();
$partial = new Partial();

// Creating Header
$partial->createHeader("Teacher | Home");

?>

<main>
    <h1>Techer home</h1>

</main>

<section>
    <h2>My Tests</h2>
    <?

    $controller->getAllTeacherTests($teacher_id);

    ?>
</section>