<?php

require_once __DIR__ . "/partials/Partial.php";
require_once __DIR__ . "/../php/database/DatabaseController.php";

$partial = new Partial();

// Check if user is logged, otherwise redirect to Login page
$partial->authenticate();

$db = new DatabaseController();
$partial->createHeader('Učitel | Vytváranie testu');
?>

<main class="container page-content">

    <div class="alert alert-dismissible alert-warning">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Začnite zadaním kódu pre test!</strong>
    </div>

    <div id="createQuestionbuttons" class="third-center">
        <h3 class="typ_otazky">Vyberte otázku, ktorú chcete pridať:</h3>
        <p id="createOpenQ" class="btn btn-primary" data-type-question="open">Krátka odpoveď</p>
        <p id="createChooseQ" class="btn btn-primary" data-type-question="choose">Výber správnej
            odpovede</p>
        <p id="createConnectQ" class="btn btn-primary" data-type-question="connect">Párovacia
            otázka</p>
        <p id="createDrawQ" class="btn btn-primary" data-type-question="draw">Kresliacia
            otázka</p>
        <p id="createMathQ" class="btn btn-primary" data-type-question="math">Písanie matematického
            výrazu</p>
    </div>

    <form id="create-test" class="row g-3 test-form" onsubmit="submitHandle(event)">

        <div class="col-md-4">
            <label for="test_key" class="form-label">Kód testu</label>
            <input type="text" class="form-control" id="test_key" name="test_key" placeholde="Kód testu"
                autocomplete="off" minlength="3" required>
            <div class="valid-feedback">Kód testu je voľný</div>
            <div id="test_key--invalid" class="invalid-feedback"></div>
            <input type="hidden" id="test_key_hidden" name="test_key_hidden">
        </div>
        <div class="col-md-4">
            <label for="time_limit" class="form-label">Čas trvania</label>
            <input type="number" class="form-control" id="time_limit" name="time_limit" min="1"
                placeholder="Čas trvania [min]" required>
        </div>
        <div class="col-md-4">
            <label for="max_points" class="form-label">Počet bodov</label>
            <input type="text" class="form-control" id="max_points" name="max_points" placeholder="Počet bodov" readonly
                required>
        </div>

        <div id="form-questions">

        </div>

        <button class="btn btn-lg btn-primary">Vytvoriť</button>

    </form>

</main>

<script src="../js/api/teacher.js"></script>
<script src="../js/question.js"></script>
<script src="../js/createTest.js"></script>

<?php include '../footer.php'; ?>

</body>

</html>