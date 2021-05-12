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
                <div class="card mb-3">
                    <div class="row">';
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
                </div>
        ';
    }

    public function generateDraw($question) {
        //TODO
    }

    public function generateEquation($question) {
        //TODO
    }

}