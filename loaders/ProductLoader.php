<?php


class ProductLoader
{
    public static function getProduct(int $id, PDO $pdo): Product
    {
        $query = $pdo->prepare('select * from product where id = :id');
        $query->bindValue('id', $id);
        $query->execute();
        $rawProduct = $query->fetch();

        return new Product($rawProduct['id'], $rawProduct['name'], $rawProduct['price']);
    }

    /** @Product[] */
    public static function getAllProducts(PDO $pdo): array
    {
        $query = $pdo->query('select * from product ORDER BY name');
        $rawProducts = $query->fetchAll();

        $products = [];
        foreach ($rawProducts as $product) {
            $products[] = new Product($product['id'], $product['name'],
                $product['price']);
        }

        return $products;
    }

}