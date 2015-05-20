<?php

namespace TuringPHP\Enigma\Tests;

use TuringPHP\Enigma\Plugboard;

/**
 * @covers TuringPHP\Enigma\Plugboard
 */
class PlugboardTest extends Test
{
    /**
     * @var Plugboard
     */
    protected $plugboard;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->plugboard = new Plugboard([
            ["A", "B"],
            ["C", "D"],
            ["E", "F"],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        $this->plugboard = null;
    }

    /**
     * @test
     */
    public function follow()
    {
        $this->assertEquals(
            "B", $this->plugboard->follow("A")
        );

        $this->assertEquals(
            "C", $this->plugboard->follow("D")
        );

        $this->assertEquals(
            "F", $this->plugboard->follow("E")
        );

        // ...return the letter if not in a pair

        $this->assertEquals(
            "G", $this->plugboard->follow("G")
        );
    }
}
