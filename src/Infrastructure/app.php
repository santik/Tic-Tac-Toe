<?php

declare (strict_types = 1);

namespace InSided\SpamDetection\Infrastructure;

use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use Santik\TicTacToe\Domain\GameService;
use Santik\TicTacToe\Domain\FirstEmptyMoveDecider;
use Santik\TicTacToe\Infrastructure\GameController;
use Silex\Application;
use Silex\Provider\MonologServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\TwigServiceProvider;

$app = new Application();


$app->register(new ServiceControllerServiceProvider());
$app->register(new MonologServiceProvider());

$app->register(new TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../../views',
));

$app['game.move_decider'] = function (){
    return new FirstEmptyMoveDecider();
};

$app['game.service'] = function () use ($app){
    return new GameService($app['game.move_decider']);
};

// Controllers
$app['game.controller'] = function () use ($app) {
    return new GameController($app['game.service'], $app['twig']);
};

// Logging
$app->extend(
    'monolog',
    function (Logger $monolog, Application $app){
        $handler = new RotatingFileHandler(__DIR__ . '/../../logs/api.log');
        return $monolog->pushHandler($handler);
    }
);

$app->post('/v1/game/checkStatus', 'game.controller:checkStatus');
$app->post('/v1/game/makeMove', 'game.controller:MakeMove');
$app->get('/', 'game.controller:index');

// Logging
return $app;
