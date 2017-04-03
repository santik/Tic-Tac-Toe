<?php

declare (strict_types = 1);

namespace InSided;

require __DIR__ . '/../vendor/autoload.php';

$app = require __DIR__ . '/../src/Infrastructure/app.php';
$app->run();
