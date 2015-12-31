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
    public function test_converts_hsv_to_rgba($expected, $actual)
    {
        $this->assertSame($expected->toString(), $actual->toString());
    }

    public function rgbConversionProvider()
    {
        $hsvRed = new HSV(360, 1, 1, 1);
        $hsvGreen = new HSV(120, 1, 1, 1);
        $hsvBlue = new HSV(240, 1, 1, 1);
        $hsvWhite = new HSV(360, 0, 1, 1);
        $hsvBlack = new HSV(360, 0, 0, 1);
        $hsvCyan = new HSV(175, 1, 1, 1);

        $rgbRed = new RGB(255, 0, 0, 1);
        $rgbGreen = new RGB(0, 255, 0, 1);
        $rgbBlue = new RGB(0, 0, 255, 1);
        $rgbWhite = new RGB(255, 255, 255, 1);
        $rgbBlack = new RGB(0, 0, 0, 1);
        $rgbCyan = new RGB(0, 255, 234, 1);

        // Act
        return [
            [ $rgbRed, $hsvRed->toRGBA() ],
            [ $rgbGreen, $hsvGreen->toRGBA() ],
            [ $rgbBlue, $hsvBlue->toRGBA() ],
            [ $rgbWhite, $hsvWhite->toRGBA() ],
            [ $rgbBlack, $hsvBlack->toRGBA() ],
            [ $rgbCyan, $hsvCyan->toRGBA() ]
        ];
    }
}
