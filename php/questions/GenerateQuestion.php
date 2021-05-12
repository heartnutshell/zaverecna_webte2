<?php


require_once __DIR__ ."/../database/DatabaseController.php";
class GenerateQuestion
{

    private DatabaseController $databaseController;

    public function __construct()
    {
        $this->databaseController = new DatabaseController();
    }

    public function generateSelect($question_id) {
        echo '
            <div class="card mb-3">
                <div class="card-body">';
                    $answers = $this->databaseController->getAnswersByQuestionId($question_id);
                    foreach ($answers as $answer){
                        echo $answer["answer"].'<input type="checkbox" class="output" id="'.$question_id.'"><br>';
                    }
                    echo '
                </div>
            </div>
        ';
    }

    public function generateText($question_id) {
        echo '
            <div class="card mb-3">
                <div class="card-body">
                    <textarea class="output" id="'.$question_id.'" autocapitalize="off" autocomplete="off" spellcheck="false"></textarea>
                </div>
            </div>';
    }

    public function generateConnect($question_id) {
        echo '
            <div class="card mb-3">';
                    $answers = $this->databaseController->getAnswersByQuestionId(5);

                    $left_answers = array();
                    $right_answers = array();

                    // rozdelenie na polia
                    foreach ($answers as $answer){
                        if (is_numeric($answer["answer_key"])){
                            array_push($right_answers, $answer);
                        }else{
                            array_push($left_answers, $answer);
                        }
                    }

                    // sortovanie podla abecedy
                    usort($left_answers, function ($item1, $item2){
                        return ord($item1["answer_key"]) >  ord($item2["answer_key"]);
                    });
                    usort($right_answers, function ($item1, $item2){
                        return ord($item1["answer_key"]) >  ord($item2["answer_key"]);
                    });

                        // Lava cast
                    echo '<div class="card-body col-6">';
                    foreach ($left_answers as $answer){
                        echo $answer["answer_key"].") ".$answer["answer"]."<br>";
                    }
                    echo '</div>';

                    // Prava cast
                    echo '<div class="card-body col-6">';
                    foreach ($left_answers as $answer){
                        echo '<select class="output" id="'.$question_id.'">';
                        foreach ($right_answers as $option) {
                            echo '
                            <option class="output" id="' . $option["answer_key"] . '">' . $option["answer"] . '</option>
                            ';
                        }
                        echo '</select><br>';

                    }
                    echo '</div>';

                    echo'
            </div>
        ';
    }

    public function generateDraw($question) {
        echo '
            <div class="card mb-3">
                <div class="card-header">
                    <span>'.$question.'</span>
                    <input value="#000000" id="colorPicker" data-jscolor="{closeButton:true, closeText:"Close"}">
                    <input type="range" min="1" max="100" value="1" step="1" id="sizeSlider" class="form-range slider-width100" oninput="this.nextElementSibling.value = this.value">
                    <output id="range-num">1</output>      
                </div>
                <div class="card-body">
                    <canvas id="drawHere"></canvas>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-outline-primary" onclick="clearCanvas()" id="clear">Clear</button>
                    <button type="button" class="btn btn-outline-primary" onclick="saveDrawing()" id="save">Save</button>
                    <button type="button" class="btn btn-outline-primary" onclick="loadDrawing()" id="save">Load last Save</button>
                </div>
            </div>
        ';
        //treba includnut v teste
        //<script src="../../js/api/studentAnswer.js"></script>
        //<script src="../../js/draw.js"></script> 
    }

    public function generateEquation($question) {
        echo'
            <div class="card mb-3">
                <div class="card-header">
                    <span>'.$question.'</span>
                </div>
                <div class="card-body">
                    <math-field id="mf" class="mathfield" smartMode="true" virtual-keyboard-mode="manual"></math-field>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-outline-primary" id="save">Save</button>
                    <button type="button" class="btn btn-outline-primary" id="load">load</button>
                </div>
            </div>
        ';
        //treba includnut v teste
        //<script src="../../js/api/studentAnswer.js"></script>
        //<script src="../../js/math.js"></script> 
    }

}

?>