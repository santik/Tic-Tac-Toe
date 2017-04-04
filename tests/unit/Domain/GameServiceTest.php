<?php

declare(strict_types=1);

namespace Santik\TicTacToe\Domain;

use PHPUnit\Framework\TestCase;
use Santik\TicTacToe\External\MoveInterface;

class GameServiceTest extends TestCase
{
    /**
     * @var GameService
     */
    private $service;

    public function setUp()
    {
        $decider = $this->prophesize(MoveDecider::class);
        $this->service = new GameService($decider->reveal());
    }

    public function testShouldImplementExternalMoveInterface()
    {
        $this->assertInstanceOf(MoveInterface::class, $this->service);
    }

    public function testCheckStatusWithNoWinningGame_ShouldReturnFalse()
    {
        $array = [
            ['x', 'x', 'o'],
            ['o', 'x', 'o'],
            ['o', '', ''],
        ];

        $gameField = new GameField($array);

        $this->assertFalse($this->service->checkStatus($gameField));
    }

    public function testCheckStatusWithHorizontalWinningGame_ShouldReturnTrue()
    {
        $array = [
            ['x', 'x', 'x'],
            ['o', 'x', 'o'],
            ['o', '', ''],
        ];

        $gameField = new GameField($array);

        $this->assertTrue($this->service->checkStatus($gameField));
    }

    public function testCheckStatusWithVerticalWinningGame_ShouldReturnTrue()
    {
        $array = [
            ['o', 'x', ''],
            ['x', 'x', 'o'],
            ['x', 'x', ''],
        ];

        $gameField = new GameField($array);

        $this->assertTrue($this->service->checkStatus($gameField));
    }

    public function testCheckStatusWithDiogonalWinningGame_ShouldReturnTrue()
    {
        $array = [
            ['o', 'x', 'x'],
            ['x', 'x', 'o'],
            ['x', 'o', ''],
        ];

        $gameField = new GameField($array);

        $this->assertTrue($this->service->checkStatus($gameField));
    }

    public function testCheckStatusWithEmptyGame_ShouldReturnFalse()
    {
        $array = [
            ['', '', ''],
            ['', '', ''],
            ['', '', ''],
        ];

        $gameField = new GameField($array);

        $this->assertFalse($this->service->checkStatus($gameField));
    }
}
