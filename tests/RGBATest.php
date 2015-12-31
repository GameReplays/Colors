<?php

use GameReplays\Color\Formats\RGBA;

class RGBATest extends PHPUnit_Framework_TestCase
{
    public function test_construction_clamps_all_channels_to_0()
    {
        $rgba = new RGBA(-1, -1, -1, -1);

        $this->assertSame($rgba->r(), 0);
        $this->assertSame($rgba->g(), 0);
        $this->assertSame($rgba->b(), 0);
        $this->assertSame($rgba->a(), 0);
    }

    public function test_construction_clamps_color_channels_to_255()
    {
        $rgba = new RGBA(600, 600, 600, 0);

        $this->assertSame($rgba->r(), 255);
        $this->assertSame($rgba->g(), 255);
        $this->assertSame($rgba->b(), 255);
    }

    public function test_construction_clamps_alpha_to_1()
    {
        $rgba = new RGBA(0, 0, 0, 5);

        $this->assertSame($rgba->a(), 1);
    }
}
