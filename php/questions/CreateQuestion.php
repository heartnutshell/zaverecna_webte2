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

    /**
     * Open Question
     */
    public function createOpen($question, $answer, $points)
    {
        $correctAnswer = [];

        $words = explode(" ", $answer[0]["value"]);
        foreach ($words as $word) {
            array_push($correctAnswer, $word);
        }
        // print_r($correctAnswer);
        $correctAnswerJSON = json_encode($correctAnswer);
        $this->conn->insertQuestion($this->test_key, "open", $question, $correctAnswerJSON, $points);
    }

    /**
     * Choose / Select Question
     */
    public function createChoose($question, $options, $points)
    {
        $correctAnswers = [];
        // Make JSON from $options
        foreach ($options as $answer) {
            $correctAnswers[$answer["value"]] = $answer["selectCorrect"];
        }

        $correctAnswersJSON = json_encode($correctAnswers);

        $this->conn->insertQuestion($this->test_key, "choose", $question, $correctAnswersJSON, $points);
    }

    /**
     * Connect / Pair Question
     */
    public function createConnect($question, $pairs, $points)
    {
        $correctPairs = [];
        for ($i = 0; $i < count($pairs); $i += 2) {
            if ($pairs[$i]["pairIndex"] == $pairs[$i + 1]["pairIndex"])
                $correctPairs[$pairs[$i]["value"]] = $pairs[$i + 1]["value"];
        }

        $correctPairsJSON = json_encode($correctPairs);
        $this->conn->insertQuestion($this->test_key, "connect", $question, $correctPairsJSON, $points);
    }

    public function createDraw($question, $points)
    {
        $this->conn->insertQuestion($this->test_key, "draw", $question, null, $points);
    }

    public function createMath($question, $points)
    {
        $this->conn->insertQuestion($this->test_key, "math", $question, null, $points);
    }
}