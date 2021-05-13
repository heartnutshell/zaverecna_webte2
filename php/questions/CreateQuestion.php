<?php

require_once __DIR__ . "/../database/DatabaseController.php";

class CreateQuestion
{

    private $test_key;
    private $conn;

    function __construct($test_key)
    {
        $this->test_key = $test_key;
        $this->conn = new DatabaseController();
    }

    public function createOpen($type, $question, $answer, $point)
    {
        $this->conn->insertQuestion($this->test_key, $type, $question, $point, $answer);
    }

    public function createSelect($question, $options)
    {
        //TODO
    }

    public function createConnect($question, $optionsA, $optionsB)
    {
        //TODO
    }

    public function createDraw($question)
    {
        //TODO
    }

    public function createMath($question)
    {
        //TODO
    }
}