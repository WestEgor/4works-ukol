<?php

namespace Entity;

use Model\DomainObject;

interface InterfaceMapper
{

    public function findAll(): array|false;

    public function findByKey(int $id): ?DomainObject;

    public function save(DomainObject $object): bool;

    public function update(DomainObject $object): bool;

    public function delete(int $id): bool;

}