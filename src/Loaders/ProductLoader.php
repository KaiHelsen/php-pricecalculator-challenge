<?php
declare(strict_types=1);

namespace Loaders;

use Models\Product;
use PDO;

class ProductLoader
{
    public static function fetchProduct(int $id, PDO $pdo): Product
    {
        $query = $pdo->prepare('select * from product where id = :id');
        $query->bindValue('id', $id);
        $query->execute();
        $rawProduct = $query->fetch();

        return new Product((int)$rawProduct['id'], $rawProduct['name'], (int)$rawProduct['price']);
    }

    /** @Product[] */
    public static function fetchAllProducts(PDO $pdo): array
    {
        $query = $pdo->query('select * from product ORDER BY name');
        $rawProducts = $query->fetchAll();

        $products = [];
        foreach ($rawProducts as $product) {
            $products[] = new Product((int)$product['id'], $product['name'],
                (int)$product['price']);
        }

        return $products;
    }
}