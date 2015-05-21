<?php

namespace TuringPHP\Enigma;

class Machine
{
    /**
     * @var Rotor[]
     */
    protected $rotors;

    /**
     * @var Reflector
     */
    protected $reflector;

    /**
     * @param array     $rotors
     * @param Reflector $reflector
     */
    public function __construct(array $rotors, Reflector $reflector)
    {
        $this->rotors = $rotors;
        $this->reflector = $reflector;
    }

    /**
     * @param string $letter
     *
     * @return string
     */
    public function translate($letter)
    {
        $this->adjustRotors();

        foreach ($this->rotors as $i => $rotor) {
            /**
             * @var Rotor $rotor
             */
            $letter = $rotor->forward($letter);
        }

        $letter = $this->reflector->swap($letter);

        foreach (array_reverse($this->rotors) as $rotor) {
            /**
             * @var Rotor $rotor
             */
            $letter = $rotor->backward($letter);
        }

        return $letter;
    }

    /**
     * @return $this
     */
    protected function adjustRotors()
    {
        foreach ($this->rotors as $i => $rotor) {
            if ($i === 0) {
                $this->rotors[0]->stepPosition();
            }

            if ($rotor->shouldStepNextRotor() and isset($this->rotors[$i + 1])) {
                $this->rotors[$i + 1]->stepPosition();
            }
        }

        return $this;
    }

    /**
     * @param array $positions
     *
     * @return $this
     */
    public function setRotorPositions(array $positions)
    {
        foreach ($positions as $i => $position) {
            /**
             * @var Rotor $rotor
             */
            $rotor = $this->rotors[$i];

            $this->rotors[$i] = $rotor->setPosition($position);
        }

        return $this;
    }
}
