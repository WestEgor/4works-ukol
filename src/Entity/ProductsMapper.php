<?php

namespace Entity;

use Model\Category;
use Model\DomainObject;
use Model\Product;
use PDO;
use PDOStatement;

class ProductsMapper extends AbstractMapper
{
    /**
     * Basic statements
     */
    private PDOStatement $selectStatement;
    private PDOStatement $selectAllStatement;
    private PDOStatement $insertStatement;
    private PDOStatement $updateStatement;
    private PDOStatement $deleteStatement;

    /**
     * ProductsMapper constructor.
     * Initialize statements
     */
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

    /**
     * Extended AbstractMapper
     *
     * @return PDOStatement
     */
    protected function selectStatement(): PDOStatement
    {
        return $this->selectStatement;
    }

    /**
     * Extended AbstractMapper
     *
     * @return PDOStatement
     */
    protected function selectAllStatement(): PDOStatement
    {
        return $this->selectAllStatement;
    }

    /**
     * Implementing InterfaceMapper
     *
     * @param  DomainObject $object
     * @return bool
     */
    public function save(DomainObject $object): bool
    {
        if (!$object instanceof Product) {
            return false;
        }

        $values = [
            $object->getProductName(),
            $object->getCategory()->getId(),
            $object->getPrice(),
            $object->getQuantity(),
            $object->getDescription()
        ];
        foreach ($values as $value) {
            if (is_null($value)) {
                return false;
            }
        }

        if (!$this->insertStatement->execute($values)) {
            return false;
        }

        $id = $this->pdo->lastInsertId();
        if (!$id) {
            return false;
        }
        $object->setId((int)$id);
        $this->insertStatement->closeCursor();
        return true;
    }

    /**
     * Implementing InterfaceMapper
     *
     * @param  DomainObject $object
     * @return bool
     */
    public function update(DomainObject $object): bool
    {
        if (!$object instanceof Product) {
            return false;
        }
        $values = [
            $object->getProductName(),
            $object->getCategory()->getId(),
            $object->getPrice(),
            $object->getQuantity(),
            $object->getDescription(),
            $object->getId()
        ];

        foreach ($values as $value) {
            if (is_null($value)) {
                return false;
            }
        }

        if (!$this->updateStatement->execute($values)) {
            return false;
        }
        $this->updateStatement->closeCursor();
        return true;
    }

    /**
     * Implementing InterfaceMapper
     *
     * @param  DomainObject $object
     * @return bool
     */
    public function delete(DomainObject $object): bool
    {
        if (!$object instanceof Product) {
            return false;
        }
        if (!$object->getId()) {
            return false;
        }
        $id = [
            $object->getId()
        ];

        if (!$this->deleteStatement->execute($id)) {
            return false;
        }
        $this->deleteStatement->closeCursor();
        return true;
    }

    /**
     * Extended AbstractMapper
     *
     * @param  array $raw
     * @return DomainObject
     */
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

    /**
     * Extended AbstractMapper
     *
     * @param  array $raw
     * @return array
     */
    protected function createArray(array $raw): array
    {
        $products = [];
        foreach ($raw as $singleRaw) {
            $products[] = $this->createObject($singleRaw);
        }
        return $products;
    }

    /**
     * Inner join of categories nad products
     * Method to receive category name by product
     *
     * @param  Product $product
     * @return string|null
     */
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

    /**
     * Get column names from table `products`
     *
     * @return array|null
     * return ARRAY if columns exist
     * return NULL if no columns in table
     */
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
