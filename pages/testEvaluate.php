<?php

require_once __DIR__ . "/partials/Partial.php";
require_once __DIR__ . "/../php/database/DatabaseController.php";
require_once __DIR__ . "/../php/questions/EvaluateAnswers.php";

$partial = new Partial();

// Check if user is logged, otherwise redirect to Login page
$partial->authenticate();

if (!isset($_GET["test_key"]) || !isset($_GET["student_id"])) {
    header("Location: /pages/teacher.php");
}

$db = new DatabaseController();

$studentAnswers = $db->getStudentAnswersByTestKeyAndStudentId($_GET["test_key"], $_GET["student_id"]);
$student = $db->getStudentByID($_GET["student_id"]);

$partial->createHeader("Učiteľ | Vyhodnocovanie testu");

?>
<main class="container page-content">
    <button class="btn btn-primary mb-2" onclick="window.history.go(-1);">späť</i></button>

    <h2 class="mb-3">
        Meno študenta:
        <?php echo "<span class='text-primary'>{$student[0]['name']} {$student[0]['surname']}</span>";  ?>
    </h2>

    <form id="manual-evaluate" onsubmit="manualEvaluate(event)">

        <?php
        $index = 1;

        foreach ($studentAnswers as $answer) {

            echo "<h4>$index {$answer["question"]}</h4>";

            switch ($answer["type"]) {
                case "open":
                    openEvaluation($answer);
                    break;
                case "choose":
                    chooseEvaluation($answer);
                    break;
                case "connect":
                    connectEvaluation($answer);
                    break;
                case "math":
                    mathEvaluation($answer);
                    break;
                case "draw":
                    drawEvaluation($answer);
                    break;
            }
            $index++;
        }

        ?>

        <button class="btn btn-success">Uložiť</button>

    </form>

</main>

<script src="../js/api/teacher.js"></script>
<script>
const manualEvaluate = (event) => {
    event.preventDefault();

    const urlParams = new URLSearchParams(window.location.search);

    const formData = $("#manual-evaluate").serializeArray();

    const test_key = urlParams.get('test_key');
    const student_id = urlParams.get('student_id');

    console.log(formData);

    manualEvaluateApi(formData, test_key, student_id);
}

MathJax.Hub.Config({
    tex2jax: {
        inlineMath: [
            ['$', '$'],
            ['\(', '\)']
        ]
    }
});
</script>

<?php include '../footer.php'; ?>

<script src="../js/draw.js"></script>
<script src="../js/math.js"></script>

</body>

</html>