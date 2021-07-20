<?php


namespace Entity;

use Model\Category;
use Model\DomainObject;
use PDOStatement;

class CategoryMapper extends AbstractMapper
{

    private PDOStatement $selectStatement;
    private PDOStatement $insertStatement;
    private PDOStatement $updateStatement;

    public function __construct()
    {
        parent::__construct();
        $this->selectStatement = $this->pdo->prepare("SELECT id, name FROM categories WHERE id=?");
    }

    public function findAll(): array|false
    {
        // TODO: Implement findAll() method.
    }


    public function save(object $object): bool
    {
        // TODO: Implement save() method.
    }

    public function update(object $object): bool
    {
        // TODO: Implement update() method.
    }

    public function delete(int $id): bool
    {
        // TODO: Implement delete() method.
    }

    protected function selectStatement(): PDOStatement
    {
        return $this->selectStatement;
    }

    protected function createObject(array $raw): DomainObject
    {
        return new Category(
            (int)$raw['id'],
            (string)$raw['name']
        );
    }
}