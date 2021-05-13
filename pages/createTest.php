<?php

require_once __DIR__ . "/partials/Partial.php";
require_once __DIR__ . "/../php/database/DatabaseController.php";

$partial = new Partial();

// Check if user is logged, otherwise redirect to Login page
$partial->authenticate();

$db = new DatabaseController();

?>

<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <!-- Bootstrap -->
    <link href='../css/bootstrap.min.css' rel='stylesheet'>
    <!-- CSS -->
    <link href='../css/teacher.css' rel='stylesheet'>
    <link href='../css/style.css' rel='stylesheet'>
    <!-- JS -->
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js'
        integrity='sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8' crossorigin='anonymous'>
    </script>
    <script src='https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js'></script>
    <!-- Mathlive.js -->
    <script src="https://unpkg.com/mathlive/dist/mathlive.js"></script>
    <script src="../lib/fabric.min.js"></script>
    <script src="../lib/jscolor.min.js"></script>

    <title>Teacher | Vytvoriť test</title>
</head>

<body>
    <nav>
        <ul>
            <li><a href='teacher.php'>Home</a></li>
            <li><a href='createTest.php'>Vytvoriť test</a></li>
            <li><a href='student.php'>Student</a></li>
            <li><a href='logout.php'>Logout</a></li>
        </ul>
    </nav>

    <main class="container">
        <h1>Test</h1>

        <div id="createQuestionbuttons">
            <p id="createOpenQ" class="btn btn-outline-primary" data-type-question="open">Krátka odpoveď</p>
            <p id="createChooseQ" class="btn btn-outline-primary" data-type-question="choose">Výber správnej
                odpovede</p>
            <p id="createConnectQ" class="btn btn-outline-primary" data-type-question="connect">Párovacia
                otázka</p>
            <p id="createDrawQ" class="btn btn-outline-primary" data-type-question="draw">Kresliacia
                otázky</p>
            <p id="createMathQ" class="btn btn-outline-primary" data-type-question="math">Napísanie matematického
                výrazu</p>
        </div>

        <form id="create-test" class="row g-3" onsubmit="submitHandle(event)">

            <div class="col-md-4">
                <label for="test_key" class="form-label">Kód testu</label>
                <input type="text" class="form-control" id="test_key" name="test_key" placeholde="Kód testu"
                    autocomplete="off">
                <div class="valid-feedback">Kód testu je voľný</div>
                <div id="test_key--invalid" class="invalid-feedback"></div>
                <input type="hidden" id="test_key_hidden" name="test_key_hidden">
            </div>
            <div class="col-md-4">
                <label for="time_limit" class="form-label">Čas trvania</label>
                <input type="number" class="form-control" id="time_limit" name="time_limit" min="1"
                    placeholder="Čas trvania [min]">
            </div>
            <div class="col-md-4">
                <label for="max_points" class="form-label">Počet bodov</label>
                <input type="number" class="form-control" id="max_points" name="max_points" min="1"
                    placeholder="Počet bodov">
            </div>


            <div id="form-questions">

            </div>

            <button>Vytvoriť</button>

        </form>
        <!-- 
        <form id="create-test" class="row g-3" onsubmit="submitHandle(event)">

            <div class="col-md-4">
                <label for="test_key" class="form-label">Kód testu</label>
                <input type="text" class="form-control is-valid" id="test_key" name="test_key" placeholde="Kód testu"
                    autocomplete="off" disabled="disabled" value="AS2022">
                <div class="valid-feedback">Kód testu je voľný</div>
                <div id="test_key--invalid" class="invalid-feedback">Kód testu už existuje</div>
                <input type="hidden" id="test_key_hidden" name="test_key_hidden" value="AS2022">
            </div>
            <div class="col-md-4">
                <label for="time_limit" class="form-label">Čas trvania</label>
                <input type="number" class="form-control" id="time_limit" name="time_limit" min="1"
                    placeholder="Čas trvania [min]">
            </div>
            <div class="col-md-4">
                <label for="max_points" class="form-label">Počet bodov</label>
                <input type="number" class="form-control" id="max_points" name="max_points" min="1"
                    placeholder="Počet bodov">
            </div>


            <div id="form-questions">


                <div class="card" id="Question1">
                    <div class="card-header">
                        <span>Otvorená</span>
                        <span class="btn btn-danger" onclick="removeElementById('Question1')">×</span>
                    </div>
                    <div class="card-body">
                        <div>
                            <label for="Q1">Otázka</label>
                            <input class="form-control" type="text" id="Q1" name="Q1" data-type="open">
                        </div>

                        <div>
                            <label for="OpenA1">Odpoveď</label>
                            <input class="form-control" type="text" id="OpenA1" name="OpenA1" data-parent="Q1">
                        </div>

                        <div>
                            <label for="P1">Počet bodov</label>
                            <input class="form-control" type="text" id="P1" name="P1" data-parent="Q1"
                                data-group="points">
                        </div>
                    </div>
                </div>

                <div class="card" id="Question2">
                    <div class="card-header">
                        <span>Výber</span>
                        <span class="btn btn-danger" onclick="removeElementById('Question2')">×</span>
                    </div>
                    <div class="card-body">
                        <div>
                            <label for="Q2">Otázka</label>
                            <input class="form-control" type="text" id="Q2" name="Q2" data-type="choose">
                        </div>

                        <div id="chooseQ2">
                            <div>
                                <label for="CorrectA2">Správna odpoveď</label>
                                <input class="form-control" type="text" id="CorrectA2" name="CorrectA2"
                                    data-parent="Q2">
                            </div>
                            <div>
                                <label for="IncorrectA12">Nesprávna odpoveď</label>
                                <input class="form-control" type="text" id="IncorrectA12" name="IncorrectA12"
                                    data-parent="Q2">
                            </div>
                            <div>
                                <label for="IncorrectA22">Nesprávna odpoveď</label>
                                <input class="form-control" type="text" id="IncorrectA22" name="IncorrectA22"
                                    data-parent="Q2">
                            </div>
                            <div>
                                <label for="IncorrectA32">Nesprávna odpoveď</label>
                                <input class="form-control" type="text" id="IncorrectA32" name="IncorrectA32"
                                    data-parent="Q2">
                            </div>
                        </div>

                        <div>
                            <label for="P2">Počet bodov</label>
                            <input class="form-control" type="text" id="P2" name="P2" data-parent="Q2"
                                data-group="points">
                        </div>
                    </div>
                </div>

                <div class="card" id="Question3">
                    <div class="card-header">
                        <span>Párovacia</span>
                        <span class="btn btn-danger" onclick="removeElementById('Question3')">×</span>
                    </div>
                    <div class="card-body">
                        <div>
                            <label for="Q3">Otázka</label>
                            <input class="form-control" type="text" id="Q3" name="Q3" data-type="connect">
                        </div>

                        <div id="connectQ3">
                            <div id="pair-1" class="row">
                                <div class="col-md-5">
                                    <input class="form-control" type="text" id="CQ3-1" name="CQ3-1" data-parent="Q3"
                                        data-pair="1">
                                </div>
                                <div class="col-md-5">
                                    <input class="form-control" type="text" id="CA3-1" name="CA3-1" data-parent="Q3"
                                        data-pair="1">
                                </div>
                                <div class="col-md-1">
                                    <span onclick="removeElementById('pair-1')" class="btn btn-danger">×</span>
                                </div>
                            </div>


                            <div id="pair-2" class="row">
                                <div class="col-md-5">
                                    <input class="form-control" type="text" id="CQ3-2" name="CQ3-2" data-parent="Q3"
                                        data-pair="2">
                                </div>
                                <div class="col-md-5">
                                    <input class="form-control" type="text" id="CA3-2" name="CA3-2" data-parent="Q3"
                                        data-pair="2">
                                </div>
                                <div class="col-md-1">
                                    <span onclick="removeElementById('pair-2')" class="btn btn-danger">×</span>
                                </div>
                            </div>

                            <div id="pair-3" class="row">
                                <div class="col-md-5">
                                    <input class="form-control" type="text" id="CQ3-3" name="CQ3-3" data-parent="Q3"
                                        data-pair="3">
                                </div>
                                <div class="col-md-5">
                                    <input class="form-control" type="text" id="CA3-3" name="CA3-3" data-parent="Q3"
                                        data-pair="3">
                                </div>
                                <div class="col-md-1">
                                    <span onclick="removeElementById('pair-3')" class="btn btn-danger">×</span>
                                </div>
                            </div>

                            <div id="pair-4" class="row">
                                <div class="col-md-5">
                                    <input class="form-control" type="text" id="CQ3-4" name="CQ3-4" data-parent="Q3"
                                        data-pair="4">
                                </div>
                                <div class="col-md-5">
                                    <input class="form-control" type="text" id="CA3-4" name="CA3-4" data-parent="Q3"
                                        data-pair="4">
                                </div>
                                <div class="col-md-1">
                                    <span onclick="removeElementById('pair-4')" class="btn btn-danger">×</span>
                                </div>
                            </div>
                        </div>
                        <span class="btn btn-success" onclick="addPairToConnectQuestion('connectQ3', '', '3')">Add
                            row</span>

                        <div>
                            <label for="P3">Počet bodov</label>
                            <input class="form-control" type="text" id="P3" name="P3" data-parent="Q3"
                                data-group="points">
                        </div>
                    </div>
                </div>

                <div class="card" id="Question4">
                    <div class="card-header">
                        <span>Kresliacia</span>
                        <span class="btn btn-danger" onclick="removeElementById('Question4')">×</span>
                    </div>
                    <div class="card-body">
                        <div>
                            <label for="Q4">Otázka</label>
                            <input class="form-control" type="text" id="Q4" name="Q4" data-type="draw">
                        </div>

                        <div>
                            <label for="P4">Počet bodov</label>
                            <input class="form-control" type="text" id="P4" name="P4" data-parent="Q4"
                                data-group="points">
                        </div>
                    </div>
                </div>

                <div class="card" id="Question5">
                    <div class="card-header">
                        <span>Matematická</span>
                        <span class="btn btn-danger" onclick="removeElementById('Question5')">×</span>
                    </div>
                    <div class="card-body">
                        <div>
                            <label for="Q5">Otázka</label>
                            <input class="form-control" type="text" id="Q5" name="Q5" data-type="math">
                        </div>

                        <div>
                            <label for="P5">Počet bodov</label>
                            <input class="form-control" type="text" id="P5" name="P5" data-parent="Q5"
                                data-group="points">
                        </div>
                    </div>
                </div>
            </div>

            <button>Vytvoriť</button>

        </form> -->

    </main>

    <script src="../js/api/teacher.js"></script>
    <script src="../js/question.js"></script>
    <script>
    let countQ = 1;
    let test_key = "";

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

        let data = $("#create-test").serializeArray();
        console.log("form data");
        console.log($("#create-test").serializeArray());
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
                            pairIndex: dataSet?.pair
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
            // console.log(data[index]);
        }

        data = data.flat();
        console.log("After");
        console.log(data);
        submitCreateTest(data);

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

            })
        })

    })
    </script>

</body>

</html>