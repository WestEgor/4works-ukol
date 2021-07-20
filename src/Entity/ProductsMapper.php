<?php

namespace Entity;

use Model\DomainObject;
use Model\Product;
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
            $object->getCategoryId(),
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
            $object->getCategoryId(),
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
            (int)$raw['category_id'],
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
}
