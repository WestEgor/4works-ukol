<?php


namespace Model;


abstract class DomainObject
{

    public static function create(): DomainObject
    {
        return new static();
    }

}