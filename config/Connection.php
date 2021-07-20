<?php

namespace Configure;

use PDO;

class Connection
{

    private static ?Connection $instance = null;
    private ?PDO $pdo;

    private function __construct()
    {
    }

    static public function getInstance(): static
    {
        if (is_null(static::$instance)) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    public function getConnection(): PDO
    {
        /*if (is_null($this->pdo)) {*/
        $this->pdo = new PDO($_ENV['DSN'], $_ENV['USER'], $_ENV['PASSWORD']);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //}
        return $this->pdo;
    }

}
