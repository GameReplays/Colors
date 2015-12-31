<?php

namespace GameReplays\Color\Formats;

use GameReplays\Color\Color;
use function GameReplays\Functions\clamp;

final class RGBA extends Color
{
    private $r = 0;
    private $g = 0;
    private $b = 0;
    private $a = 1;

    public function __construct($r, $g, $b, $a)
    {
        $this->r = clamp($r, 0, 255);
        $this->g = clamp($g, 0, 255);
        $this->b = clamp($b, 0, 255);
        $this->a = clamp($a, 0, 1);
    }

    /**
     * @return int|float
     */
    public function r()
    {
        return $this->r;
    }

    /**
     * @return int|float
     */
    public function g()
    {
        return $this->g;
    }

    /**
     * @return int|float
     */
    public function b()
    {
        return $this->b;
    }

    /**
     * @return int|float
     */
    public function a()
    {
        return $this->a;
    }

    /**
     * @return string
     */
    public function toString()
    {
        return vsprintf('rgba(%d, %d, %d, %s', $this->toArray());
    }

    /**
     * @return string
     */
    public function toJSON()
    {
        return json_encode($this->toArray());
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'r' => $this->r,
            'g' => $this->g,
            'b' => $this->b,
            'a' => $this->a
        ];
    }
}
