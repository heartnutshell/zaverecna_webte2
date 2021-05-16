let countQ = 1;
let test_key = "";

const countPoints = () => {
    let total = 0;

    document.querySelectorAll("[data-group=points]").forEach((item) => {
        if (item.value != "") {
            total += parseInt(item.value);
        }
    });

    $("#max_points").val(total);
};

const toggleCreateQuestionButtons = (mode) => {
    const btns = document.querySelectorAll("#createQuestionbuttons p");

    btns.forEach((btn) => {
        if (mode === "enable") {
            btn.classList.remove("disabled");
        } else if (mode === "disable") {
            btn.classList.add("disabled");
        }
    });
};

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
};

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
                    if (dataSet["group"] == "points") {
                        findParentAndAddProperty(data, dataSet["parent"], "points", item.value);
                        delete data[index];
                        continue;
                    }

                    const child = {
                        name: item.name,
                        value: item.value,
                        pairIndex: dataSet?.pair,
                        selectCorrect: dataSet?.correct,
                    };

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
    // Clear data from Empty Slots
    data = data.flat();

    submitCreateTest(data);
};

const calculatePointsListener = () => {
    // Add Listener to data-group=points
    document.querySelectorAll("[data-group=points]").forEach((pointsField) => {
        pointsField.addEventListener("input", () => countPoints());
    });
};

$(document).ready(() => {
    toggleCreateQuestionButtons("disable");

    // Validate TEST KEY
    $("#test_key").on("input", (event) => {
        if (event.target.value.length < 3) {
            toggleCreateQuestionButtons("disable");
            $("#test_key--invalid").text("Kód musí obsahovať aspoň 3 znaky.");
            event.target.classList.add("is-invalid");
            event.target.classList.remove("is-valid");
        } else {
            $("#test_key_hidden").val($("#test_key").val());
            getTestKeys(event);
        }
    });

    // Creating Questions
    $("#createQuestionbuttons p").each((index, btnElement) => {
        btnElement.addEventListener("click", (event) => {
            const test_key = localStorage.getItem("test_key");
            const typeQ = btnElement.dataset.typeQuestion;
            const form = $("#form-questions");
            let question;

            switch (typeQ) {
                case "open":
                    question = createQuestion("open", countQ);
                    break;
                case "choose":
                    question = createQuestion("choose", countQ);
                    break;
                case "connect":
                    question = createQuestion("connect", countQ);
                    break;
                case "math":
                    question = createQuestion("math", countQ);
                    break;
                case "draw":
                    question = createQuestion("draw", countQ);
                    break;
                default:
                    console.log("Not defined Type");
                    break;
            }

            form.append(question);
            countQ++;
            calculatePointsListener();
        });
    });
});
