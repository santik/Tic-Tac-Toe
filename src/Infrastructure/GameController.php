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

    /**
     * @var \Twig_Environment
     */
    private $twig;

    public function __construct(GameService $gameService, \Twig_Environment $twig)
    {
        $this->gameService = $gameService;
        $this->twig = $twig;
    }

    public function index()
    {
        return $this->twig->render('index.twig');
    }

    public function checkStatus(Request $request): Response
    {
        return new JsonResponse(
            json_encode($this->gameService->checkStatus(GameField::createFromRequest($request))),
            200,
            [],
            true
        );
    }

    public function makeMove(Request $request): Response
    {
        $game = $this->gameService->makeMoveNormalized(GameField::createFromRequest($request));

        return new JsonResponse(
            json_encode($game->toArray()),
            200,
            [],
            true
        );
    }
}
