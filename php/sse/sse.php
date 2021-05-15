<?php
date_default_timezone_set("Europe/Bratislava");
header('Cache-control: no-cache');
header('Content-type: text/event-stream');

include_once "../database/DatabaseController.php";

$ctrl = new DatabaseController();
$finish_time = "";
if(isset($_GET['test_key']) && isset($_GET['student_id'])) {
    $start_time = $ctrl->getStudentTestsTimestamp($_GET['test_key'], $_GET['student_id']);
    $test = $ctrl->getTestByKey($_GET['test_key']);
    $time_limit = $test[0]['time_limit'];
    $finish_time = strtotime($start_time[0][0]) + $time_limit*60;
}

function sendAll($msg)
{
    echo "event: evt\n";
    echo "data: $msg\n\n";

    ob_flush();
    flush();
}

do {
    $msg = $finish_time - time();
    sendAll($msg);
    sleep(1);
} while (true);