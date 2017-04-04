<?php

namespace Santik\TicTacToe\Domain;

class FirstEmptyMoveDecider implements MoveDecider
{
    //only finds the first empty cell and makes move there
    public function decide(GameField $gameField): Coordinates
    {
        foreach ($gameField->toArray() as $x => $row) {
            foreach ($row as $y => $value) {
                if ($value == '') {
                    return new Coordinates($x, $y);
                }
            }
        }

        throw new \Exception('No place for move.', 400);
    }
}