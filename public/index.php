<?php

declare(strict_types = 1);

define('LARAVEL_START', microtime(true));

require __DIR__ . '/../vendor/autoload.php';

$app      = require __DIR__ . '/../bootstrap/app.php';
$kernel   = $app->make(Illuminate\Contracts\Http\Kernel::class);
$request  = Illuminate\Http\Request::capture();
$response = $kernel->handle($request);

$response->send();

$kernel->terminate($request, $response);
