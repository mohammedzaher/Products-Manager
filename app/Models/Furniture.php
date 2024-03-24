<?php

namespace App\Models;

use App\Models\Product;

class Furniture extends Product
{
    public static $attributes = ["height", "width", "length"];

    public function getAll()
    {
        return $this->joinAll('furniture');
    }

    public function getDetails($product)
    {
        return "Dimension: " . (int)$product["height"] . "x" . (int)$product["width"] . "x" . (int)$product["length"];
    }
}
