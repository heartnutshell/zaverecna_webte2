<?php

function openEvaluation($answer)
{

    $answerJson = json_decode($answer["answer"]);

    echo "
    <div class='card bg-secondary'>
        <div class='card-body'>
            <p>$answerJson->answer</p>
        </div>
        <div class='card-footer'>
            <input type='number' name='{$answer["question_id"]}' min='0' max='{$answer["max_points"]}' step='0.5' required value='{$answer["student_points"]}'>
            /{$answer["max_points"]}
        </div>
    </div>

    ";
}

function chooseEvaluation($answer)
{


    $parsedAnswer = json_decode($answer["answer"]);

    echo '
    <div class="card bg-secondary">
        <div class="card-body">';

    foreach ($parsedAnswer as $key => $value) {

        $checked = $value ? 'checked' : '';

        echo "
        <div class='form-check pt-2'>
            <input type='checkbox' class='output form-check-input' $checked onclick='return false;'>
            <label class='form-check-label' >$key</label>
        </div>";
    }
    echo "
        </div>
        <div class='card-footer'>
            {$answer["student_points"]}/{$answer["max_points"]}
        </div>
    </div>";
}

function connectEvaluation($answer)
{
    $parsedAnswer = json_decode($answer["answer"]);

    echo '
    <div class="card bg-secondary">
        <div class="card-body">
            <table class="table table-hover">';

    foreach ($parsedAnswer as $key => $value) {

        $checked = $value ? 'checked' : '';

        echo "
                <tr>
                    <td>$key</td>
                    <td>$value</td>
                <tr>";
    }
    echo "   </table>
        </div>
        <div class='card-footer'>
            {$answer["student_points"]}/{$answer["max_points"]}
        </div>
    </div>";
}



function drawEvaluation($answer)
{

    if (is_file('../uploadedAnswers/' . json_decode($answer["answer"])->answer)) {
        $studentAnswer = "<img src='../uploadedAnswers/" . json_decode($answer["answer"])->answer . "'>";
    } else {
        $studentAnswer = json_decode($answer["answer"])->answer;
    }

    echo "
    <div class='card bg-secondary'>
        <div class='card-body'>
            $studentAnswer
        </div>
        <div class='card-footer'>
            <input type='number' name='{$answer["question_id"]}' min='0' max='{$answer["max_points"]}' step='0.5' required value='{$answer["student_points"]}'>
            /{$answer["max_points"]}
        </div>
    </div>";
}

function mathEvaluation($answer)
{

    if (is_file('../uploadedAnswers/' . json_decode($answer["answer"])->answer)) {
        $studentAnswer = "<img src='../uploadedAnswers/" . json_decode($answer["answer"])->answer . "'>";
    } else {
        $studentAnswer = json_decode($answer["answer"])->answer;
        $studentAnswer = "$$$studentAnswer$$";
    }

    echo "
    <div class='card bg-secondary'>
        <div class='card-body'>
            $studentAnswer
        </div>
        <div class='card-footer'>
            <input type='number' name='{$answer["question_id"]}' min='0' max='{$answer["max_points"]}' step='0.5' required value='{$answer["student_points"]}'>
            /{$answer["max_points"]}
        </div>
    </div>";
}