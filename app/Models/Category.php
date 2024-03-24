<?php

namespace App\Models;

use App\Core\Model;

class Category extends Model
{
    public static $attributes = ["name"];

    public function getAll()
    {
        return $this->findAll("category");
    }

    public function findOneById($id)
    {
        return $this->findOne("category", $id);
    }
}
