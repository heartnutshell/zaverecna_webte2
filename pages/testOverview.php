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
$partial->createHeader("Učiteľ | Test: {$_GET["test_key"]}");

?>

<main class="container page-content">

    <section>
        <h4 class="part">Informácie o teste</h4>
        <div class="table-responsive">
        <table class="table">
            <tr>
                <th>Kód testu</th>
                <td><?= $test[0]["test_key"]; ?></td>
            </tr>
            <tr>
                <th>Časový limit</th>
                <td><?= $test[0]["time_limit"]; ?></td>
            </tr>
            <tr>
                <th>Počet bodov</th>
                <td><?= $test[0]["max_points"]; ?></td>
            </tr>
            <tr>
                <th>Stav</th>
                <td><?= $test[0]["active"] ? "<span class='test active'>Zapnutý</span>" : "<span class='test not-active'>Vypnutý</span>"; ?>
                </td>
            </tr>
            <tr>
                <th>Zapnúť/vypnúť test:</th>
                <td id="test_status"
                    onclick="toggleTestStatus(event, <?= $test[0]['active'] ?> , '<?= $_GET['test_key'] ?>' )">
                    <button class="btn btn-warning">
                        <?= $test[0]["active"] ? "Vypnúť" : "Zapnúť"; ?>
                    </button>
                </td>
            </tr>
            <tr>
                <th>Export:</th>
                <td>
                    <a class="btn btn-primary" href="../student_answes.php?test_key=<?php echo $_GET['test_key'];?>">PDF</a>
                    <?php 
                        $db->getCsv($_GET['test_key']);
                    ?>
                    <a class="btn btn-primary" href="csv/vysledky.csv">CSV</a>
                </td>
            </tr>

        </table>
        </div>
    </section>

    <section>

        <h4 class="part">Študenti</h4>
        <div class="table-responsive">
        <table class="table table-hover">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Meno</th>
                    <th>Priezvisko</th>
                    <th>Stav</th>
                    <? if ($test[0]["active"] == 0) : ?>
                    <th>Vyhodnotiť</th>
                    <? endif; ?>
                </tr>
            </thead>

            <tbody id="students--body">
            </tbody>

        </table>
        </div>

    </section>

    <section id="notifications">

        <h4 class="part">Upozornenia</h4>
        <div class="table-responsive">
        <table class="table table-hover">

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
        </div>

    </section>

</main>
<?php include '../footer.php'; ?>

<script src="../js/api/teacher.js"></script>
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
</body>

</html>