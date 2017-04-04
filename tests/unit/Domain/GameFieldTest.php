<?php

namespace Santik\TicTacToe\Domain;

use PHPUnit\Framework\TestCase;

class GameFieldTest extends TestCase
{
    public function testCreateValid()
    {
        $array = [
            ['x', 'x', 'o'],
            ['o', 'x', 'o'],
            ['o', '', ''],
        ];

        new GameField($array);
    }

    public function testCreateInvalidNumberOfRows_ShouldThrowException()
    {
        $array = [
            ['x', 'x', 'o'],
            ['o', 'x', 'o'],
            ['o', '', ''],
            ['o', '', ''],
        ];

        $this->expectException(\Exception::class);

        new GameField($array);
    }

    public function testCreateInvalidNumberOfColumns_ShouldThrowException()
    {
        $array = [
            ['x', 'x', 'o', ''],
            ['o', 'x', 'o'],
            ['o', '', ''],
            ['o', '', ''],
        ];

        $this->expectException(\Exception::class);

        new GameField($array);
    }

    public function testCreateInvalidCharacter_ShouldThrowException()
    {
        $array = [
            ['x', 'x', 'c'],
            ['o', 'x', 'o'],
            ['o', '', ''],
            ['o', '', ''],
        ];

        $this->expectException(\Exception::class);

        new GameField($array);
    }
}
