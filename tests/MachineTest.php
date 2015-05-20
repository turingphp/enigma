<?php

namespace TuringPHP\Enigma\Tests;

use TuringPHP\Enigma\Machine;
use TuringPHP\Enigma\Plugboard;
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
                    "DMTWSILRUYQNKFEJCAZBPGXOHV",
                    0
                ),
                new Rotor(
                    "ABCDEFGHIJKLMNOPQRSTUVWXYZ",
                    "HQZGPJTMOBLNCIFDYAWVEUSRKX",
                    0
                ),
                new Rotor(
                    "ABCDEFGHIJKLMNOPQRSTUVWXYZ",
                    "UQNTLSZFMREHDPXKIBVYGJCWOA",
                    0
                )
            ],
            new Plugboard([
                ["I", "J"],
                ["K", "L"],
                ["M", "N"],
            ])
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
        // ...X Y Z A B C D... (starting letter)
        //          ↕
        // ...H V D M T W S... (first rotor)
        //          ↕
        // ...B L N C I F D... (second rotor)
        //          ↕
        // ...A U Q N T L S... (third rotor)
        //          ↕
        //      N → M          (plugboard)
        //          ↕
        //          M          (ending letter)

        $this->assertEquals(
            "M", $this->machine->follow("A")
        );

        // ...X Y Z A B C D... (starting letter)
        //          ↕
        // ...V D M T W S I... (first rotor)
        //          ↕
        // ...Y A W V E U S... (second rotor)
        //          ↕
        // ...V Y G J C W O... (third rotor)
        //          ↕
        //      J → I          (plugboard)
        //          ↕
        //          I          (ending letter)

        $this->assertEquals(
            "I", $this->machine->follow("A")
        );

        for ($i = 0; $i < 24; $i++) {
            $this->machine->follow("A");
        }

        // ...X Y Z A B C D... (starting letter)
        //          ↕
        // ...H V D M T W S... (first rotor)
        //          ↕
        // ...L N C I F D Y... (second rotor)
        //          ↕
        // ...S Z F M R E H... (third rotor)
        //          ↕
        //      M → N          (plugboard)
        //          ↕
        //          N          (ending letter)

        $this->assertEquals(
            "N", $this->machine->follow("A")
        );
    }

    /**
     * @test
     */
    public function followWithoutPlugboard() {
        $machine = new Machine(
            [
                new Rotor(
                    "ABC",
                    "CBA",
                    0
                )
            ]
        );

        $this->assertEquals(
            "B", $machine->follow("A")
        );

        $this->assertEquals(
            "A", $machine->follow("A")
        );

        $this->assertEquals(
            "C", $machine->follow("A")
        );
    }
}
