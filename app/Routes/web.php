<?php

use App\Core\Router;
use App\Controllers\ProductController;

$router = new Router();
$router->get('/', ProductController::class, 'list');
$router->get('/addproduct', ProductController::class, 'add');
$router->post('/product', ProductController::class, 'store');
$router->delete('/product', ProductController::class, 'delete');

$router->dispatch();
