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

    abstract protected function createObject(array $raw): DomainObject;

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


    public function __destruct()
    {
        $this->pdo = null;
    }
}
