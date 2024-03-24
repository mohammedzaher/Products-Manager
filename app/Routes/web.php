<?php

use App\Core\Router;
use App\Controllers\ProductController;

$router = new Router();
$router->get('/', ProductController::class, 'list');
$router->get('/addproduct', ProductController::class, 'add');
$router->post('/addproduct', ProductController::class, 'store');

$router->dispatch();
