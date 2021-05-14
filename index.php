<?php
include_once "php/database/DatabaseController.php";


$ctrl = new DatabaseController();
var_dump($ctrl->getCsv());

