<?php

require_once __DIR__ . "/../database/DatabaseController.php";

$db = new DatabaseController();

// Students Page Visibility
if ($_REQUEST["type"] == "page-visibility") {


    switch ($_REQUEST["action"]) {
        case "left-tab":
            $db->insertStudentVisibility($_POST["test_key"], $_POST["student_id"], $_POST["action"]);
            break;
        case "enter-tab":
            $db->insertStudentVisibility($_POST["test_key"], $_POST["student_id"], $_POST["action"]);
            break;
        default:
            break;
    }
}

// Teacher Notifications
if ($_REQUEST["type"] == "teacher-test") {

    switch ($_REQUEST["action"]) {
        case "get-notifications":
            echo json_encode($db->getStudentsVisibility($_POST["test_key"], $_POST["last_id"]));
            break;
        case "get-students":
            echo json_encode($db->getStudentsByTestKey($_POST["test_key"], $_POST["last_id"]));
            break;
        default:
            break;
    }
}

// Creating Tests
if ($_REQUEST["type"] == "tests") {

    switch ($_REQUEST["action"]) {
        case "get-test-keys":
            echo json_encode($db->getTestKeys());
            break;
        default:
            break;
    }
}
?>