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
            <div class="card mb-3">
                <div class="card-body">';
                    $answers = $question["correct_answer"];
                    $decoded = json_decode($answers, true);
                    $keys = array_keys($decoded);
                    echo '<input type="hidden" class="output" name="'.$question["id"].'_hidden">';
                    foreach ($keys as $key){
                        echo '<input type="checkbox" class="output" name="'.$question["id"].'_'.$key.'">'.$key.'<br>';
                    }
                    echo '
                </div>
            </div>
        ';
    }

    public function generateText($question) {
        echo '
            <div class="card mb-3">
                <div class="card-body">
                    <input type="hidden" class="output" name="'.$question["id"].'_hidden">
                    <textarea class="output" name="'.$question["id"].'" autocapitalize="off" autocomplete="off" spellcheck="false"></textarea>
                </div>
            </div>';
    }

    public function generateConnect($question) {
        echo '
            <div class="card">';
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

                    // Lava cast
                echo '<div class="row"><div class="card-body col-6">';
                foreach ($left_answers as $answer){
                    echo $answer."<br>";
                }
                echo '</div>';

                // Prava cast
                echo '<div class="card-body col-6">';
                echo '<input type="hidden" class="output" name="'.$question["id"].'_hidden">';
                foreach ($left_answers as $answer){
                    echo '<select class="output" name="'.$question["id"].'_'.$answer.'">';
                    foreach ($right_answers as $option) {
                        echo '
                        <option class="output" value="'.$option.'">' . $option . '</option>
                        ';
                    }
                    echo '</select><br>';

                }
                echo '</div></div>';

                echo'
            </div>
        ';
    }

    public function generateDraw($question_id) {
        $result = $this->databaseController->getQuestionById($question_id);
        $question = $result[0]['question'];
        echo '
            <div class="card mb-3">
                    <div class="card-header">
                        <span>'.$question.'</span>
                        <input value="#000000" id="'.$question_id.'-drawcolor" data-jscolor="{closeButton:true, closeText:"Close"}">
                        <input type="range" min="1" max="100" value="1" step="1" id="'.$question_id.'-drawsize" class="form-range slider-width100" oninput="this.nextElementSibling.value = this.value">
                        <output id="range-num">1</output>      
                    </div>
                    <div class="card-body">
                        <canvas id="'.$question_id.'-draw"></canvas>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-outline-primary" onclick="clearCanvas()" id="'.$question_id.'-drawclear">Clear</button>
                    </div>
                    <input type="hidden" id="'.$question_id.'" value="">
                </div>
        ';
        //treba includnut v teste
        //<script src="../../js/api/studentAnswer.js"></script>
        //<script src="../../js/draw.js"></script> 
    }

    public function generateEquation($question_id) {
        $result = $this->databaseController->getQuestionById($question_id);
        $question = $result[0]['question'];
        echo'
            <div class="card mb-3">
                    <div class="card-header">
                        <span><?php echo $question ?></span>
                    </div>
                    <div class="card-body">
                        <math-field id="mf-'.$question_id.'" class="mathfield" smartMode="true" virtual-keyboard-mode="manual"></math-field>
                    </div>
                    <div class="card-footer">
                        <input type="hidden" id='.$question_id.'>
                    </div>
            </div>
        ';
        //treba includnut v teste
        //<script src="../../js/api/studentAnswer.js"></script>
        //<script src="../../js/math.js"></script> 
    }

}

?>
