<?php

use GameReplays\Color\Color;
use GameReplays\Color\Formats\RGB;

class RGBTest extends PHPUnit_Framework_TestCase
{
    public function test_format_is_instance_of_color()
    {
        // Arrange
        $expected = Color::class;

        // Act
        $rgba = new RGB(0, 0, 0, 0);

        // Assert
        $this->assertInstanceOf($expected, $rgba);
    }

    public function test_construction_clamps_all_channels_to_0()
    {
        // Arrange
        $rgba = new RGB(-1, -1, -1, -1);
        $expected = 0;

        // Act
        $actualR = $rgba->r();
        $actualG = $rgba->g();
        $actualB = $rgba->b();
        $actualA = $rgba->a();

        // Assert
        $this->assertSame($expected, $actualR);
        $this->assertSame($expected, $actualG);
        $this->assertSame($expected, $actualB);
        $this->assertSame($expected, $actualA);
    }

    public function test_construction_rounds_color_channels_down_to_nearest_int()
    {
        // Arrange
        $rgba = new RGB(10.1, 10.1, 10.1, 0);
        $expected = 10;

        // Act
        $actualR = $rgba->r();
        $actualG = $rgba->g();
        $actualB = $rgba->b();

        // Assert
        $this->assertSame($expected, $actualR);
        $this->assertSame($expected, $actualG);
        $this->assertSame($expected, $actualB);
    }

    public function test_construction_rounds_color_channels_up_to_nearest_int()
    {
        // Arrange
        $rgba = new RGB(10.5, 10.5, 10.5, 0);
        $expected = 11;

        // Act
        $actualR = $rgba->r();
        $actualG = $rgba->g();
        $actualB = $rgba->b();

        // Assert
        $this->assertSame($expected, $actualR);
        $this->assertSame($expected, $actualG);
        $this->assertSame($expected, $actualB);
    }

    public function test_construction_clamps_color_channels_to_255()
    {
        // Arrange
        $rgba = new RGB(600, 600, 600, 0);
        $expected = 255;

        // Act
        $actualR = $rgba->r();
        $actualG = $rgba->g();
        $actualB = $rgba->b();

        // Assert
        $this->assertSame($expected, $actualR);
        $this->assertSame($expected, $actualG);
        $this->assertSame($expected, $actualB);
    }

    public function test_construction_clamps_alpha_to_1()
    {
        // Arrange
        $rgba = new RGB(0, 0, 0, 5);
        $expected = 1;

        // Act
        $actual = $rgba->a();

        // Assert
        $this->assertSame($expected, $actual);
    }

    public function test_returns_array()
    {
        // Arrange
        $rgba = new RGB(100, 100, 100, 1);
        $expected = [
            'r' => 100,
            'g' => 100,
            'b' => 100,
            'a' => 1
        ];

        // Act
        $actual = $rgba->toArray();

        // Assert
        $this->assertSame($expected, $actual);
    }

    public function test_returns_json()
    {
        // Arrange
        $rgba = new RGB(100, 100, 100, 1);
        $expected = json_encode([
            'r' => 100,
            'g' => 100,
            'b' => 100,
            'a' => 1
        ]);

        // Act
        $actual = $rgba->toJson();

        // Assert
        $this->assertSame($expected, $actual);
    }

    public function test_explicitly_returns_string()
    {
        // Arrange
        $rgba = new RGB(100, 100, 100, 0.5);
        $expected = 'rgba(100, 100, 100, 0.5)';

        // Act
        $actual = $rgba->toString();

        // Assert
        $this->assertSame($expected, $actual);
    }

    public function test_casts_to_string()
    {
        // Arrange
        $rgba = new RGB(100, 100, 100, 0.5);
        $expected = 'rgba(100, 100, 100, 0.5)';

        // Act
        $actual = (string)$rgba;

        // Assert
        $this->assertSame($expected, $actual);
    }
}
