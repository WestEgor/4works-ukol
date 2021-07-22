<?php

namespace Model;

/**
 * Class DomainObject
 * Superclass of all model classes
 * @package Model
 */
abstract class DomainObject
{

    /**
     * DomainObject constructor.
     */
    abstract public function __construct();

    /**
     * Method to create objects with late static bindings
     *
     * @return DomainObject
     */
    public static function create(): DomainObject
    {
        return new static();
    }
}
