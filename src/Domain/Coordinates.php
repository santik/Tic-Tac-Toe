<?php

namespace Santik\TicTacToe\Domain;

class Coordinates
{
    private $x;
    private $y;

    public function __construct($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * @return mixed
     */
    public function x()
    {
        return $this->x;
    }

    /**
     * @return mixed
     */
    public function y()
    {
        return $this->y;
    }
}