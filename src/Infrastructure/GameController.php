<?php

declare (strict_types = 1);

namespace Santik\TicTacToe\Infrastructure;

use Santik\TicTacToe\Domain\GameField;
use Santik\TicTacToe\Domain\GameService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class GameController
{

    /**
     * @var GameService
     */
    private $gameService;

    public function __construct(GameService $gameService)
    {
        $this->gameService = $gameService;
    }

    public function checkStatus(Request $request): Response
    {
        return new JsonResponse(
            json_encode($this->gameService->checkStatus($this->createGameFieldFromRequest($request))),
            200,
            [],
            true
        );
    }

    private function createGameFieldFromRequest(Request $request): GameField
    {
        return GameField::createFromRequest($request);
    }


    public function makeMove(Request $request): Response
    {
        $newField = $this->gameService->makeMoveNormalized($this->createGameFieldFromRequest($request));

        return new JsonResponse(
            json_encode($newField->toArray()),
            200,
            [],
            true
        );
    }

}
