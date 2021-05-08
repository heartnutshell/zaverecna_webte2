
<?php

require_once __DIR__ ."/Database.php";

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
        $stmt = $this->conn->prepare("SELECT * FROM teacher WHERE email LIKE :username");
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getStudentByID($id): array
    {
        $stmt = $this->conn->prepare("SELECT * FROM student WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $result = $stmt->execute();
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

    public function getAllCompletedTests(): array
    {
        $stmt = $this->conn->prepare("SELECT * FROM completed_tests");
        $stmt->execute();
        return $stmt->fetchAll();
    }


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

    public function updateCompletedTestPoints($test_key, $student_id, $points){
        $stmt = $this->conn->prepare("UPDATE completed_tests SET points=:points WHERE test_key LIKE :test_key AND student_id LIKE :student_id");
        $stmt->bindParam(":points", $points);
        $stmt->bindParam(":test_key", $test_key);
        $stmt->bindParam(":student_id", $student_id);
        $stmt->execute();
    }

    public function updateStudentAnswerToCorrect($id, $is_correct){
        $stmt = $this->conn->prepare("UPDATE student_answers SET is_correct=:is_correct WHERE id LIKE :id");
        $stmt->bindParam(":is_correct", $is_correct);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }

    // INSERT
    public function insertStudent($id, $name, $surname){
        $stmt = $this->conn->prepare("INSERT IGNORE INTO student (id, name, surname) VALUES (:id, :name, :surname)");
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":surname", $surname);
        $stmt->execute();
    }

    public function insertTeacherWithName($email, $password, $name, $surname){
        $stmt = $this->conn->prepare("INSERT IGNORE INTO teacher (email, password, name, surname) VALUES (:email, :password, :name, :surname)");
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":surname", $surname);
        $stmt->execute();
    }

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

    public function insertStudentVisibility($student_id, $test_key, $visibility){
        $stmt = $this->conn->prepare("INSERT IGNORE INTO student_visibility (test_key, student_id, visibility) VALUES (:test_key, :student_id, :visibility )");
        $stmt->bindParam(":student_id", $student_id);
        $stmt->bindParam(":test_key", $test_key);
        $stmt->bindParam(":visibility ", $visibility );
        $stmt->execute();
    }
    
    public function getStudentsVisibility($test_key){
        $stmt = $this->conn->prepare("SELECT * FROM student_visibility WHERE test_key = :test_key");
        $stmt->bindParam(":test_key", $test_key);
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
