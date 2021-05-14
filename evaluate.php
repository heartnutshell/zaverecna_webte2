<?php

require_once __DIR__ . "/php/database/DatabaseController.php";
require_once __DIR__ . "/php/questions/QuestionType.php";

$databaseController = new DatabaseController();


$post_keys = array_keys($_POST);

$ids = explode(";", $_POST["ids"]);

$_POST["27"] = str_replace("\"", "'", $_POST["27"]);

foreach ($ids as $question_id){

    if ($question_id == "")
        continue;

    $total_points = 0;
    $student_answer = array();
    $current_question = $databaseController->getQuestionById($question_id);

    switch ($current_question[0]["type"]){
        case QuestionType::OPEN:
            $student_answer["answer"] = $_POST[$question_id];
            $current_answers = $current_question[0]["correct_answer"];
            $decoded = json_decode($current_answers, true);
            if ($decoded != null){
                foreach ($decoded as $answer){
                    if ($_POST[$question_id] == $answer){
                        $total_points = $current_question[0]["points"];
                        break;
                    }
                }
            }
            break;
        case QuestionType::CHOOSE:
            $current_answers = json_decode($current_question[0]["correct_answer"], true);

            $points_for_one = $current_question[0]["points"]/sizeof(array_keys($current_answers));

            foreach (array_keys($current_answers) as $array_key){
                $post_key = $question_id."_".$array_key;
                if (isset($_POST[$post_key])){
                    if ($current_answers[$array_key]){
                        // pripocitanie bodov
                        $total_points += $points_for_one;
                    }else{
                        // odpocitanie bodov
                        // $total_points -= $points_for_one;
                    }
                    $student_answer[$array_key] = true;
                }else{
                    if (!$current_answers[$array_key]){
                        // pripocitanie bodov
                        $total_points += $points_for_one;
                    }else{
                        // odpocitanie bodov
                        // $total_points -= $points_for_one;
                    }
                    $student_answer[$array_key] = false;
                }

            }

            break;
        case QuestionType::CONNECT:
            $current_answers = json_decode($current_question[0]["correct_answer"], true);

            $points_for_one = $current_question[0]["points"]/sizeof(array_keys($current_answers));

            foreach (array_keys($current_answers) as $array_key){
                $post_key = $question_id."_".$array_key;
                $post_key = str_replace(" ", "_", $post_key);
                if ($current_answers[$array_key] == $_POST[$post_key]){
                    // pripocitanie bodov
                    $total_points += $points_for_one;
                }else{
                    // odpocitanie bodov
                    // $total_points -= $points_for_one;
                }
                $student_answer[$array_key] = $_POST[$post_key];
            }

            break;
        case QuestionType::MATH:
        case QuestionType::DRAW:
            $student_answer["answer"] = $_POST[$question_id];
            break;
        default:
            echo "wrong question type";
    }

    if (isset($student_answer)){
        $databaseController->insertStudentAnswerWithPoints($_POST["student_id"], $_POST["test_key"], $current_question[0]["id"], json_encode($student_answer), $total_points);
    }
}
