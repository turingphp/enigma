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
     * @return Rotor
     */
    public function withAdjustedPosition()
    {
        $position = $this->position + 1;

        if ($position >= strlen($this->fromLetters)) {
            $position = 0;
        }

        return $this->withPosition($position);
    }

    /**
     * @param int $position
     *
     * @return Rotor
     */
    public function withPosition($position)
    {
        $clone = clone $this;
        $clone->position = $position;

        return $clone;
    }

    /**
     * @param string $letter
     *
     * @return string
     */
    public function follow($letter)
    {
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
        $position = $this->position();

        return substr($letters, $position) . substr($letters, 0, $position);
    }

    /**
     * @return int
     */
    public function position()
    {
        return $this->position;
    }

    /**
     * @return bool
     */
    public function shouldAdjustNextRotor()
    {
        return $this->position() === strlen($this->fromLetters) - 1;
    }
}
