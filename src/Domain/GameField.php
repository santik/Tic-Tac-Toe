<?php

declare (strict_types = 1);

namespace Santik\TicTacToe\Domain;

use Symfony\Component\HttpFoundation\Request;
use Webmozart\Assert\Assert;

class GameField
{
    private $gameField;

    public function __construct(array $gameField)
    {
        self::guardGameField($gameField);

        $this->gameField = $gameField;
    }

    public static function createFromRequest(Request $request)
    {
        $gameFieldArray = json_decode($request->getContent());
        return new GameField($gameFieldArray);
    }

    private static function guardGameField(array $gameFieldArray)
    {
        Assert::eq(3,count($gameFieldArray));

        foreach ($gameFieldArray as $row) {
            Assert::isArray($row);
            Assert::eq(3,count($row));

            foreach ($row as $value) {
                Assert::oneOf($value, ['','x','o']);
            }
        }
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->gameField;
    }
}