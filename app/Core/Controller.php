<?php

namespace App\Core;

abstract class Controller
{
    protected function render($view, $data = [])
    {
        extract($data);

        include ROOT . "app/Views/$view.php";
    }
}
