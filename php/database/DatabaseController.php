<?php

require_once __DIR__ . "/Database.php";
date_default_timezone_set("Europe/Bratislava");

class DatabaseController
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = (new Database())->getConnection();
    }

    // GET
    public function getTeacherByEmail($email): array
    {
        $stmt = $this->conn->prepare("SELECT * FROM teacher WHERE email LIKE :email");
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getStudentByID($id): array
    {
        $stmt = $this->conn->prepare("SELECT * FROM student WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getAllTeacherTests($teacher_id): array
    {
        $stmt = $this->conn->prepare("SELECT * FROM test WHERE teacher_id LIKE :teacher_id");
        $stmt->bindParam(":teacher_id", $teacher_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getTestByKey($test_key): array
    {
        $stmt = $this->conn->prepare("SELECT * FROM test WHERE test_key LIKE :test_key");
        $stmt->bindParam(":test_key", $test_key);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getTestKeys(): array
    {
        $stmt = $this->conn->prepare("SELECT test_key FROM test");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getQuestionsByTestKey($test_key): array
    {
        $stmt = $this->conn->prepare("SELECT * FROM questions WHERE test_key LIKE :test_key");
        $stmt->bindParam(":test_key", $test_key);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getQuestionById($id): array
    {
        $stmt = $this->conn->prepare("SELECT * FROM questions WHERE id LIKE :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /*
    public function getAllCompletedTests(): array
    {
        $stmt = $this->conn->prepare("SELECT * FROM completed_tests");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    */

    public function getCompletedTestsByTestKey($test_key): array
    {
        $stmt = $this->conn->prepare("SELECT * FROM completed_tests WHERE test_key LIKE :test_key");
        $stmt->bindParam(":test_key", $test_key);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getCompletedTestsByStudentId($student_id): array
    {
        $stmt = $this->conn->prepare("SELECT * FROM completed_tests WHERE student_id LIKE :student_id");
        $stmt->bindParam(":student_id", $student_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getStudentsByTestKey($test_key, $last_id): array
    {
        $stmt = $this->conn->prepare("SELECT * FROM student_tests, student WHERE test_key LIKE :test_key AND student.id = student_tests.student_id AND student_tests.id > :last_id");
        $stmt->bindParam(":test_key", $test_key);
        $stmt->bindParam(":last_id", $last_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getStudentAnswersByTestKeyAndStudentId($test_key, $student_id): array
    {
        $stmt = $this->conn->prepare("SELECT * FROM student_answers WHERE student_id LIKE :student_id AND test_key LIKE :test_key");
        $stmt->bindParam(":student_id", $student_id);
        $stmt->bindParam(":test_key", $test_key);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getStudentAnswersByTestKeyAndQuestionId($test_key, $question_id): array
    {
        $stmt = $this->conn->prepare("SELECT * FROM student_answers WHERE question_id LIKE :question_id AND test_key LIKE :test_key");
        $stmt->bindParam(":question_id", $question_id);
        $stmt->bindParam(":test_key", $test_key);
        $stmt->execute();
        return $stmt->fetchAll();
    }


    // UPDATE
    public function updateCompletedTestPoints($test_key, $student_id, $points)
    {
        $stmt = $this->conn->prepare("UPDATE completed_tests SET points=:points WHERE test_key LIKE :test_key AND student_id LIKE :student_id");
        $stmt->bindParam(":points", $points);
        $stmt->bindParam(":test_key", $test_key);
        $stmt->bindParam(":student_id", $student_id);
        $stmt->execute();
    }

    public function updateStudentAnswerToCorrect($id, $is_correct)
    {
        $stmt = $this->conn->prepare("UPDATE student_answers SET is_correct=:is_correct WHERE id LIKE :id");
        $stmt->bindParam(":is_correct", $is_correct);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }

    public function updateTestActiveStatus($test_key, $newStatus)
    {
        $stmt = $this->conn->prepare("UPDATE test SET active=:active WHERE test_key LIKE :test_key");
        $stmt->bindParam(":active", $newStatus);
        $stmt->bindParam(":test_key", $test_key);
        $stmt->execute();
    }

    // INSERT
    public function insertStudent($id, $name, $surname)
    {
        $stmt = $this->conn->prepare("INSERT IGNORE INTO student (id, name, surname) VALUES (:id, :name, :surname)");
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":surname", $surname);
        $stmt->execute();
    }

    public function insertTeacherWithName($email, $password, $name, $surname): bool
    {
        $stmt = $this->conn->prepare("INSERT IGNORE INTO teacher (email, password, name, surname) VALUES (:email, :password, :name, :surname)");
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":surname", $surname);
        $stmt->execute();
        $result = $this->getTeacherByEmail($email);
        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function insertTest($test_key, $teacher_id, $time_limit, $active, $max_points)
    {
        $stmt = $this->conn->prepare("INSERT IGNORE INTO test (test_key, teacher_id, time_limit, active, max_points) VALUES (:test_key, :teacher_id, :time_limit, :active, :max_points)");
        $stmt->bindParam(":test_key", $test_key);
        $stmt->bindParam(":teacher_id", $teacher_id);
        $stmt->bindParam(":time_limit", $time_limit);
        $stmt->bindParam(":active", $active);
        $stmt->bindParam(":max_points", $max_points);
        $stmt->execute();
    }

    public function insertQuestion($test_key, $type, $question, $correct_answer, $points)
    {
        $stmt = $this->conn->prepare("INSERT IGNORE INTO questions (test_key, type, question, correct_answer, points) VALUES (:test_key, :type, :question, :correct_answer, :points)");
        $stmt->bindParam(":test_key", $test_key);
        $stmt->bindParam(":type", $type);
        $stmt->bindParam(":question", $question);
        $stmt->bindParam(":correct_answer", $correct_answer);
        $stmt->bindParam(":points", $points);
        $stmt->execute();
    }

    public function insertCompletedTest($student_id, $test_key, $name, $surname, $left_tab, $points)
    {
        $stmt = $this->conn->prepare("INSERT IGNORE INTO completed_tests (student_id, test_key, name, surname, left_tab, points) VALUES (:student_id, :test_key, :name, :surname, :left_tab, :points)");
        $stmt->bindParam(":student_id", $student_id);
        $stmt->bindParam(":test_key", $test_key);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":surname", $surname);
        $stmt->bindParam(":left_tab", $left_tab);
        $stmt->bindParam(":points", $points);
        $stmt->execute();
    }

    public function insertStudentAnswer($student_id, $test_key, $question_id, $answer)
    {
        $stmt = $this->conn->prepare("INSERT IGNORE INTO student_answers (student_id, test_key, question_id, answer) VALUES (:student_id, :test_key, :question_id, :answer)");
        $stmt->bindParam(":student_id", $student_id);
        $stmt->bindParam(":test_key", $test_key);
        $stmt->bindParam(":question_id", $question_id);
        $stmt->bindParam(":answer", $answer);
        $stmt->execute();
    }

    public function insertStudentVisibility($test_key, $student_id, $visibility)
    {
        $time = Date("Y-m-d H:i_s");
        $stmt = $this->conn->prepare("INSERT IGNORE INTO student_visibilities (test_key, student_id, visibility, timestamp) VALUES (:test_key, :student_id, :visibility, :timestamp)");
        $stmt->bindParam(":test_key", $test_key);
        $stmt->bindParam(":student_id", $student_id);
        $stmt->bindParam(":visibility", $visibility);
        $stmt->bindParam(":timestamp", $time);
        $stmt->execute();
    }

    public function getStudentsVisibility($test_key, $last_id): array
    {
        $stmt = $this->conn->prepare("SELECT * FROM student_visibilities AS st_v, student AS s WHERE st_v.student_id = s.id  AND st_v.test_key = :test_key AND st_v.id > :last_id ORDER BY st_v.id ASC");
        $stmt->bindParam(":test_key", $test_key);
        $stmt->bindParam(":last_id", $last_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }


    /**
     * @return PDO
     */
    public function getConn(): PDO
    {
        return $this->conn;
    }
}