<?php

namespace GameReplays\Color;

abstract class Color
{
    /**
     * Normalizes the given value between 0 and 1, based on the ratio between the given value and expected maximum value
     * @param numeric $value
     * @param numeric $upperBound
     * @return numeric
     */
    protected function normalize($value, $upperBound)
    {
        return $this->clamp($value / $upperBound, 0, 1);
    }
}

