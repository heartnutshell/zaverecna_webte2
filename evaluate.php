<?php

require_once __DIR__ . "/php/database/DatabaseController.php";
require_once __DIR__ . "/php/questions/QuestionType.php";

date_default_timezone_set("Europe/Bratislava");
$end_time = date('Y-m-d H:i:s');

$databaseController = new DatabaseController();

$post_keys = array_keys($_POST);
$ids = explode(";", $_POST["ids"]);
$total_points = 0;

foreach ($ids as $question_id){

    if ($question_id == "")
        continue;

    $question_points = 0;
    $student_answer = array();
    $current_question = $databaseController->getQuestionById($question_id);

    switch ($current_question[0]["type"]){
        case QuestionType::OPEN:
            $student_answer["answer"] = $_POST[$question_id];
            $current_answers = $current_question[0]["correct_answer"];
            $decoded = json_decode($current_answers, true);
            if ($decoded != null){
                foreach ($decoded as $answer){
                    if (!strcasecmp($_POST[$question_id],$answer)){
                        $question_points = $current_question[0]["points"];
                        break;
                    }
                }
            }
            break;
        case QuestionType::CHOOSE:
            $current_answers = json_decode($current_question[0]["correct_answer"], true);

            $true = 0;

            foreach($current_answers as $answer){
                if ($answer == 'true'){
                    $true++;
                }
            }

            $points_for_one = $current_question[0]["points"]/$true;

            foreach (array_keys($current_answers) as $array_key){
                $post_key = $question_id."_".$array_key;
                if (isset($_POST[$post_key])){
                    if ($current_answers[$array_key] == 'true'){
                        // pripocitanie bodov
                        $question_points += $points_for_one;
                    }else{
                        // odpocitanie bodov
                        $question_points -= $points_for_one;
                    }
                    $student_answer[$array_key] = true;
                }else{                    
                    $student_answer[$array_key] = false;
                }

            }
            if ($question_points < 0) {
                $question_points = 0;
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
                    $question_points += $points_for_one;
                }else{
                    // odpocitanie bodov
                    // $total_points -= $points_for_one;
                }
                $student_answer[$array_key] = $_POST[$post_key];
            }

            break;
        case QuestionType::MATH:
        case QuestionType::DRAW:
            if ($_FILES[$question_id."_upload"]["size"] > 0){

                $target_dir = "uploadedAnswers/";
                $target_file = $target_dir . basename($_FILES[$question_id."_upload"]["name"]);
                $uploadOk = 1;
                $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                if($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg") {
                    $uploadOk = 0;
                }

                if ($_FILES[$question_id."_upload"]["size"] > 2000000) {
                    $uploadOk = 0;
                }

                if ($uploadOk == 0) {
                } else {
                    // file name from studenID and questionID?
                    if (move_uploaded_file($_FILES[$question_id."_upload"]["tmp_name"], $target_dir. $_POST["student_id"]."_".$question_id.".".$fileType)) {
                    } else {
                    }
                }

                $student_answer["answer"] = $_POST["student_id"]."_".$question_id.".".$fileType;
            }else{
                $_POST[$question_id] = str_replace("\"", "'", $_POST[$question_id]);
                $student_answer["answer"] = $_POST[$question_id];
            }
            break;
        default:
            echo "wrong question type";
    }

    if (isset($student_answer)){
        $databaseController->insertStudentAnswerWithPoints($_POST["student_id"], $_POST["test_key"], $current_question[0]["id"], json_encode($student_answer), $question_points);
    }

    $total_points += $question_points;
}

$databaseController->updateStudentTest($_POST["test_key"], $_POST["student_id"], $end_time, $total_points);

header('Location: index.php?sent=1');