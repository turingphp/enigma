<?php

namespace TuringPHP\Enigma;

class Rotor
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
     * @var int
     */
    protected $position;

    /**
     * @param string $fromLetters
     * @param string $toLetters
     * @param int    $position
     */
    public function __construct($fromLetters, $toLetters, $position)
    {
        $this->fromLetters = $fromLetters;
        $this->toLetters = $toLetters;
        $this->position = $position;
    }

    /**
     * @return $this
     */
    public function stepPosition()
    {
        $this->position += 1;

        $this->limitPosition();

        return $this;
    }

    /**
     * @return $this
     */
    protected function limitPosition()
    {
        while ($this->position >= strlen($this->fromLetters)) {
            $this->position -= strlen($this->fromLetters);
        }

        while ($this->position <= -1) {
            $this->position += strlen($this->fromLetters);
        }

        return $this;
    }

    /**
     * @param string $letter
     *
     * @return string
     */
    public function forward($letter)
    {
        $this->limitPosition();

        $letters = $this->adjustedLetters();

        $index = stripos($this->fromLetters, $letter);

        return $letters[$index];
    }

    /**
     * @return string
     */
    protected function adjustedLetters()
    {
        $letters = $this->toLetters;
        $position = $this->getPosition();

        return substr($letters, $position) . substr($letters, 0, $position);
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param int $position
     *
     * @return $this
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * @return bool
     */
    public function shouldStepNextRotor()
    {
        return $this->getPosition() === strlen($this->fromLetters) - 1;
    }

    /**
     * @param string $letter
     *
     * @return string
     */
    public function backward($letter)
    {
        $this->limitPosition();

        $letters = $this->adjustedLetters();

        $index = stripos($letters, $letter);

        return $this->fromLetters[$index];
    }
}
