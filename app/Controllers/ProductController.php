<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Category;

class ProductController extends Controller
{
    public function list()
    {
        $data["title"] = "Product List";
        $data["products"] = array();

        $types = (new Category())->getAll();
        foreach($types as $type) {
            $products = new ('App\Models\\' . $type['name'])();
            foreach($products->getAll() as $product) {
                $data["products"][$product["id"]] = array(
                    "id" => $product["id"],
                    "sku" => $product["sku"],
                    "name" => $product["name"],
                    "price" => $product["price"],
                    "type" => $type['name'],
                    "details" => $products->getDetails($product),
                );
            }
        }

        ksort($data["products"]);

        $this->render('list', $data);
    }

    public function add()
    {
        $data['title'] = 'Product Add';
        $data['types'] = (new Category())->getAll();

        $this->render('add', $data);
    }

    public function store()
    {
        $data = [
            "sku" => $_POST["sku"],
            "name" => $_POST["name"],
            "price" => $_POST["price"],
            "type" => 3,
        ];

        $type = (new Category())->findOneById($data["type"]);
        $product = new ('App\Models\\' . $type['name'])();
        foreach($product::$attributes as $attribute) {
            $data[$attribute] = $_POST[$attribute];
        }

        $statement = $product->add($data);
        var_dump($statement);
        die();
    }
}
