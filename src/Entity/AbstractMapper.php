<?php

namespace Entity;

use Configure\Connection;
use Model\DomainObject;
use PDO;
use PDOStatement;

abstract class AbstractMapper implements InterfaceMapper
{
    protected ?PDO $pdo;

    public function __construct()
    {
        $this->pdo = Connection::getInstance()->getConnection();
    }

    abstract protected function selectStatement(): PDOStatement;

    abstract protected function selectAllStatement(): PDOStatement;

    abstract protected function createObject(array $raw): DomainObject;

    abstract protected function createArray(array $raw): array;

    public function findByKey(int $id): ?DomainObject
    {
        $this->selectStatement()->execute([$id]);
        $raw = $this->selectStatement()->fetch();
        $this->selectStatement()->closeCursor();
        if (!$raw || !isset($raw['id'])) {
            return null;
        }

        return $this->createObject($raw);
    }

    public function findAll(): ?array
    {
        $this->selectAllStatement()->execute();
        $raw = $this->selectAllStatement()->fetchAll();
        if (!$raw) {
            return null;
        }
        return $this->createArray($raw);
    }

    public function __destruct()
    {
        $this->pdo = null;
    }
}
