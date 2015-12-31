<?php

namespace GameReplays\Color\Formats;

use GameReplays\Color\Color;
use function GameReplays\Functions\clamp;
use function GameReplays\Functions\roundInt;

final class RGB extends Color
{
    private $r = 0;
    private $g = 0;
    private $b = 0;

    public function __construct($r, $g, $b, $a = 1)
    {
        $this->r = roundInt(clamp($r, 0, 255));
        $this->g = roundInt(clamp($g, 0, 255));
        $this->b = roundInt(clamp($b, 0, 255));
        $this->setAlpha($a);
    }

    /**
     * @return int
     */
    public function r()
    {
        return $this->r;
    }

    /**
     * @return int
     */
    public function g()
    {
        return $this->g;
    }

    /**
     * @return int
     */
    public function b()
    {
        return $this->b;
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
            'r' => $this->r(),
            'g' => $this->g(),
            'b' => $this->b(),
            'a' => $this->a()
        ];
    }

    /**
     * @return string
     */
    public function toString()
    {
        return vsprintf('rgba(%d, %d, %d, %s)', $this->toArray());
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->toString();
    }
}
