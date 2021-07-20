<?php

namespace Entity;

interface InterfaceMapper
{

    public function findAll(): array|false;

    public function findByKey(int $key): object|false;

    public function save(object $object): bool;

    public function update(object $object): bool;

    public function delete(int $key): bool;

}