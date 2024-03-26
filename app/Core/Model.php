<?php

namespace App\Core;

abstract class Model
{
    protected function insert($tableName, $data)
    {
        $attributes = ('App\Models\\'.$tableName)::$attributes;

        if($tableName != 'Product') {
            array_push($attributes, 'id');
        }

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
        $sql = "SELECT * FROM ". strtolower($tableName) . " WHERE id = :id";
        $query = Database::getBdd()->prepare($sql);
        $query->execute(['id' => $id]);
        return $query->fetch();
    }

    protected function findOneByColumn($tableName, $column, $value)
    {
        $sql = "SELECT * FROM ". strtolower($tableName) . " WHERE $column = :$column";
        $query = Database::getBdd()->prepare($sql);
        $query->execute(["$column" => $value]);
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
