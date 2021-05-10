<?php

class CreateQuestion
{

    private $test_key;

    function __construct($test_key)
    {
        $this->test_key = $test_key;
    }

    public function createSelect($question, $options)
    {
        //TODO
    }

    public function createText($question)
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

    public function createEquation($question)
    {
        //TODO
    }
}