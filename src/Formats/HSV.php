<?php

namespace GameReplays\Color\Formats;

use GameReplays\Color\Color;
use function GameReplays\Functions\clamp;
use function GameReplays\Functions\normalize;

final class HSV extends Color
{
    private $h = 0;
    private $s = 0;
    private $v = 0; // aka brightness

    public function __construct($h, $s, $v)
    {
        $this->h = $this->clampHue($h);
        $this->s = normalize($s, 100);
        $this->v = normalize($v, 100);
    }

    /**
     * Converts to RGB format
     * Formula from https://en.wikipedia.org/wiki/HSL_and_HSV#From_HSV
     * Floor selector idea from https://www.cs.rit.edu/~ncs/color/t_convert.html
     * Array value lookup idea from https://github.com/bgrins/TinyColor/blob/master/tinycolor.js#L482
     * @param int $a
     * @return array
     */
    public function toRGBA($a = 1)
    {
        $h = $this->h / 60;
        $c = $this->v * $this->s;
        $x = $c * (1 - abs(fmod($h, 2) - 1)); // I am disappointed in you PHP. Took 2 hours to figure out I needed fmod() instead of %...
        $m = $this->v - $c;

        $i = floor($h);

        $r = ([$c, $x, 0, 0, $x, $c][$i] + $m) * 255;
        $g = ([$x, $c, $c, $x, 0, 0][$i] + $m) * 255;
        $b = ([0, 0, $x, $c, $c, $x][$i] + $m) * 255;

        return new RGBA($r, $g, $b, $a);
    }

    /**
     * Clamps the hue between 0 and 360
     * Also forces a hue of 360 to wrap back to 0 since HSV mapping is cylindrical, and 360 is the same as 0;
     * @param $h
     * @return numeric
     */
    private function clampHue($h)
    {
        $h = clamp($h, 0, 360);
        return $h === 360 ? 0 : $h;
    }
}
