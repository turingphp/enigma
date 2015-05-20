<?php

namespace TuringPHP\Enigma\Tests;

use TuringPHP\Enigma\Rotor;

/**
 * @covers TuringPHP\Enigma\Rotor
 */
class RotorTest extends Test
{
    /**
     * @var Rotor
     */
    protected $rotor;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->rotor = new Rotor(
            "ABCDEFGHIJKLMNOPQRSTUVWXYZ",
            "DMTWSILRUYQNKFEJCAZBPGXOHV",
            0
        );
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        $this->rotor = null;
    }

    /**
     * @test
     *
     * @covers TuringPHP\Enigma\Rotor::follow
     */
    public function follow()
    {
        $rotor = $this->rotor;

        $rotor = $rotor->withAdjustedPosition();

        $this->assertEquals(
            "M", $rotor->follow("A")
        );

        $rotor = $rotor->withAdjustedPosition();

        $this->assertEquals(
            "T", $rotor->follow("A")
        );

        // D M T W S I...
        //      ↑

        for ($i = 0; $i < 49; $i++) {
            $rotor = $rotor->withAdjustedPosition();
        }

        // ...P G X O H V
        //             ↑

        $rotor = $rotor->withAdjustedPosition();

        $this->assertEquals(
            "D", $rotor->follow("A")
        );
    }

    /**
     * @test
     */
    public function position() {
        $this->assertEquals(
            0, $this->rotor->position()
        );
    }

    /**
     * @test
     *
     * @covers TuringPHP\Enigma\Rotor::withPosition
     */
    public function withPosition() {
        $rotor = $this->rotor->withPosition(1);

        $this->assertInstanceOf(
            get_class($this->rotor), $rotor
        );

        $this->assertNotSame(
            $this->rotor, $rotor
        );

        $this->assertEquals(
            1, $rotor->position()
        );
    }

    /**
     * @test
     *
     * @covers TuringPHP\Enigma\Rotor::shouldAdjustNextRotor
     */
    public function shouldAdjustNextRotor()
    {
        $rotor = $this->rotor->withPosition(25);

        $this->assertTrue(
            $rotor->shouldAdjustNextRotor()
        );

        $rotor = $rotor->withAdjustedPosition();

        $this->assertFalse(
            $rotor->shouldAdjustNextRotor()
        );
    }
}
