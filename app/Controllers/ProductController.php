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
        foreach($data['types'] as $key => $type) {
            $data['types'][$key]['attributes'] = ('App\Models\\' . $type['name'])::$attributes;
        }

        $this->render('add', $data);
    }

    public function store()
    {
        $BODY = $this->getRequestBody();
        $data = [
            "sku" => $BODY["sku"],
            "name" => $BODY["name"],
            "price" => $BODY["price"],
        ];

        if(!$BODY["type"]) {
            echo json_encode(array(
                "message" => "Please, select product type."
            ));
            return;
        }

        $type = (new Category())->findOneByName($BODY["type"]);

        if(!$type) {
            echo json_encode(array(
                "message" => "Invalid Product Type"
            ));
            return;
        }

        $data["type"] = $type['id'];
        $product = new ('App\Models\\' . $type['name'])();
        foreach($product::$attributes as $attribute) {
            $data[$attribute] = $BODY[$attribute];
        }

        $missingParameters = $this->getMissingParameters($data);

        if (count($missingParameters) > 0) {
            echo json_encode(array(
                "message" => "Missing Parameters: " . join(", ", $missingParameters)
            ));
            return;
        }

        if($product->checkSKU($data["sku"])) {
            echo json_encode(array(
                "message" => "SKU Must be Unique for each product"
            ));
            return;
        }

        $statement = $product->add($data);

        echo json_encode(array(
            "message" => $statement ? "Product Added Successfully" : "Failed to Add Product"
        ));

        return;
    }

    public function delete()
    {
        $BODY = $this->getRequestBody();

        $data = [
            "id" => $BODY["id"],
            "type" => $BODY["type"],
        ];
        $product = new ('App\Models\\' . $data["type"])();
        $product->delete($data["id"]);

        return;
    }
}
