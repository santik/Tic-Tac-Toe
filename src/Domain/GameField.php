<?php

declare (strict_types = 1);

namespace Santik\TicTacToe\Domain;

use Symfony\Component\HttpFoundation\Request;

class GameField
{
    private $gameField;

    public function __construct(array $gameField)
    {
        $this->gameField = $gameField;
    }

    public static function createFromRequest(Request $request)
    {
        $gameFieldArray = json_decode($request->getContent());

        self::guardGameField($gameFieldArray);

        return new GameField($gameFieldArray);
    }

    private static function guardGameField($gameFieldArray)
    {
        //here will be validation and exception on invalid input
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->gameField;
    }
}