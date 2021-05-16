<?php


require_once __DIR__ ."/../database/DatabaseController.php";
class GenerateQuestion
{

    private DatabaseController $databaseController;

    public function __construct()
    {
        $this->databaseController = new DatabaseController();
    }

    public function generateSelect($question) {
        echo '
            <div class="card bg-secondary">
                <div class="card-body">';
        $answers = $question["correct_answer"];
        $decoded = json_decode($answers, true);
        $keys = array_keys($decoded);
        foreach ($keys as $key){
            echo '<div class="form-check pt-2"><input type="checkbox" class="output form-check-input" name="'.$question["id"].'_'.$key.'" id="'.$question["id"].'_'.$key.'">';
            echo '<label class="form-check-label" for="'.$question["id"].'_'.$key.'">'.$key.'</label></div>';
        }
        echo '
                </div>
                <input type="hidden" value="1" name="'."{$question['id']}".'_hidden">
            </div>
        ';
    }

    public function generateText($question) {
        echo '
            <div class="card bg-secondary">
                <div class="card-body">
                    <textarea class="output form-control" name="'.$question["id"].'" autocapitalize="off" autocomplete="off" spellcheck="false"></textarea>
                </div>
                <input type="hidden" value="1" name="'."{$question['id']}".'_hidden">
            </div>';
    }

    public function generateConnect($question) {
        echo '
            <div class="card bg-secondary">';
        $answers = $question["correct_answer"];
        $decoded = json_decode($answers, true);
        $keys = array_keys($decoded);

        $left_answers = array();
        $right_answers = array();

        // rozdelenie na polia
        foreach ($keys as $key){
            array_push($left_answers, $key);
            array_push($right_answers, $decoded[$key]);
        }

        shuffle($right_answers);

        // cela cast
        echo '<div class="card-body">';
        foreach ($left_answers as $answer){
            echo "<div class='row p-1'><div class='col'>".$answer."</div>";
            echo '<div class="col"><select class="output form-select" name="'.$question["id"].'_'.$answer.'">';
            foreach ($right_answers as $option) {
                echo '
                        <option class="output" value="'.$option.'">' . $option . '</option>
                        ';
            }
            echo '</select></div></div>';
        }
        echo '</div>';


        echo'
            <input type="hidden" value="1" name="'."{$question['id']}".'_hidden">
            </div>
        ';
    }

    public function generateDraw($question_id) {
        echo '
            <div class="card bg-secondary">
                    <div class="card-header row">
                        <input class="col" value="#000000" id="'.$question_id.'-drawcolor" data-jscolor="{closeButton:true, closeText:"Close"}">
                        <div class="col">
                            <input type="range" min="1" max="99" value="1" step="1" id="'.$question_id.'-drawsize" class="form-range slider-width100" oninput="this.nextElementSibling.value = this.value">
                            <output id="range-num">1</output>    
                        </div>
                        <button type="button" class="btn btn-dark col" onclick="clearCanvas()" id="'.$question_id.'-drawclear">Clear</button>  
                    </div>
                    <div class="card-body">
                        <canvas id="'.$question_id.'-draw"></canvas>
                    </div>
                    <div class="card-footer">
                        <input type="file" name="'.$question_id.'_upload" id="'.$question_id.'_upload" class="form-control">
                    </div>
                    <input type="hidden" id="'.$question_id.'" value="" name="'.$question_id.'">
                    <input type="hidden" value="1" name="'.$question_id.'_hidden">
                </div>
        ';
        //treba includnut v teste
        //<script src="../../js/api/studentAnswer.js"></script>
        //<script src="../../js/draw.js"></script> 
    }

    public function generateEquation($question_id) {
        echo'
            <div class="card bg-secondary">
                    <div class="card-body">
                        <math-field id="mf-'.$question_id.'" class="mathfield" smartMode="true" virtual-keyboard-mode="manual"></math-field>
                    </div>
                    <div class="card-footer">
                        <input type="hidden" id='.$question_id.' name="'.$question_id.'">
                        <input type="hidden" value="1" name="'.$question_id.'_hidden">
                        <input type="file" name="'.$question_id.'_upload" id="'.$question_id.'_upload" class="form-control">
                    </div>
            </div>
        ';
        //treba includnut v teste
        //<script src="../../js/api/studentAnswer.js"></script>
        //<script src="../../js/math.js"></script> 
    }

}

?>