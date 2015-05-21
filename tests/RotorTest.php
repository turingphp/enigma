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
            "EKMFLGDQVZNTOWYHXUSPAIBRCJ",
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
     * @covers TuringPHP\Enigma\Rotor::forward
     * @covers TuringPHP\Enigma\Rotor::backward
     * @covers TuringPHP\Enigma\Rotor::setPosition
     * @covers TuringPHP\Enigma\Rotor::stepPosition
     */
    public function forwardAndBackwardAndStepPosition()
    {
        $this->rotor->stepPosition();

        $this->assertEquals(
            "K", $this->rotor->forward("A")
        );

        $this->assertEquals(
            "A", $this->rotor->backward("K")
        );

        for ($i = 0; $i < 30; $i++) {
            $this->rotor->stepPosition();
        }

        $this->assertEquals(
            "G", $this->rotor->forward("A")
        );

        $this->rotor->setPosition(-13);

        $this->assertEquals(
            "W", $this->rotor->forward("A")
        );

        $this->rotor->setPosition(39);

        $this->assertEquals(
            "W", $this->rotor->forward("A")
        );
    }

    /**
     * @test
     */
    public function getPosition() {
        $this->assertEquals(
            0, $this->rotor->getPosition()
        );
    }

    /**
     * @test
     *
     * @covers TuringPHP\Enigma\Rotor::setPosition
     */
    public function setPosition() {
        $this->rotor->setPosition(13);

        $this->assertEquals(
            13, $this->rotor->getPosition()
        );
    }

    /**
     * @test
     *
     * @covers TuringPHP\Enigma\Rotor::shouldStepNextRotor
     */
    public function shouldStepNextRotor()
    {
        $this->rotor->setPosition(25);

        $this->assertTrue(
            $this->rotor->shouldStepNextRotor()
        );

        $this->assertFalse(
            $this->rotor->stepPosition()->shouldStepNextRotor()
        );
    }
}
