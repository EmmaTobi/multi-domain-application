<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Model;

/**
 * Interface EloquentRepositoryInterface
 * @package App\Repository
 */
interface EloquentRepositoryContract
{
    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes) : Model;

    /**
     * @param int $id
     * @return Model
     */
    public function find(int $id) : Model;

        /**
     * Create or Update a model
     * @return bool|null
     */
    public function save() : ?bool;

    /**
     * Delete a model
     * @return bool|null
     */
    public function delete() : ?bool;

}
?>