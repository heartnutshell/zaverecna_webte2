<?php

require_once __DIR__ . "/Database.php";

class DatabaseController
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = (new Database())->getConnection();
    }

    // GET
    public function getTeacherByUsername($username): array
    {
        $stmt = $this->conn->prepare("SELECT * FROM teacher WHERE username LIKE :username");
        $stmt->bindParam(":username", $username);
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

    public function getAnswersByQuestionId($question_id): array
    {
        $stmt = $this->conn->prepare("SELECT * FROM answers WHERE question_id LIKE :question_id");
        $stmt->bindParam(":question_id", $question_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getAllStudentTests(): array
    {
        $stmt = $this->conn->prepare("SELECT * FROM student_tests");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getStudentTestsByTestKey($test_key): array
    {
        $stmt = $this->conn->prepare("SELECT * FROM student_tests WHERE test_key LIKE :test_key");
        $stmt->bindParam(":test_key", $test_key);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getCompletedStudentTestsByTestKey($test_key): array
    {
        $completed = 1;
        $stmt = $this->conn->prepare("SELECT * FROM student_tests WHERE test_key LIKE :test_key AND completed = :completed");
        $stmt->bindParam(":test_key", $test_key);
        $stmt->bindParam(":completed", $completed);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getStudentTestsByStudentId($student_id): array
    {
        $stmt = $this->conn->prepare("SELECT * FROM student_tests WHERE student_id LIKE :student_id");
        $stmt->bindParam(":student_id", $student_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getCompletedTestsByStudentId($student_id): array
    {
        $completed = 1;
        $stmt = $this->conn->prepare("SELECT * FROM student_tests WHERE student_id LIKE :student_id AND completed = :completed");
        $stmt->bindParam(":student_id", $student_id);
        $stmt->bindParam(":completed", $completed);
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

    public function getStudentById($id): array
    {
        $stmt = $this->conn->prepare("SELECT * FROM student WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }


    // UPDATE


    public function updateStudentAnswerIsCorrect($id, $is_correct)
    {
        $stmt = $this->conn->prepare("UPDATE student_answers SET is_correct=:is_correct WHERE id LIKE :id");
        $stmt->bindParam(":is_correct", $is_correct);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }

    public function updateStudent($id, $name, $surname)
    {
        $stmt = $this->conn->prepare("UPDATE student SET name=:name, surname=:surname WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":surname", $surname);
        $stmt->execute();
    }

    public function updateStudentTestPoints($test_key, $student_id, $points)
    {
        $stmt = $this->conn->prepare("UPDATE student_tests SET points=:points WHERE test_key LIKE :test_key AND student_id LIKE :student_id");
        $stmt->bindParam(":points", $points);
        $stmt->bindParam(":test_key", $test_key);
        $stmt->bindParam(":student_id", $student_id);
        $stmt->execute();
    }

    public function setCorrectConnectAnswer($question_id, $correct_connect)
    {
        $stmt = $this->conn->prepare("UPDATE questions SET correct_connect=:correct_connect WHERE id LIKE :question_id");
        $stmt->bindParam(":correct_connect", $correct_connect);
        $stmt->bindParam(":question_id", $question_id);
        $stmt->execute();
    }

    public function setStudentLeftTab($student_id, $test_key)
    {
        $left_tab = 1;
        $stmt = $this->conn->prepare("UPDATE student_tests SET left_tab=:left_tab WHERE test_key LIKE :test_key AND student_id LIKE :student_id");
        $stmt->bindParam(":student_id", $student_id);
        $stmt->bindParam(":test_key", $test_key);
        $stmt->bindParam(":left_tab", $left_tab);
        $stmt->execute();
    }

    public function setStudentCompletedTest($student_id, $test_key, $points)
    {
        $completed = 1;
        $stmt = $this->conn->prepare("UPDATE student_tests SET completed=:completed, points=:points WHERE test_key LIKE :test_key AND student_id LIKE :student_id");
        $stmt->bindParam(":student_id", $student_id);
        $stmt->bindParam(":test_key", $test_key);
        $stmt->bindParam(":completed", $completed);
        $stmt->bindParam(":points", $points);
        $stmt->execute();
    }

    // INSERT
    public function insertTeacher($username, $password)
    {
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
    public function insertStudent($id, $name, $surname)
    {
        $stmt = $this->conn->prepare("INSERT IGNORE INTO student (id, name, surname) VALUES (:id, :name, :surname)");
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":surname", $surname);
        $stmt->execute();
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

    public function insertQuestion($test_key, $type, $question, $points, $correct_connect = null)
    {
        if ($correct_connect == null) {
            $stmt = $this->conn->prepare("INSERT IGNORE INTO questions (test_key, type, question, points) VALUES (:test_key, :type, :question, :points)");
        } else {
            $stmt = $this->conn->prepare("INSERT IGNORE INTO questions (test_key, type, question, correct_connect, points) VALUES (:test_key, :type, :question, :correct_connect, :points)");
            $stmt->bindParam(":correct_connect", $correct_connect);
        }
        $stmt->bindParam(":test_key", $test_key);
        $stmt->bindParam(":type", $type);
        $stmt->bindParam(":question", $question);
        $stmt->bindParam(":points", $points);
        $stmt->execute();
    }

    public function insertAnswer($question_id, $answer, $is_correct)
    {
        $stmt = $this->conn->prepare("INSERT IGNORE INTO answers (question_id, answer, is_correct) VALUES (:question_id, :answer, :is_correct)");
        $stmt->bindParam(":question_id", $question_id);
        $stmt->bindParam(":answer", $answer);
        $stmt->bindParam(":is_correct", $is_correct);
        $stmt->execute();
    }

    public function insertAnswerWithKey($question_id, $answer, $answer_key, $is_correct = 0)
    {
        $stmt = $this->conn->prepare("INSERT IGNORE INTO answers (question_id, answer, answer_key, is_correct) VALUES (:question_id, :answer, :answer_key, :is_correct)");
        $stmt->bindParam(":question_id", $question_id);
        $stmt->bindParam(":answer", $answer);
        $stmt->bindParam(":answer_key", $answer_key);
        $stmt->bindParam(":is_correct", $is_correct);
        $stmt->execute();
    }

    public function insertStudentTest($student_id, $test_key, $start_time)
    {
        $stmt = $this->conn->prepare("INSERT IGNORE INTO student_tests (student_id, test_key, start_time) VALUES (:student_id, :test_key, :start_time)");
        $stmt->bindParam(":student_id", $student_id);
        $stmt->bindParam(":test_key", $test_key);
        $stmt->bindParam(":start_time", $start_time);
        $stmt->execute();
    }

    public function insertStudentAnswer($student_id, $test_key, $question_id, $answer_id)
    {
        $stmt = $this->conn->prepare("INSERT IGNORE INTO student_answers (student_id, test_key, question_id, answer_id) VALUES (:student_id, :test_key, :question_id, :answer_id)");
        $stmt->bindParam(":student_id", $student_id);
        $stmt->bindParam(":test_key", $test_key);
        $stmt->bindParam(":question_id", $question_id);
        $stmt->bindParam(":answer_id", $answer_id);
        $stmt->execute();
    }

    public function insertStudentOpenAnswer($student_id, $test_key, $question_id, $answer)
    {
        $stmt = $this->conn->prepare("INSERT IGNORE INTO student_answers (student_id, test_key, question_id, answer) VALUES (:student_id, :test_key, :question_id, :answer)");
        $stmt->bindParam(":student_id", $student_id);
        $stmt->bindParam(":test_key", $test_key);
        $stmt->bindParam(":question_id", $question_id);
        $stmt->bindParam(":answer", $answer);
        $stmt->execute();
    }

    public function insertStudentFileAnswer($student_id, $test_key, $question_id, $file)
    {
        $stmt = $this->conn->prepare("INSERT IGNORE INTO student_answers (student_id, test_key, question_id, file) VALUES (:student_id, :test_key, :question_id, :file)");
        $stmt->bindParam(":student_id", $student_id);
        $stmt->bindParam(":test_key", $test_key);
        $stmt->bindParam(":question_id", $question_id);
        $stmt->bindParam(":file", $file);
        $stmt->execute();
    }

    public function insertStudentConnectAnswer($student_id, $test_key, $question_id, $connect_answer)
    {
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