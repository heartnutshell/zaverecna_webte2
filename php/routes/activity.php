<?

require_once __DIR__. "/../database/DatabaseController.php";

$db = new DatabaseController();

switch($_REQUEST["action"]) {
    case "left-tab": 
        // TODO : Create insert method
        echo "User left tab -> Insert into DB ";
        break;
    defualt: 
        break;

}
