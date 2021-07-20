<?php

namespace Configure;

use PDO;

class Registry
{
    private static mixed $instance = null;
    private PDO $pdo;

    private function __construct()
    {
    }

    static public function instance(): self
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getPdo(): PDO
    {
        if (is_null($this->pdo)) {
            $this->pdo = new PDO($_ENV['DSN'], $_ENV['USER'], $_ENV['PASSWORD']);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return $this->pdo;
    }
}
