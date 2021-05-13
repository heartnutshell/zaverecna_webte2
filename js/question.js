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
    <div class="card" id="Question${number}">
        <div class="card-header">
            <span>${typeArr[type]}</span>
            <span class="btn btn-danger" onclick="removeElementById('Question${number}')">&times;</span>
        </div>
        <div class="card-body">
            <div>
                <label for="Q${number}">Otázka</label>
                <input class="form-control" type="text" id="Q${number}" name="Q${number}" data-type="${type}">
            </div>
    `;

    // Pocet bodov za otazku
    let pointInput = `
            <div>
                <label for="P${number}">Počet bodov</label>
                <input class="form-control" type="text" id="P${number}" name="P${number}" data-parent="Q${number}" data-group="points">
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
        <label for="OpenA${number}">Odpoveď</label>
        <input class="form-control" type="text" id="OpenA${number}" name="OpenA${number}" data-parent="Q${number}">
    </div>
    `;
};

/**
 * Choose Question
 */

// const createChooseQuestionBody = (key, number) => {
//     return `
//     <div id="chooseQ${number}">
//         <div>
//             <label for="CorrectA${number}">Správna odpoveď</label>
//             <input class="form-control" type="text" id="CorrectA${number}" name="CorrectA${number}" data-parent="Q${number}">
//         </div>
//         <div>
//             <label for="IncorrectA1${number}">Nesprávna odpoveď</label>
//             <input class="form-control" type="text" id="IncorrectA1${number}" name="IncorrectA1${number}" data-parent="Q${number}">
//         </div>
//         <div>
//             <label for="IncorrectA2${number}">Nesprávna odpoveď</label>
//             <input class="form-control" type="text" id="IncorrectA2${number}" name="IncorrectA2${number}" data-parent="Q${number}">
//         </div>
//         <div>
//             <label for="IncorrectA3${number}">Nesprávna odpoveď</label>
//             <input class="form-control" type="text" id="IncorrectA3${number}" name="IncorrectA3${number}" data-parent="Q${number}">
//         </div>
//     </div>
//     `;
// };

let selectIndex = 1;

const selectCheckboxHandle = (event, id) => {
    const checked = event.target.checked;

    $(`#${id}`).attr("data-correct", checked);
};

const addSelectToChooseQuestion = (bodyId, number) => {
    ++selectIndex;
    const row = `
        <div id="select-${selectIndex}" class="row">
            <div class="col-md-10">
                <input id="checkbox-${selectIndex}" type="checkbox" onclick="selectCheckboxHandle(event,'selectA${selectIndex}')" >
                <label for="checkbox-${selectIndex}">Správna odpoveď</label>
                <input class="form-control" type="text" id="selectA${selectIndex}" name="selectA${selectIndex}" data-parent="Q${number}" data-correct="false">
            </div>
            <div class="col-md-1">
                <span onclick="removeElementById('select-${selectIndex}')" class="btn btn-danger">&times;</span>
            </div>
        </div>
    `;

    $(`#${bodyId}`).append(row);
};

const createChooseQuestionBody = (key, number) => {
    return `
    <div id="chooseQ${number}" >
        <div id="select-${selectIndex}" class="row">
            <div class="col-md-10">
                <input id="checkbox-${selectIndex}" type="checkbox" onclick="selectCheckboxHandle(event,'selectA${selectIndex}')" >
                <label for="checkbox-${selectIndex}">Správna odpoveď</label>
                <input class="form-control" type="text" id="selectA${selectIndex}" name="selectA${selectIndex}" data-parent="Q${number}" data-correct="false">
            </div>
            <div class="col-md-1">
                <span onclick="removeElementById('select-${selectIndex}')" class="btn btn-danger">&times;</span>
            </div>
        </div>
    </div>
    <span class="btn btn-success" onclick="addSelectToChooseQuestion('chooseQ${number}', '${number}')">Pridať odpoveď</span>
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
            <input class="form-control" type="text" id="CQ${number}-${pairIndex}" name="CQ${number}-${pairIndex}" data-parent="Q${number}" data-pair="${pairIndex}">
        </div>
        <div class="col-md-5">
            <input class="form-control" type="text" id="CA${number}-${pairIndex}" name="CA${number}-${pairIndex}" data-parent="Q${number}" data-pair="${pairIndex}">
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
        <div id="pair-${pairIndex}" class="row">
            <div class="col-md-5">
                <input class="form-control" type="text" id="CQ${number}-${pairIndex}" name="CQ${number}-${pairIndex}" data-parent="Q${number}" data-pair="${pairIndex}" >
            </div>
            <div class="col-md-5">
                <input class="form-control" type="text" id="CA${number}-${pairIndex}" name="CA${number}-${pairIndex}" data-parent="Q${number}" data-pair="${pairIndex}" >
            </div>
            <div class="col-md-1">
                <span onclick="removeElementById('pair-${pairIndex}')" class="btn btn-danger">&times;</span>
            </div>
        </div>

    </div>
    <span class="btn btn-success" onclick="addPairToConnectQuestion('connectQ${number}', '', '${number}')">Pridať riadok</span>
    `;
};
