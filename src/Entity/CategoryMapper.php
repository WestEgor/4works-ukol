<?php


namespace Entity;

use Model\Category;
use Model\DomainObject;
use PDOStatement;

class CategoryMapper extends AbstractMapper
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
        $values = [$object->getName()];
        if (!$values) {
            return false;
        }

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
            $object->getName(),
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
            $categories[] = new Category(
                (int)$singleRaw['id'],
                $singleRaw['name']
            );
        }
        return $categories;
    }

    protected function selectAllStatement(): PDOStatement
    {
        return $this->selectAllStatement;
    }
}
