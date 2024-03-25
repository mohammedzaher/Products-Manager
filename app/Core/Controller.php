<?php

namespace App\Core;

abstract class Controller
{
    protected function render($view, $data = [])
    {
        extract($data);

        include ROOT . "app/Views/$view.php";
    }

    protected function getRequestBody()
    {
        $BODY = json_decode(file_get_contents('php://input'), true);
        return $BODY;
    }
}
