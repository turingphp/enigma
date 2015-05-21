<?php

namespace TuringPHP\Enigma\Tests;

use TuringPHP\Enigma\Reflector;

/**
 * @covers TuringPHP\Enigma\Reflector
 */
class ReflectorTest extends Test
{
    /**
     * @var Reflector
     */
    protected $reflector;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->reflector = new Reflector(
            "ABCDEFGHIJKLMNOPQRSTUVWXYZ",
            "FVPJIAOYEDRZXWGCTKUQSBNMHL"
        );
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        $this->reflector = null;
    }

    /**
     * @test
     */
    public function follow()
    {
        $this->assertEquals(
            "F", $this->reflector->swap("A")
        );

        $this->assertEquals(
            "A", $this->reflector->swap("F")
        );

        $this->assertEquals(
            "L", $this->reflector->swap("Z")
        );

        $this->assertEquals(
            "Z", $this->reflector->swap("L")
        );
    }
}
