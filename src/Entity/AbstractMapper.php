<?php

namespace Entity;

use Configure\Connection;
use PDO;

abstract class AbstractMapper implements InterfaceMapper
{
    protected ?PDO $pdo;

    public function __construct()
    {
        $this->pdo = Connection::getInstance()->getConnection();
    }

    

    public function __destruct()
    {
        $this->pdo = null;
    }

}