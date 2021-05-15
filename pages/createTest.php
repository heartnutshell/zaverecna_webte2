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
            <p id="createOpenQ" class="btn btn-primary" data-type-question="open">Krátka odpoveď</p>
            <p id="createChooseQ" class="btn btn-primary data-type-question="choose">Výber správnej
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
                    autocomplete="off" required>
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
                <input type="text" class="form-control" id="max_points" name="max_points" placeholder="Počet bodov"
                    readonly required>
            </div>

            <div id="form-questions">

            </div>

            <button class="btn btn-lg btn-primary">Vytvoriť</button>

        </form>

    </main>

    <script src="../js/api/teacher.js"></script>
    <script src="../js/question.js"></script>
    <script>
    let countQ = 1;
    let test_key = "";

    const countPoints = () => {
        let total = 0;

        document.querySelectorAll("[data-group=points]").forEach((item) => {
            if (item.value != "") {
                total += parseInt(item.value);
            }
        })

        $("#max_points").val(total);

    }

    const toggleCreateQuestionButtons = (mode) => {
        const btns = document.querySelectorAll("#createQuestionbuttons p");

        btns.forEach(btn => {
            if (mode === "enable") {

                btn.classList.remove("disabled");
            } else if (mode === "disable") {

                btn.classList.add("disabled");
            }
        })
    }

    const findParentAndAddProperty = (data, key, type, child) => {
        for (const [index, item] of Object.entries(data)) {
            if (data[index].name == key) {
                switch (type) {
                    case "child":
                        // Check if object has propery Child, otherwise Create 
                        if (!data[index].hasOwnProperty("child")) {
                            data[index]["child"] = [];
                        }
                        data[index]["child"].push(child);
                        break;
                    case "points":
                        data[index]["points"] = child;
                        break;
                }
            }
        }
    }

    const submitHandle = (event) => {
        event.preventDefault();

        const form = $("#create-test");
        const inputs = document.querySelector("#create-test").elements;
        let data = form.serializeArray();

        if (inputs.max_points.value == "" || inputs.max_points.value == 0) {
            alert("Test je prázdny!");
            return;
        }

        // loop through FORM DATA
        for (const [index, item] of Object.entries(data)) {

            const dataSet = $(`#${item.name}`).data();

            // FORM INPUT has data set
            if (dataSet != undefined) {
                if (Object.keys(dataSet).length != 0) {

                    // If it's child add to parent and delete from data
                    if (dataSet["parent"]) {
                        // Add point property to question parennt
                        if ((dataSet["group"] == "points")) {
                            findParentAndAddProperty(data, dataSet["parent"], "points", item.value);
                            delete data[index];
                            continue;
                        }

                        const child = {
                            name: item.name,
                            value: item.value,
                            pairIndex: dataSet?.pair,
                            selectCorrect: dataSet?.correct
                        }

                        findParentAndAddProperty(data, dataSet["parent"], "child", child);
                        delete data[index];
                        continue;
                    }

                    // Insert Data Properties to Item ( Form Data )
                    for (const [key, value] of Object.entries(dataSet)) {
                        data[index][key] = value;
                    }
                }
            }
        }
        data = data.flat();

        // submitCreateTest(data);
    }

    const calculatePointsListener = () => {
        // Add Listener to data-group=points
        document.querySelectorAll("[data-group=points]").forEach((pointsField) => {
            pointsField.addEventListener("input", () => countPoints())
        });
    }

    $(document).ready(() => {

        toggleCreateQuestionButtons("disable")

        // Validate TEST KEY
        $("#test_key").on("input", (event) => {

            if (event.target.value.length < 3) {
                toggleCreateQuestionButtons("disable")
                $("#test_key--invalid").text("Kód musí obsahovať aspoň 3 znaky.");
                event.target.classList.add("is-invalid");
                event.target.classList.remove("is-valid");
            } else {
                $("#test_key_hidden").val($("#test_key").val());
                getTestKeys(event);
            }
        })



        // Creating Questions
        $("#createQuestionbuttons p").each((index, btnElement) => {

            btnElement.addEventListener("click", (event) => {

                $("#test_key").attr("disabled", "disabled");

                const test_key = localStorage.getItem("test_key");
                const typeQ = btnElement.dataset.typeQuestion;
                const form = $("#form-questions");
                let question;

                switch (typeQ) {
                    case "open":
                        question = createQuestion("open", test_key, countQ);
                        break;
                    case "choose":
                        question = createQuestion("choose", test_key, countQ);
                        break;
                    case "connect":
                        question = createQuestion("connect", test_key, countQ);
                        break;
                    case "math":
                        question = createQuestion("math", test_key, countQ);
                        break;
                    case "draw":
                        question = createQuestion("draw", test_key, countQ);
                        break;
                    default:
                        console.log("Not defined Type");
                        break;
                }

                form.append(question);
                countQ++;
                calculatePointsListener();
            })
        })

    })
    </script>

    <?php include '../footer.php';?>

</body>

</html>