<?php

namespace Santik\TicTacToe\Domain;

use Santik\TicTacToe\External\MoveInterface;

class GameService implements MoveInterface
{

    /**
     * @var MoveDecider
     */
    private $moveDecider;

    public function __construct(MoveDecider $moveDecider)
    {
        $this->moveDecider = $moveDecider;
    }

    public function checkStatus(GameField $gameField)
    {
        if (
            $this->horizontalMatch($gameField) ||
            $this->verticalMatch($gameField) ||
            $this->diaogonalMatch($gameField)
        ) {
            return true;
        }

        return false;
    }

    private function horizontalMatch(GameField $gameField)
    {
        foreach ($gameField->toArray() as $row) {
            if ($row[0] == $row[1] && $row[0] == $row[2] && $row[0] != '') {
                return true;
            }
        }

        return false;
    }

    private function verticalMatch(GameField $gameField)
    {
        $gameField = $gameField->toArray();

        for ($i = 0; $i <= 2; $i ++) {
            if ($gameField[0][$i] == $gameField[1][$i] && $gameField[0][$i] == $gameField[2][$i] && $gameField[2][$i] != '') {
                return true;
            }
        }

        return false;
    }

    private function diaogonalMatch(GameField $gameField)
    {
        $gameField = $gameField->toArray();

        if ($gameField[0][0] == $gameField[1][1] && $gameField[2][2] == $gameField[1][1] && $gameField[1][1] != '') {
            return true;
        }

        if ($gameField[2][0] == $gameField[1][1] && $gameField[0][2] == $gameField[1][1] && $gameField[1][1] != '') {
            return true;
        }

        return false;
    }

    public function makeMoveNormalized(GameField $gameField, $playerUnit = 'x'): GameField
    {
        $coordinates = $this->moveDecider->decide($gameField);
        $gameFieldArray = $gameField->toArray();
        $gameFieldArray[$coordinates->x()][$coordinates->y()] = $playerUnit;

        $gameField = new GameField($gameFieldArray);

        return $gameField;
    }

    /**
     * @deprecated use makeMoveNormalized
     */
    public function makeMove($boardState, $playerUnit = 'X')
    {
        throw new \Exception('Use makeMoveNormalized');
    }
}