<?php

require_once __DIR__ ."/Database.php";

class DatabaseController
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = (new Database())->getConnection();
    }

    // INSERT
    public function insertTeacher($username, $password){
        $stmt = $this->conn->prepare("INSERT IGNORE INTO teacher (username, password) VALUES (:username, :password)");
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $password);
        $stmt->execute();
    }
/*
    public function insertTeacherWithName($username, $password, $name, $surname){
        $stmt = $this->conn->prepare("INSERT IGNORE INTO connections (password, name, surname) VALUES (:password, :name, :surname)");
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":surname", $surname);
        $stmt->execute();
    }
*/
    public function insertTest($test_key, $teacher_id, $time_limit, $active, $max_points){
        $stmt = $this->conn->prepare("INSERT IGNORE INTO test (test_key, teacher_id, time_limit, active, max_points) VALUES (:test_key, :teacher_id, :time_limit, :active, :max_points)");
        $stmt->bindParam(":test_key", $test_key);
        $stmt->bindParam(":teacher_id", $teacher_id);
        $stmt->bindParam(":time_limit", $time_limit);
        $stmt->bindParam(":active", $active);
        $stmt->bindParam(":max_points", $max_points);
        $stmt->execute();
    }

    public function insertQuestion($test_key, $type, $question, $points, $correct_connect = null){
        if ($correct_connect == null){
            $stmt = $this->conn->prepare("INSERT IGNORE INTO questions (test_key, type, question, points) VALUES (:test_key, :type, :question, :points)");
        }else{
            $stmt = $this->conn->prepare("INSERT IGNORE INTO questions (test_key, type, question, correct_connect, points) VALUES (:test_key, :type, :question, :correct_connect, :points)");
            $stmt->bindParam(":correct_connect", $correct_connect);
        }
        $stmt->bindParam(":test_key", $test_key);
        $stmt->bindParam(":type", $type);
        $stmt->bindParam(":question", $question);
        $stmt->bindParam(":points", $points);
        $stmt->execute();
    }

    public function insertAnswer($question_id, $answer, $is_correct){
        $stmt = $this->conn->prepare("INSERT IGNORE INTO answers (question_id, answer, is_correct) VALUES (:question_id, :answer, :is_correct)");
        $stmt->bindParam(":question_id", $question_id);
        $stmt->bindParam(":answer", $answer);
        $stmt->bindParam(":is_correct", $is_correct);
        $stmt->execute();
    }

    public function insertAnswerWithKey($question_id, $answer, $answer_key, $is_correct){
        $stmt = $this->conn->prepare("INSERT IGNORE INTO answers (question_id, answer, answer_key, is_correct) VALUES (:question_id, :answer, :answer_key, :is_correct)");
        $stmt->bindParam(":question_id", $question_id);
        $stmt->bindParam(":answer", $answer);
        $stmt->bindParam(":answer_key", $answer_key);
        $stmt->bindParam(":is_correct", $is_correct);
        $stmt->execute();
    }

    public function insertCompletedTest($student_id, $test_key, $name, $surname, $left_tab, $points){
        $stmt = $this->conn->prepare("INSERT IGNORE INTO completed_tests (student_id, test_key, name, surname, left_tab, points) VALUES (:student_id, :test_key, :name, :surname, :left_tab, :points)");
        $stmt->bindParam(":student_id", $student_id);
        $stmt->bindParam(":test_key", $test_key);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":surname", $surname);
        $stmt->bindParam(":left_tab", $left_tab);
        $stmt->bindParam(":points", $points);
        $stmt->execute();
    }

    public function insertStudentAnswer($student_id, $test_key, $question_id, $answer_id){
        $stmt = $this->conn->prepare("INSERT IGNORE INTO student_answers (student_id, test_key, question_id, answer_id) VALUES (:student_id, :test_key, :question_id, :answer_id)");
        $stmt->bindParam(":student_id", $student_id);
        $stmt->bindParam(":test_key", $test_key);
        $stmt->bindParam(":question_id", $question_id);
        $stmt->bindParam(":answer_id", $answer_id);
        $stmt->execute();
    }

    public function insertStudentOpenAnswer($student_id, $test_key, $question_id, $answer){
        $stmt = $this->conn->prepare("INSERT IGNORE INTO student_answers (student_id, test_key, question_id, answer) VALUES (:student_id, :test_key, :question_id, :answer)");
        $stmt->bindParam(":student_id", $student_id);
        $stmt->bindParam(":test_key", $test_key);
        $stmt->bindParam(":question_id", $question_id);
        $stmt->bindParam(":answer", $answer);
        $stmt->execute();
    }

    public function insertStudentFileAnswer($student_id, $test_key, $question_id, $file){
        $stmt = $this->conn->prepare("INSERT IGNORE INTO student_answers (student_id, test_key, question_id, file) VALUES (:student_id, :test_key, :question_id, :file)");
        $stmt->bindParam(":student_id", $student_id);
        $stmt->bindParam(":test_key", $test_key);
        $stmt->bindParam(":question_id", $question_id);
        $stmt->bindParam(":file", $file);
        $stmt->execute();
    }

    public function insertStudentConnectAnswer($student_id, $test_key, $question_id, $connect_answer){
        $stmt = $this->conn->prepare("INSERT IGNORE INTO student_answers (student_id, test_key, question_id, connect_answer) VALUES (:student_id, :test_key, :question_id, :connect_answer)");
        $stmt->bindParam(":student_id", $student_id);
        $stmt->bindParam(":test_key", $test_key);
        $stmt->bindParam(":question_id", $question_id);
        $stmt->bindParam(":connect_answer", $connect_answer);
        $stmt->execute();
    }



    /**
     * @return PDO
     */
    public function getConn(): PDO
    {
        return $this->conn;
    }


}

