<?php

namespace App\Models;

use App\Core\Model;
use App\Core\Database;

abstract class Product extends Model
{
    public static $attributes = ["sku", "name", "price", "type"];

    public function add($data)
    {
        $statement = $this->insert("Product", $data);
        $type = $this->findOne("category", $data["type"]);
        if($statement) {
            return $this->insert($type['name'], array_merge($data, ["id" => $this->getLastProductId()]));
        } else {
            return false;
        }

    }

    protected function joinAll($tableName)
    {
        $sql = "SELECT * FROM product p INNER JOIN " . strtolower($tableName) . " ON p.id = " . strtolower($tableName) . ".id";
        $query = Database::getBdd()->prepare($sql);
        $query->execute([]);
        return $query->fetchAll();
    }

    public function delete($id)
    {
        $sql = "DELETE FROM product WHERE id = :id";
        $query = Database::getBdd()->prepare($sql);
        return $query->execute(['id' => $id]);
    }
    private function getLastProductId()
    {
        $sql = "SELECT * FROM product ORDER BY id DESC LIMIT 1";
        $query = Database::getBdd()->prepare($sql);
        $query->execute();
        return $query->fetch()['id'];
    }

    public function checkSKU($sku)
    {
        $sql = "SELECT * FROM product WHERE sku = ?";
        $query = Database::getBdd()->prepare($sql);
        $query->execute([$sku]);

        return !empty($query->fetchAll());
    }

    abstract public function getDetails($product);

    abstract public function getAll();
}
