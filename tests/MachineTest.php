<?php

namespace TuringPHP\Enigma\Tests;

use TuringPHP\Enigma\Machine;
use TuringPHP\Enigma\Reflector;
use TuringPHP\Enigma\Rotor;

/**
 * @covers TuringPHP\Enigma\Machine
 */
class MachineTest extends Test
{
    /**
     * @var Machine
     */
    protected $machine;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->machine = new Machine(
            [
                new Rotor(
                    "ABCDEFGHIJKLMNOPQRSTUVWXYZ",
                    "EKMFLGDQVZNTOWYHXUSPAIBRCJ",
                    0
                ),
                new Rotor(
                    "ABCDEFGHIJKLMNOPQRSTUVWXYZ",
                    "AJDKSIRUXBLHWTMCQGZNPYFVOE",
                    0
                ),
                new Rotor(
                    "ABCDEFGHIJKLMNOPQRSTUVWXYZ",
                    "BDFHJLCPRTXVZNYEIWGAKMUSQO",
                    0
                )
            ],
            new Reflector(
                "ABCDEFGHIJKLMNOPQRSTUVWXYZ",
                "FVPJIAOYEDRZXWGCTKUQSBNMHL"
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        $this->machine = null;
    }

    /**
     * @test
     */
    public function follow()
    {
        $this->assertEquals(
            "O", $this->machine->setRotorPositions([-12, 0, 0])->translate("A")
        );

        $this->assertEquals(
            "A", $this->machine->setRotorPositions([-12, 0, 0])->translate("O")
        );

        $this->assertEquals(
            "T", $this->machine->setRotorPositions([0, 0, 0])->translate("A")
        );

        $this->assertEquals(
            "A", $this->machine->setRotorPositions([0, 0, 0])->translate("T")
        );

        $this->assertEquals(
            "Z", $this->machine->setRotorPositions([12, 0, 0])->translate("A")
        );

        $this->assertEquals(
            "A", $this->machine->setRotorPositions([12, 0, 0])->translate("Z")
        );

        $this->assertEquals(
            "K", $this->machine->setRotorPositions([24, 0, 0])->translate("A")
        );

        $this->assertEquals(
            "A", $this->machine->setRotorPositions([24, 0, 0])->translate("K")
        );
    }
}
