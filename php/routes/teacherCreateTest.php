<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: https://wt100.fei.stuba.sk/zygarde/pages/teacher.php");
}

if (!isset($_POST["formData"])) {
    header("Location: https://wt100.fei.stuba.sk/zygarde/pages/teacher.php");
}

require_once __DIR__ . "/../../pages/partials/Partial.php";
require_once __DIR__ . "/../database/DatabaseController.php";
require_once __DIR__ . "/../questions/CreateQuestion.php";

$partial = new Partial();

// Check if user is logged, otherwise redirect to Login page
$partial->authenticate();

// Get Teacher ID from SESSION
$teacher_id = $_SESSION["teacher_id"];
$test_key = $_POST["formData"][1]["value"];
$time_limit = $_POST["formData"][2]["value"];
$max_points = $_POST["formData"][3]["value"];

// Create Services
$db = new DatabaseController();

// Create Test record in DB
$db->insertTest($test_key, $teacher_id, $time_limit, 1, $max_points);

$formData = $_POST["formData"];

// Init Creating Questions
$questionService = new CreateQuestion($test_key);

foreach ($formData as $data) {

    if (strpos($data["name"], "Q") !== false) {
        print_r($data);
        createQuestion($data, $questionService);
    }
}

function createQuestion($questionData, $questionService)
{

    ["value" => $question, "type" => $type, "points" => $points] = $questionData;

    switch ($type) {
        case "open":
            $questionService->createOpen($question, $questionData["child"], $points);
            break;
        case "choose":
            $questionService->createChoose($question, $questionData["child"], $points);
            break;
        case "connect":
            $questionService->createConnect($question, $questionData["child"], $points);
            break;
        case "draw":
            $questionService->createDraw($question, $points);
            break;
        case "math":
            $questionService->createMath($question, $points);
            break;
        default:
            echo "Question type not found $type";
    }
}