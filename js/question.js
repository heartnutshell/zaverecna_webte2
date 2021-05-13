const typeArr = {
    open: "Otvorená",
    choose: "Výber",
    connect: "Párovacia",
    draw: "Kresliacia",
    math: "Matematická",
};

const removeElementById = (id) => {
    $(`#${id}`).remove();
};

const createQuestion = (type, key, number) => {
    // Znenie otazky
    let questionInput = `
    <div class="card" id="${key}-${number}">
        <div class="card-header">
            <span>${typeArr[type]}</span>
            <span class="btn btn-danger" onclick="removeElementById('${key}-${number}')">&times;</span>
        </div>
        <div class="card-body">
            <div>
                <label for="${key}Q${number}">Otázka</label>
                <input class="form-control" type="text" id="Q${number}" name="Q${number}" data-type="${type}">
            </div>
    `;

    // Pocet bodov za otazku
    let pointInput = `
            <div>
                <label for="${key}P${number}">Počet bodov</label>
                <input class="form-control" type="text" id="${key}P${number}" name="${key}P${number}" data-parent="Q${number}" data-group="point">
            </div>
        </div>
    </div>
    `;

    let questionBody;

    switch (type) {
        case "open":
            questionBody = createOpenQuestionBody(key, number);
            break;
        case "choose":
            questionBody = createChooseQuestionBody(key, number);
            break;
        case "connect":
            questionBody = createConnectQuestionBody(key, number);
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

const createOpenQuestionBody = (key, number) => {
    return `
    <div>
        <label for="${key}A${number}">Odpoveď</label>
        <input class="form-control" type="text" id="${key}A${number}" name="${key}A${number}" data-parent="Q${number}">
    </div>
    `;
};

/**
 * Choose Question
 */

const createChooseQuestionBody = (key, number) => {
    return `
    <div id="chooseQ${number}">
        <div>
            <label for="${key}CA${number}">Správna odpoveď</label>
            <input class="form-control" type="text" id="${key}CA${number}" name="${key}CA${number}" data-parent="Q${number}">
        </div>
        <div>
            <label for="${key}WA1${number}">Nesprávna odpoveď</label>
            <input class="form-control" type="text" id="${key}WA1${number}" name="${key}WA1${number}" data-parent="Q${number}">
        </div>
        <div>
            <label for="${key}WA2${number}">Nesprávna odpoveď</label>
            <input class="form-control" type="text" id="${key}WA2${number}" name="${key}WA2${number}" data-parent="Q${number}">
        </div>
        <div>
            <label for="${key}WA3${number}">Nesprávna odpoveď</label>
            <input class="form-control" type="text" id="${key}WA3${number}" name="${key}WA3${number}" data-parent="Q${number}">
        </div>
    </div>
    `;
};

/**
 * Pair Question
 */

let pairIndex = 1;

const addPairToConnectQuestion = (id, key, number) => {
    ++pairIndex;
    // const row = document.createElement("div");
    const row = `
    <div id="pair-${pairIndex}" class="row">
        <div class="col-md-5">
            <input class="form-control" type="text" id="${key}CQ${number}" name="${key}CQ${number}" data-parent="Q${number}">
        </div>
        <div class="col-md-5">
            <input class="form-control" type="text" id="${key}CA${number}" name="${key}CA${number}" data-parent="Q${number}">
        </div>
        <div class="col-md-1">
            <span onclick="removeElementById('pair-${pairIndex}')" class="btn btn-danger">&times;</span>
        </div>
    </div>
    `;

    // Append row
    $(`#${id}`).append(row);
};

const createConnectQuestionBody = (key, number) => {
    return `
    <div id="connectQ${number}">
        <!-- TODO Try remove redundant code -->
        <div id="pair-${pairIndex}" class="row">
            <div class="col-md-5">
                <input class="form-control" type="text" id="${key}CQ${number}" name="${key}CQ${number}" data-parent="Q">
            </div>
            <div class="col-md-5">
                <input class="form-control" type="text" id="${key}CA${number}" name="${key}CA${number}">
            </div>
            <div class="col-md-1">
                <span onclick="removeElementById('pair-${pairIndex}')" class="btn btn-danger">&times;</span>
            </div>
        </div>

    </div>
    <span class="btn btn-success" onclick="addPairToConnectQuestion('connectQ${number}', '${key}', '${number}')">Add row</span>
    `;
};

/**
 * Math Question & Draw Question
 */
const createCustomQuestion = (key, number, type) => {
    return `
    <div id="connectQ${number}">

        <div id="pair-${pairIndex}" class="row">
            <div class="col-md-5">
                <input class="form-control" type="text" id="${key}CQ${number}" name="${key}CQ${number}" data-parent="Q${number}">
            </div>
            <div class="col-md-5">
                <input class="form-control" type="text" id="${key}CA${number}" name="${key}CA${number}" data-parent="Q${number}">
            </div>
            <div class="col-md-1">
                <span onclick="removeElementById('pair-${pairIndex}')" class="btn btn-danger">&times;</span>
            </div>
        </div>

    </div>
    `;
};
