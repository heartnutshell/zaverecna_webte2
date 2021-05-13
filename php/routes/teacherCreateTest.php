<?
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

// Create CreateQuestion Service
$qService = new CreateQuestion($_POST["test_key_hidden"]);

function createQuestion($questionData)
{
    ["value" => $question, "type" => $type, "points" => $points] = $questionData;

    switch ($type) {
        case "open":

            break;
        case "choose":
            break;
        case "connect":
            break;
        case "draw":
            break;
        case "math":
            break;
        default:
            echo "Question type not found $type";
    }
}


$formData = $_POST["formData"];

print_r($formData);

foreach ($formData as $data) {

    if (strpos($data["name"], "Q") !== false) {
        print_r($data);
        createQuestion($data);
    }
}