<?php


require_once __DIR__ . "/../php/database/DatabaseController.php";
require_once __DIR__ . "/../php/questions/CreateQuestion.php";

$createQ = new CreateQuestion();
$service = new DatabaseController();

require_once __DIR__."/partials/header.php";