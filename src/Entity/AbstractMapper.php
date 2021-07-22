<?php

namespace Entity;

use Configure\Connection;
use Model\DomainObject;
use PDO;
use PDOStatement;

/**
 * Class AbstractMapper
 * Implements InterfaceMapper
 * Class for maintenance multiple objects
 * Focused general functionality, and responsibilities
 * for performing operations on specific objects are delegated to child classes
 *
 * @package Entity
 */
abstract class AbstractMapper implements InterfaceMapper
{
    /**
     * @var PDO|null
     */
    protected ?PDO $pdo;

    /**
     * AbstractMapper constructor.
     * Get connection to database
     */
    public function __construct()
    {
        $this->pdo = Connection::getInstance()->getConnection();
    }

    /**
     * Select data by id from table
     *
     * @return PDOStatement
     */
    abstract protected function selectStatement(): PDOStatement;

    /**
     * Select all data from table statement
     *
     * @return PDOStatement
     */
    abstract protected function selectAllStatement(): PDOStatement;

    /**
     * Method to create DomainObject from array
     *
     * @param array $raw
     * @return DomainObject
     */
    abstract protected function createObject(array $raw): DomainObject;

    /**
     * Method to create array of DomainObject from $raw
     *
     * @param array $raw
     * @return array
     */
    abstract protected function createArray(array $raw): array;

    /**
     * Implementing InterfaceMapper
     * @param int $id
     * @return DomainObject|null
     */
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

    /**
     * Implementing InterfaceMapper
     * @return array|null
     */
    public function findAll(): ?array
    {
        $this->selectAllStatement()->execute();
        $raw = $this->selectAllStatement()->fetchAll();
        if (!$raw) {
            return null;
        }
        return $this->createArray($raw);
    }

    /**
     * Destructor of AbstractMapper
     */
    public function __destruct()
    {
        $this->pdo = null;
    }
}
