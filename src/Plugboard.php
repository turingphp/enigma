<?php

namespace TuringPHP\Enigma;

class Plugboard
{
    /**
     * @var array
     */
    protected $pairs;

    /**
     * @param array $pairs
     */
    public function __construct(array $pairs)
    {
        $this->pairs = $pairs;
    }

    /**
     * @param string $letter
     *
     * @return string
     */
    public function follow($letter)
    {
        foreach ($this->pairs as $pair) {
            if ($pair[0] === $letter) {
                return $pair[1];
            }

            if ($pair[1] === $letter) {
                return $pair[0];
            }
        }

        return $letter;
    }
}
