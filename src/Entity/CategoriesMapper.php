<?php


namespace Entity;

use Model\Category;
use Model\DomainObject;
use Model\Product;
use PDO;
use PDOStatement;

class CategoriesMapper extends AbstractMapper
{

    private PDOStatement $selectStatement;
    private PDOStatement $selectAllStatement;
    private PDOStatement $insertStatement;
    private PDOStatement $updateStatement;
    private PDOStatement $deleteStatement;

    public function __construct()
    {
        parent::__construct();
        $this->selectStatement = $this->pdo->prepare("SELECT id, name FROM categories WHERE id=?");
        $this->selectAllStatement = $this->pdo->prepare("SELECT id, name FROM categories");
        $this->insertStatement = $this->pdo->prepare("INSERT INTO categories(name) VALUES (?)");
        $this->updateStatement = $this->pdo->prepare("UPDATE categories SET name=? WHERE id=?");
        $this->deleteStatement = $this->pdo->prepare("DELETE FROM categories WHERE id=?");
    }


    public function save(DomainObject $object): bool
    {
        $values = [$object->getCategoryName()];
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

    public function update(DomainObject $object): bool
    {
        $values = [
            $object->getCategoryName(),
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

    protected function selectStatement(): PDOStatement
    {
        return $this->selectStatement;
    }

    protected function createObject(array $raw): DomainObject
    {
        return new Category(
            (int)$raw['id'],
            $raw['name']
        );
    }

    protected function createArray(array $raw): array
    {
        $categories = [];
        foreach ($raw as $singleRaw) {
            $categories[] = $this->createObject($singleRaw);
        }
        return $categories;
    }

    protected function selectAllStatement(): PDOStatement
    {
        return $this->selectAllStatement;
    }

    public function findCategoryByName(string $categoryName): DomainObject|null
    {
        $sql = "SELECT id, name FROM categories WHERE name=?";
        $this->pdo->prepare($sql)->execute([$categoryName]);
        $raw = $this->pdo->prepare($sql)->fetch();
        $this->pdo->prepare($sql)->closeCursor();
        if (!$raw || !isset($raw['id'])) {
            return null;
        }
        return $this->createObject($raw);
    }

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
