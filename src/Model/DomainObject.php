<?php

namespace Model;

abstract class DomainObject
{

    abstract public function __construct();

    public static function create(): DomainObject
    {
        return new static();
    }
}
