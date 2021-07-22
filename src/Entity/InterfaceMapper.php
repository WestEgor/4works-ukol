<?php

namespace Entity;

use Model\DomainObject;

/**
 * Interface InterfaceMapper
 * Interface of CRUD methods
 *
 * @package Entity
 */
interface InterfaceMapper
{

    /**
     * Methods uses to get array of object, which contains in table
     *
     * @return array|null
     * return ARRAY iff table contains minimum 1 record
     * return null if no records in table
     */
    public function findAll(): ?array;

    /**
     * Methods uses to get object with selected id
     *
     * @param int $id id of  record
     * @return DomainObject|null
     * return DomainObject iff table contains minimum 1 record that satisfy $id
     * return FALSE if no records in table
     */
    public function findByKey(int $id): ?DomainObject;

    /**
     * Methods uses to create record in table
     *
     * @param DomainObject $object object inserted into table
     * @return bool
     * return TRUE iff record was created
     * return FALSE if record was not created
     */
    public function save(DomainObject $object): bool;

    /**
     * Methods uses to update record in table
     *
     * @param DomainObject $object object updated in table
     * @return bool
     * return TRUE iff record was updated
     * return FALSE if records was not updated
     */
    public function update(DomainObject $object): bool;

    /**
     * Methods uses to delete record from table with selected id
     *
     * @param DomainObject $object id of deleted record
     * @return bool
     * return TRUE iff record was deleted
     * return FALSE if records was not deleted
     */
    public function delete(DomainObject $object): bool;
}
