<?php

namespace Entity;

use Model\Category;
use Model\DomainObject;
use Model\Product;
use PDO;
use PDOStatement;

/**
 * Class CategoriesMapper
 * Class for formation of a real object and performing operations in the database with table `categories`
 *
 * @package Entity
 */
class CategoriesMapper extends AbstractMapper
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
     * CategoriesMapper constructor.
     * Initialize statements
     */
    public function __construct()
    {
        parent::__construct();
        $this->selectStatement = $this->pdo->prepare("SELECT id, name FROM categories WHERE id=?");
        $this->selectAllStatement = $this->pdo->prepare("SELECT id, name FROM categories");
        $this->insertStatement = $this->pdo->prepare("INSERT INTO categories(name) VALUES (?)");
        $this->updateStatement = $this->pdo->prepare("UPDATE categories SET name=? WHERE id=?");
        $this->deleteStatement = $this->pdo->prepare("DELETE FROM categories WHERE id=?");
    }

    /**
     * Get select statements
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
        if (!$object instanceof Category) {
            return false;
        }

        $categoryName = $object->getCategoryName();
        if (is_null($categoryName)) {
            return false;
        }
        $values = [$categoryName];

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

        if (!$object instanceof Category) {
            return false;
        }

        $values = [
            $object->getCategoryName(),
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
        if (!$object instanceof Category) {
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
        return new Category(
            (int)$raw['id'],
            $raw['name']
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
        $categories = [];
        foreach ($raw as $singleRaw) {
            $categories[] = $this->createObject($singleRaw);
        }
        return $categories;
    }


    /**
     * Get column names from table `categories`
     *
     * @return array|null
     * return ARRAY if columns exist
     * return NULL if no columns in table
     */
    public function getColumnNames(): array|null
    {
        $sql = "SELECT `COLUMN_NAME` FROM `information_schema`.`COLUMNS` 
                WHERE `TABLE_SCHEMA`= 'products-4works' 
                AND `TABLE_NAME`='categories'";

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
