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

$partial->createHeader("Učiteľ | Vyhodnocovanie testu");

if (isset($_POST["evaluate-test"])) {
    echo "<pre>";
    print_r($_POST);
}

?>
<main class="container page-content">
    <button class="btn btn-primary" onclick="window.history.go(-1);">Spať</button>

    <form onsubmit="manualEvaluate()">

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

        <button class="btn btn-success" name="evaluate-test">Uložiť</button>

    </form>

</main>

<script>
MathJax.Hub.Config({
    tex2jax: {
        inlineMath: [
            ['$', '$'],
            ['\(', '\)']
        ]
    }
});


$(document).ready(() => {
    const manualEvaluate = () => {

    }
})
</script>

<?php include '../footer.php'; ?>

<script src="../js/draw.js"></script>
<script src="../js/math.js"></script>

</body>

</html>