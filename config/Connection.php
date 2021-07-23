<?php

namespace Configure;

use PDO;

/**
 * Class Connection
 * Class to interaction with connection via PDO
 *
 * @package Configure
 */
class Connection
{
    /**
     * instance of Connection
     *
     * @var Connection|null
     */
    private static ?Connection $instance = null;

    /**
     * @var PDO|null
     */
    private ?PDO $pdo = null;

    final private function __construct()
    {
    }

    /**
     * Get single instance of the class Connection
     *
     * @return static
     */
    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    /**
     * Get connection with database via PDO
     *
     * @return PDO
     */
    public function getConnection(): PDO
    {
        if (is_null($this->pdo)) {
            $this->pdo = new PDO($_ENV['DSN'], $_ENV['USER'], $_ENV['PASSWORD']);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return $this->pdo;
    }
}
