<?php

namespace App\Models;

use App\Models\Product;

class Book extends Product
{
    public function getAll()
    {
        return $this->joinAll('book');
    }

    public function getDetails($product)
    {
        return "Weight: " . $product["weight"] . " KG";
    }
}
