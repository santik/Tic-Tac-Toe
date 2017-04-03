<?php

namespace Santik\TicTacToe\Domain;

interface MoveDecider
{
    public function decide(GameField $gameField): Coordinates;
}