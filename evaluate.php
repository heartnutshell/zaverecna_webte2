<?php

require_once __DIR__ . "/php/database/DatabaseController.php";
require_once __DIR__ . "/php/questions/QuestionType.php";

$databaseController = new DatabaseController();


$post_keys = array_keys($_POST);


foreach ($post_keys as $key){
    if ($key == "student_id" || $key == "test_key"){
        continue;
    }

    if (str_contains($key, "_hidden")){
        $post_array = explode("_", $key, 2);
    }else{
        continue;
    }

    $total_points = 0;
    $student_answer = array();
    $current_question = $databaseController->getQuestionById(intval($post_array[0]));

    switch ($current_question[0]["type"]){
        case QuestionType::OPEN:
            $student_answer["answer"] = $_POST[$key];
            $current_answers = $current_question[0]["correct_answer"];
            $decoded = json_decode($current_answers, true);
            if ($decoded != null){
                foreach ($decoded as $answer){
                    if ($_POST[$key] == $answer){
                        $total_points = $current_question[0]["points"];
                        break;
                    }
                }
            }
            break;
        case QuestionType::CHOOSE:
            $current_answers = $current_question[0]["correct_answer"];
            $decoded = json_decode($current_answers, true);

            $points_for_one = $current_question[0]["points"]/sizeof(array_keys($decoded));

            foreach (array_keys($decoded) as $array_key){
                $post_key = $current_question[0]["id"]."_".$array_key;
                if (isset($_POST[$post_key])){
                    if ($decoded[$array_key]){
                        // pripocitanie bodov
                        $total_points += $points_for_one;
                    }else{
                        // odpocitanie bodov
                        // $total_points -= $points_for_one;
                    }
                    $student_answer[$array_key] = true;
                }else{
                    if (!$decoded[$array_key]){
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
            $current_answers = $current_question[0]["correct_answer"];
            $decoded = json_decode($current_answers, true);

            $points_for_one = $current_question[0]["points"]/sizeof(array_keys($decoded));

            foreach (array_keys($decoded) as $array_key){
                $post_key = $current_question[0]["id"]."_".$array_key;
                if ($decoded[$array_key] == $_POST[$post_key]){
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
            $student_answer["answer"] = $_POST[$key];
            break;
        default:
            echo "wrong question type";
    }

    if (isset($student_answer)){
        $databaseController->insertStudentAnswerWithPoints($_POST["student_id"], $_POST["test_key"], $current_question[0]["id"], json_encode($student_answer), $total_points);
    }
}
