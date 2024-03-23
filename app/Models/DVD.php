<?php

namespace App\Models;

use App\Models\Product;

class DVD extends Product
{
    public function getAll()
    {
        return $this->joinAll('dvd');
    }

    public function getDetails($product)
    {
        return "Size: " . (int)$product["size"] . " MB";
    }
}
