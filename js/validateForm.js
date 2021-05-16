(function() {
  'use strict';
  window.addEventListener('load', function() {
    var forms = document.getElementsByClassName('needs-validation');
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();class="btn btn-danger" onclick="removeElementById('Question${number}')"><i class="bi bi-x-lg"></i></span>
        </div>
        <div class="card-body">
            <div>
                <label for="Q${number}">Otázka</label>
                <input class="form-control" type="text" id="Q${number}" name="Q${number}" data-type="${type}" required>
            </div>
    `;

    // Pocet bodov za otazku
    let pointInput = `
            <div>
                <label for="P${number}">Počet bodov</label>
                <input class="form-control" type="number" id="P${number}" name="P${number}" data-parent="Q${number}" data-group="points" required>
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
        <input class="form-control" type="text" id="OpenA${number}" name="OpenA${number}" data-parent="Q${number}" required>
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
            <div class="col-md-10">
                <input id="checkboxQ${number}-${selectIndex}" type="checkbox" onclick="selectCheckboxHandle(event,'selectQ${number}A${selectIndex}')" >
                <label for="checkboxQ${number}-${selectIndex}">Správna odpoveď</label>
                <input class="form-control" type="text" id="selectQ${number}A${selectIndex}" name="selectQ${number}A${selectIndex}" data-parent="Q${number}" data-correct="false" required>
            </div>
            <div class="col-md-1">
                <span onclick="removeElementById('selectQ${number}-${selectIndex}')" class="btn btn-danger"><i class="bi bi-x-lg"></i></span>
            </div>
        </div>
    `;

    $(`#${bodyId}`).append(row);
};

const createChooseQuestionBody = (number) => {
    return `
    <div id="chooseQ${number}" >
        <div id="selectQ${number}-${selectIndex}" class="row">
            <div class="col-md-10">
                <input id="checkboxQ${number}-${selectIndex}" type="checkbox" onclick="selectCheckboxHandle(event,'selectQ${number}A${selectIndex}')" >
                <label for="checkboxQ${number}-${selectIndex}">Správna odpoveď</label>
                <input class="form-control" type="text" id="selectQ${number}A${selectIndex}" name="selectQ${number}A${selectIndex}" data-parent="Q${number}" data-correct="false" required>
            </div>
            <div class="col-md-1">
                <span onclick="removeElementById('selectQ${number}-${selectIndex}')" class="btn btn-danger"><i class="bi bi-x-lg"></i></span>
            </div>
        </div>
    </div>
    <span class="btn btn-success" onclick="addSelectToChooseQuestion('chooseQ${number}', '${number}')">Pridať odpoveď</span>
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
        <div class="col-md-5">
            <input class="form-control" type="text" id="CQ${number}-${pairIndex}" name="CQ${number}-${pairIndex}" data-parent="Q${number}" data-pair="${pairIndex}">
        </div>
        <div class="col-md-5">
            <input class="form-control" type="text" id="CA${number}-${pairIndex}" name="CA${number}-${pairIndex}" data-parent="Q${number}" data-pair="${pairIndex}">
        </div>
        <div class="col-md-1">
            <span onclick="removeElementById('pairQ${number}-${pairIndex}')" class="btn btn-danger"><i class="bi bi-x-lg"></i></span>
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
            <div class="col-md-5">
                <input class="form-control" type="text" id="CQ${number}-${pairIndex}" name="CQ${number}-${pairIndex}" data-parent="Q${number}" data-pair="${pairIndex}">
            </div>
            <div class="col-md-5">
                <input class="form-control" type="text" id="CA${number}-${pairIndex}" name="CA${number}-${pairIndex}" data-parent="Q${number}" data-pair="${pairIndex}" >
            </div>
            <div class="col-md-1">
                <span onclick="removeElementById('pairQ${number}-${pairIndex}')" class="btn btn-danger"><i class="bi bi-x-lg"></i></span>
            </div>
        </div>

    </div>
    <span class="btn btn-success" onclick="addPairToConnectQuestion('connectQ${number}', '', '${number}')">Pridať riadok</span>
    `;
};
