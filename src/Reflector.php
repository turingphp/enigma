<?php

namespace TuringPHP\Enigma;

class Reflector
{
    /**
     * @var string
     */
    protected $fromLetters;

    /**
     * @var string
     */
    protected $toLetters;

    /**
     * @param string $fromLetters
     * @param string $toLetters
     */
    public function __construct($fromLetters, $toLetters)
    {
        $this->fromLetters = $fromLetters;
        $this->toLetters = $toLetters;
    }

    /**
     * @param string $letter
     *
     * @return string
     */
    public function swap($letter)
    {
        $index = stripos($this->fromLetters, $letter);

        return $this->toLetters[$index];
    }
}
