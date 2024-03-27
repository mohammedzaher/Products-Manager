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
        return $this->secureBody($BODY);
    }

    private function secureBody($data)
    {
        foreach ($data as $key => $value) {
            $data[$key] = trim($value);
            $data[$key] = stripslashes($value);
            $data[$key] = htmlspecialchars($value);
        }
        return $data;
    }

    protected function getMissingParameters($data)
    {
        $missingParameter = array();

        foreach ($data as $item) {
            if ($item == "") {
                array_push($missingParameter, $item);
            }
        }

        return $missingParameter;
    }

}
