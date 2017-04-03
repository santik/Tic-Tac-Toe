<?php

namespace Santik\TicTacToe\Domain;


class FirstEmptyMoveDeciderTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldImplementMoveDeciderInterface()
    {
        $decider = new FirstEmptyMoveDecider();

        $this->assertInstanceOf(MoveDecider::class, $decider);
    }

    public function testValidGameFieldPassed_CoordinatesForEmptyPlaceShouldBeReturned()
    {
        $array = [
            ['x', 'x', 'o'],
            ['o', 'x', 'o'],
            ['o', '', ''],
        ];

        $gameField = new GameField($array);
        $decider = new FirstEmptyMoveDecider();

        $coordinates = $decider->decide($gameField);

        $this->assertEquals($array[$coordinates->x()][$coordinates->y()], '');
    }

    public function testGameWithoutEmptyPlacvePassed_ExceptionShouldBeRaised()
    {
        $array = [
            ['x', 'x', 'o'],
            ['o', 'x', 'o'],
            ['o', 'o', 'o'],
        ];

        $gameField = new GameField($array);
        $decider = new FirstEmptyMoveDecider();

        $this->expectExceptionCode(400);

        $decider->decide($gameField);
    }
}
