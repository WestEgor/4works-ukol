<?php

namespace Configure;

use InvalidArgumentException;
use RuntimeException;

/**
 * Class DotEnv
 * Class, that provide work with .env file
 *
 * @package Configure
 */
class DotEnv
{
    /**
     * Directory of .env file location
     *
     * @var string
     */
    private string $path;

    /**
     * DotEnv constructor.
     *
     * @param string $path
     */
    public function __construct(string $path)
    {
        if (!file_exists($path)) {
            throw new InvalidArgumentException(sprintf('%s does not exist', $path));
        }
        if (!is_readable($path)) {
            throw new RuntimeException(sprintf('%s file is not readable', $path));
        }

        $this->path = $path;
    }

    /**
     * Method, that allow us to load data from .env file
     */
    public function load(): void
    {
        //get data from file
        $lines = file($this->path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($lines) {
            foreach ($lines as $line) {
                //skip comments in .env file
                if (str_starts_with(trim($line), '#')) {
                    continue;
                }
                //put away `=`
                list($name, $value) = explode('=', $line, 2);
                $name = trim($name);
                $value = trim($value);

                //add to global $_ENV and $_SERVER new data from .env file
                if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
                    putenv(sprintf('%s=%s', $name, $value));
                    $_ENV[$name] = $value;
                    $_SERVER[$name] = $value;
                }
            }
        }
    }
}
