<?php

namespace TuringPHP\Enigma;

class Machine
{
    /**
     * @var array
     */
    protected $rotors;

    /**
     * @var null|Plugboard
     */
    protected $plugboard;

    /**
     * @param array          $rotors
     * @param null|Plugboard $plugboard
     */
    public function __construct(array $rotors, Plugboard $plugboard = null)
    {
        $this->rotors = $rotors;
        $this->plugboard = $plugboard;
    }

    /**
     * @param string $letter
     *
     * @return string
     */
    public function follow($letter)
    {
        foreach ($this->rotors as $i => $rotor) {
            /**
             * @var Rotor $rotor
             */
            if ($rotor->shouldAdjustNextRotor() and $this->hasNextRotor($i)) {
                $this->adjustNextRotor($i);
            }

            $letter = $this->followRotor($letter, $i, $rotor);
        }

        if ($this->plugboard !== null) {
            return $this->plugboard->follow($letter);
        }

        return $letter;
    }

    /**
     * @param int $index
     *
     * @return bool
     */
    protected function hasNextRotor($index)
    {
        return isset($this->rotors[$index + 1]);
    }

    /**
     * @param int $index
     */
    protected function adjustNextRotor($index)
    {
        /**
         * @var Rotor $nextRotor
         */
        $nextRotor = $this->rotors[$index + 1];

        $this->rotors[$index + 1] = $nextRotor->withAdjustedPosition();
    }

    /**
     * @param string $letter
     * @param int    $index
     * @param Rotor  $rotor
     *
     * @return array
     */
    protected function followRotor($letter, $index, Rotor $rotor)
    {
        if ($index > 0) {
            return $rotor->follow($letter);
        }

        $rotor = $rotor->withAdjustedPosition();

        $this->rotors[$index] = $rotor;

        return $rotor->follow($letter);
    }
}
