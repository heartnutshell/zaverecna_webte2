<?php

require_once __DIR__ . "/partials/Partial.php";
require_once __DIR__ . "/../php/database/DatabaseController.php";

$partial = new Partial();

// Check if user is logged, otherwise redirect to Login page
$partial->authenticate();

// User is Authenticated -> Key is not defined -> Return to Teacher home page
if (!isset($_GET["test_key"])) {
    header("Location: teacher.php");
}

$db = new DatabaseController();

// Get Test by GET[test_key]
$test = $db->getTestByKey($_GET["test_key"]);


// Invalid key -> No Test Found -> 404
if (count($test) == 0) {
    header("Location: 404.php");
}

// Test belongs to other Teacher
if ($_SESSION["teacher_id"] != $test[0]["teacher_id"]) {
    // header("Location: teacher.php");
    die($partial->notAuthorized("Test patrí inému učiteľovi", "teacher"));
}

// Get Students
$students = $db->getStudentsByTestKey($_GET["test_key"], 0);

// Creating Header
$partial->createHeader("Teacher | Test: {$_GET["test_key"]}");

?>

<main>

    <section>

        <h4>študenti</h4>
        <table>

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Meno</th>
                    <th>Priezvisko</th>
                    <th>Stav</th>
                </tr>
            </thead>

            <tbody id="students--body">
            </tbody>

        </table>

    </section>

    <section id="notifications">

        <h4>Upozornenia</h4>
        <table>

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Meno</th>
                    <th>Priezvisko</th>
                    <th>Akcia</th>
                    <th>Čas</th>
                </tr>
            </thead>

            <tbody id="notifications--body">
            </tbody>

        </table>

    </section>

</main>

<script src="../js/api/teacherTest.js"></script>
<script>
    $(document).ready(() => {

        const urlParams = new URLSearchParams(window.location.search);
        const test_key = urlParams.get("test_key");

        updateNotifications(test_key);
        updateStudentsData(test_key);

        setInterval(() => {
            updateNotifications(test_key);
            updateStudentsData(test_key);
        }, 3000);
    })
</script>