<?php

namespace GameReplays\Color;

use function GameReplays\Functions\clamp;

abstract class Color
{
    protected $a = 1;

    /**
     * Sets the alpha channel of the color
     * Use a normalized value between 0 and 1,
     * where 1 is 100% opaque and 0 is transparent
     * @param int|float $alpha
     */
    protected function setAlpha($alpha)
    {
        $this->a = clamp($alpha, 0, 1);
    }

    /**
     * return float|int
     */
    public function a()
    {
        return $this->a;
    }

    /**
     * @return string
     */
    abstract public function toJson();

    /**
     * @return array
     */
    abstract public function toArray();

    /**
     * @return string
     */
    abstract public function toString();
}

