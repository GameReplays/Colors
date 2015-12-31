<?php

use GameReplays\Color\Color;
use GameReplays\Color\Formats\HSV;
use GameReplays\Color\Formats\RGB;

class HSVTest extends PHPUnit_Framework_TestCase
{
    public function test_format_instance_of_color()
    {
        // Arrange
        $expected = Color::class;

        // Act
        $hsv = new HSV(0, 0, 0, 0);

        // Assert
        $this->assertInstanceOf($expected, $hsv);
    }

    public function test_construction_clamps_hue_to_0()
    {
        // Arrange
        $hsv = new HSV(-100, 10, 10, 1);
        $expected = 0;

        // Act
        $actual = $hsv->h();

        // Assert
        $this->assertSame($expected, $actual);
    }

    public function test_construction_clamps_hue_to_360_but_wraps_it_back_to_0()
    {
        // Arrange
        $hsv = new HSV(9000, 10, 10, 1);
        $expected = 0;

        // Act
        $actual = $hsv->h();

        // Assert
        $this->assertSame($expected, $actual);
    }

    public function test_construction_wraps_exactly_360_back_to_0()
    {
        // Arrange
        $hsv = new HSV(360, 10, 10, 1);
        $expected = 0;

        // Act
        $actual = $hsv->h();

        // Assert
        $this->assertSame($expected, $actual);
    }

    public function test_construction_clamps_sva_0()
    {
        // Arrange
        $hsv = new HSV(360, -10, -10, -10);
        $expected = 0;

        // Act
        $actualS = $hsv->s();
        $actualV = $hsv->v();
        $actualA = $hsv->a();

        // Assert
        $this->assertSame($expected, $actualS);
        $this->assertSame($expected, $actualV);
        $this->assertSame($expected, $actualA);
    }

    public function test_construction_clamps_hsva_to_1()
    {
        // Arrange
        $hsv = new HSV(360, 1000, 1000, 1000);
        $expected = 1; // clamped to 100, then normalized to 1

        // Act
        $actualS = $hsv->s();
        $actualV = $hsv->v();
        $actualA = $hsv->a();

        // Assert
        $this->assertSame($expected, $actualS);
        $this->assertSame($expected, $actualV);
        $this->assertSame($expected, $actualA);
    }

    /**
     * @dataProvider rgbConversionProvider
     * @param $expected
     * @param $actual
     */
    public function test_converts_hsv_to_rgba($actual, $expected)
    {
        $this->assertSame($expected->toString(), $actual->toRGBA()->toString());
    }

    public function rgbConversionProvider()
    {
        return [
            [ new HSV(360, 1, 1), new RGB(255, 0, 0) ],       // Red
            [ new HSV(120, 1, 1), new RGB(0, 255, 0) ],       // Green
            [ new HSV(240, 1, 1), new RGB(0, 0, 255) ],       // Blue
            [ new HSV(360, 0, 1), new RGB(255, 255, 255) ],   // White
            [ new HSV(360, 0, 0), new RGB(0, 0, 0) ],         // Black
            [ new HSV(175, 1, 1), new RGB(0, 255, 234) ],     // Cyan
            [ new HSV(90, 0.26, 0.65), new RGB(144, 166, 123)]       // Pale Army Green
        ];
    }
}
