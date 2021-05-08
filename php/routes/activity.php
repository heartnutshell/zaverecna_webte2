<?

require_once __DIR__ . "/../database/DatabaseController.php";

$db = new DatabaseController();

switch ($_REQUEST["action"]) {
    case "left-tab":
        // TODO : Create insert method
        $db->insertStudentVisibility($_POST["test_key"], $_POST["student_id"], $_POST["action"]);
        break;
    case "enter-tab":
        $db->insertStudentVisibility($_POST["test_key"], $_POST["student_id"], $_POST["action"]);
        break;
    default:
        break;
}