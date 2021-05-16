const typeArr = {
    open: "Otvorená",
    choose: "Výber",
    connect: "Párovacia",
    draw: "Kresliacia",
    math: "Matematická",
};

let pairIndex, selectIndex;

const removeElementById = (id) => {
    $(`#${id}`).remove();
    countPoints();
};

const createQuestion = (type, number) => {
    // Znenie otazky
    let questionInput = `
    <div class="card" id="Question${number}">
        <div class="card-header">
            <span class="title-black">${typeArr[type]}</span>
            <span class="btn btn-danger btn-sm ix" onclick="removeElementById('Question${number}')"><i class="bi bi-x-lg"></i></span>
        </div>
        <div class="card-body">
            <div>
                <label for="Q${number}">Otázka</label>
                <input class="form-control m-1" type="text" id="Q${number}" name="Q${number}" data-type="${type}" required>
            </div>
    `;

    // Pocet bodov za otazku
    let pointInput = `
            <div>
                <label for="P${number}">Počet bodov</label>
                <input class="form-control m-1" type="number" id="P${number}" name="P${number}" data-parent="Q${number}" data-group="points" required>
            </div>
        </div>
    </div>
    `;

    let questionBody;

    switch (type) {
        case "open":
            questionBody = createOpenQuestionBody(number);
            break;
        case "choose":
            selectIndex = 1;
            questionBody = createChooseQuestionBody(number);
            break;
        case "connect":
            pairIndex = 1;
            questionBody = createConnectQuestionBody(number);
            break;
        case "draw":
        case "math":
            questionBody = "";
            break;
        default:
            break;
    }

    return questionInput + questionBody + pointInput;
};

/**
 * Open Question
 */

const createOpenQuestionBody = (number) => {
    return `
    <div>
        <label for="OpenA${number}">Odpoveď</label>
        <input class="form-control m-1" type="text" id="OpenA${number}" name="OpenA${number}" data-parent="Q${number}" >
    </div>
    `;
};

/**
 * Choose Question
 */

const selectCheckboxHandle = (event, id) => {
    const checked = event.target.checked;

    $(`#${id}`).attr("data-correct", checked);
};

const addSelectToChooseQuestion = (bodyId, number) => {
    ++selectIndex;
    const row = `
        <div id="selectQ${number}-${selectIndex}" class="row">
            <div class="col-md-1">
                <input id="checkboxQ${number}-${selectIndex}" type="checkbox" class="form-check-input checkboi" onclick="selectCheckboxHandle(event,'selectQ${number}A${selectIndex}')" >
            </div>
             <div class="col-md-10">
                <input class="form-control m-1" type="text" id="selectQ${number}A${selectIndex}" name="selectQ${number}A${selectIndex}" data-parent="Q${number}" data-correct="false" required>          
            </div>
            <div class="col-md-1">
                <span onclick="removeElementById('selectQ${number}-${selectIndex}')" class="btn btn-danger btn-sm"><i class="bi bi-dash-lg"></i></span>
            </div>
        </div>
    `;

    $(`#${bodyId}`).append(row);
};

const createChooseQuestionBody = (number) => {
    return `
    <div id="chooseQ${number}" >
        <span>Odpovede, ktoré sú správne, označte.</span>
        <div id="selectQ${number}-${selectIndex}" class="row">
            <div class="col-md-1">
                <input id="checkboxQ${number}-${selectIndex}" type="checkbox" class="form-check-input checkboi" onclick="selectCheckboxHandle(event,'selectQ${number}A${selectIndex}')" >
            </div>
            <div class="col-md-10">
                <input required class="form-control m-1" type="text" id="selectQ${number}A${selectIndex}" name="selectQ${number}A${selectIndex}" data-parent="Q${number}" data-correct="false" required>          
            </div>
        </div>
    </div>
    <span class="btn btn-success d-flex justify-content-center" onclick="addSelectToChooseQuestion('chooseQ${number}', '${number}')"><i class="bi bi-plus-lg"></i></span>
    `;
};

/**
 * Pair Question
 */

const addPairToConnectQuestion = (id, number) => {
    ++pairIndex;
    // const row = document.createElement("div");
    const row = `
    <div id="pairQ${number}-${pairIndex}" class="row">
        <div class="col-md-6">
            <input class="form-control m-1" type="text" id="CQ${number}-${pairIndex}" name="CQ${number}-${pairIndex}" data-parent="Q${number}" data-pair="${pairIndex}">
        </div>
        <div class="col-md-5">
            <input class="form-control m-1" type="text" id="CA${number}-${pairIndex}" name="CA${number}-${pairIndex}" data-parent="Q${number}" data-pair="${pairIndex}">
        </div>
        <div class="col-md-1">
            <span onclick="removeElementById('pairQ${number}-${pairIndex}')" class="btn btn-danger btn-sm"><i class="bi bi-dash-lg"></i></span>
        </div>
    </div>
    `;

    // Append row
    $(`#${id}`).append(row);
};

const createConnectQuestionBody = (number) => {
    return `
    <div id="connectQ${number}">
        <div id="pairQ${number}-${pairIndex}" class="row">
            <div class="col-md-6">
                <input required class="form-control m-1" type="text" id="CQ${number}-${pairIndex}" name="CQ${number}-${pairIndex}" data-parent="Q${number}" data-pair="${pairIndex}">
            </div>
            <div class="col-md-5">
                <input required class="form-control m-1" type="text" id="CA${number}-${pairIndex}" name="CA${number}-${pairIndex}" data-parent="Q${number}" data-pair="${pairIndex}" >
            </div>
            <div class="col-md-1">
                <span onclick="removeElementById('pairQ${number}-${pairIndex}')" class="btn btn-danger btn-sm ix"><i class="bi bi-x-lg"></i></span>
            </div>
        </div>

    </div>
    <span class="btn btn-success d-flex justify-content-center" onclick="addPairToConnectQuestion('connectQ${number}', '${number}')"><i class="bi bi-plus-lg"></i></span>
    `;
};
