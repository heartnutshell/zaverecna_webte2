<?php

require_once __DIR__ . "/../database/DatabaseController.php";

$db = new DatabaseController();
/**
 * Students Page Visibility
 *  */
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

/**
 * Teacher Notifications
 */
if ($_REQUEST["type"] == "teacher-test") {

    switch ($_REQUEST["action"]) {
        case "get-notifications":
            echo json_encode($db->getStudentsVisibility($_POST["test_key"], $_POST["last_id"]));
            break;
        case "get-students":
            $students = $db->getStudentsByTestKey($_POST["test_key"], $_POST["last_id"]);
            $test = $db->getTestByKey($_POST["test_key"]);
            $result = ["students" => $students, "test" => $test];
            echo json_encode($result);
            break;
        default:
            break;
    }
}
/**
 * Test Related 
 */
if ($_REQUEST["type"] == "tests") {

    switch ($_REQUEST["action"]) {
        case "get-test-keys":
            echo json_encode($db->getTestKeys());
            break;

        case "toggle-test-status":
            ["test_key" => $test_key, "status" => $status] = $_POST;
            echo $test_key;
            echo $status;
            $db->updateTestActiveStatus($test_key, $status);
            break;
        case "manual-evaluate":
            ["test_key" => $test_key, "student_id" => $student_id, "data" => $data] = $_POST;

            foreach($data as $questionData) {
                $db->updateStudentAnswer($student_id, $test_key, $questionData["name"], $questionData["value"]);
            }

            break;
        default:
            break;
    }
}