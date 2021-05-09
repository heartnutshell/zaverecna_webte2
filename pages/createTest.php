<?php

require_once __DIR__ . "/partials/Partial.php";
require_once __DIR__ . "/../php/database/DatabaseController.php";
require_once __DIR__ . "/../php/questions/CreateQuestion.php";

$partial = new Partial();

// Check if user is logged, otherwise redirect to Login page
$partial->authenticate();

$createQ = new CreateQuestion();
$db = new DatabaseController();

$partial->createHeader("Teacher | Create Test");
?>

<main>
    <h1>Test</h1>

    <button id="" class="btn btn-outline-primary">Krátka odpoveď</button>
    <button id="" class="btn btn-outline-primary">Výber správnej odpovede</button>
    <button id="" class="btn btn-outline-primary">Párovacia otázka</button>
    <button id="" class="btn btn-outline-primary">Kresliacia otázky</button>
    <button id="" class="btn btn-outline-primary">Napísanie matematického výrazu</button>



</main>