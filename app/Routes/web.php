<?php

use App\Core\Router;
use App\Controllers\ProductController;

$router = new Router();
$router->get('/', ProductController::class, 'list');

$router->dispatch();
