<?php

    require_once __DIR__."/../database/DatabaseController.php";

    $db = new DatabaseController();

    if($_REQUEST['action'] == 'insertMathAnswer') {
        $db->insertStudentOpenAnswer($student_id, $test_key, $question_id, $_POST['answer']);
    }

    if($_REQUEST['action'] == 'insertDrawAnswer') {
        $db->insertStudentOpenAnswer($student_id, $test_key, $question_id, $_POST['answer']);
    } 

    if($_REQUEST['action'] == 'getDrawAnswer') {
        $result = $db->getStudentAnswersByTestKeyAndQuestionId('OS2021', '11');
        echo $result[0]['answer'];
    }

?>