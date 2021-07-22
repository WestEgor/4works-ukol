<?php

namespace Entity;

use Model\Category;
use Model\DomainObject;
use Model\Product;
use PDO;
use PDOStatement;

class ProductsMapper extends AbstractMapper
{
    private PDOStatement $selectStatement;
    private PDOStatement $selectAllStatement;
    private PDOStatement $insertStatement;
    private PDOStatement $updateStatement;
    private PDOStatement $deleteStatement;

    public function __construct()
    {
        parent::__construct();
        $this->selectStatement =
            $this->pdo->prepare("SELECT id, name,category_id,price,quantity,description FROM products WHERE id=?");
        $this->selectAllStatement =
            $this->pdo->prepare("SELECT id, name,category_id,price,quantity,description FROM products");
        $this->insertStatement =
            $this->pdo->prepare("INSERT INTO products(name,category_id,price,quantity,description) VALUES (?,?,?,?,?)");
        $this->updateStatement =
            $this->pdo->prepare("UPDATE products SET name=?,category_id=?,price=?,quantity=?,description=? WHERE id=?");
        $this->deleteStatement =
            $this->pdo->prepare("DELETE FROM products WHERE id=?");
    }

    protected function selectStatement(): PDOStatement
    {
        return $this->selectStatement;
    }

    protected function selectAllStatement(): PDOStatement
    {
        return $this->selectAllStatement;
    }


    /**
     * @return bool
     * @var Product $object
     */
    public function save(DomainObject $object): bool
    {
        $values = [
            $object->getProductName(),
            $object->getCategory()->getId(),
            $object->getPrice(),
            $object->getQuantity(),
            $object->getDescription()
        ];
        if (!$values) {
            return false;
        }
        $this->insertStatement->execute($values);
        $id = $this->pdo->lastInsertId();
        if (!$id) {
            return false;
        }
        $object->setId((int)$id);
        return true;
    }

    /**
     * @return bool
     * @var Product $object
     */
    public function update(DomainObject $object): bool
    {
        $values = [
            $object->getProductName(),
            $object->getCategory()->getId(),
            $object->getPrice(),
            $object->getQuantity(),
            $object->getDescription(),
            $object->getId()
        ];

        if (!$values) {
            return false;
        }

        $this->updateStatement->execute($values);
        return true;
    }

    public function delete(DomainObject $object): bool
    {
        $id = [
            $object->getId()
        ];
        if (!$id) {
            return false;
        }
        $this->deleteStatement->execute($id);
        return true;
    }

    protected function createObject(array $raw): DomainObject
    {
        return new Product(
            (int)$raw['id'],
            $raw['name'],
            new Category(id: $raw['category_id']),
            (float)$raw['price'],
            (int)$raw['quantity'],
            $raw['description']
        );
    }

    protected function createArray(array $raw): array
    {
        $products = [];
        foreach ($raw as $singleRaw) {
            $products[] = $this->createObject($singleRaw);
        }
        return $products;
    }

    public function getCategoryByProductName(Product $product): string|null
    {
        $nameOfProduct = $product->getProductName();
        $nameOfCategory = '';
        $query = "SELECT categories.name FROM products  LEFT JOIN categories ON products.category_id = categories.id
        WHERE products.name = ?";

        $stmt = $this->pdo->prepare($query);
        if ($stmt->execute([$nameOfProduct])) {
            while ($raws = $stmt->fetchAll()) {
                foreach ($raws as $raw) {
                    $nameOfCategory = $raw['name'];
                }
            }
            $stmt->closeCursor();
            return $nameOfCategory;
        }
        return null;
    }

    public function getProductColumnNames(): array|null
    {
        $sql = "SELECT `COLUMN_NAME` FROM `information_schema`.`COLUMNS` 
                WHERE `TABLE_SCHEMA`= 'products-4works' 
                AND `TABLE_NAME`='products'";

        $stmt = $this->pdo->query($sql);
        $tableList = [];
        while ($row = $stmt->fetch(PDO::FETCH_NAMED)) {
            $tableList[] = $row['COLUMN_NAME'];
        }
        if (count($tableList) === 0) {
            return null;
        }
        return $tableList;
    }
}
