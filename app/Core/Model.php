<?php

namespace App\Core;

abstract class Model
{
    protected function insert($tableName, $data)
    {
        $attributes = $tableName::$attributes;

        $sql = "INSERT INTO " . strtolower($tableName) . " (" . join(", ", $attributes) . ") VALUES (:". join(", :", $attributes) . ")";

        $query = Database::getBdd()->prepare($sql);

        $bindings = array();

        foreach($attributes as $attribute) {
            $bindings[$attribute] = $data[$attribute];
        }

        return $query->execute($bindings);
    }

    protected function findOne($tableName, $id)
    {
        $sql = "SELECT * FROM ". strtolower($tableName) . "WHERE id = :id";
        $query = Database::getBdd()->prepare($sql);
        $query->execute($id);
        return $query->fetch();
    }

    protected function findAll($tableName)
    {
        $sql = "SELECT * FROM " . strtolower($tableName);
        $query = Database::getBdd()->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }


}
