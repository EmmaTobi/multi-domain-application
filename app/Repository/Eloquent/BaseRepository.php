<?php

namespace App\Repository\Eloquent;

use App\Repository\EloquentRepositoryInterface;
use Illiminate\Database\Eloquent\Model;

/**
 * Concrete Implementation of EloquentRepositoryInterface
 */
class BaseRepository implements EloquentRepositoryInterface{

    /** @var Model */
    protected $model;

    public function __construct(Model $model){
        $this->model = $model;
    }

    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes) : Model{
        return $this->model->create($model);
    }

    /**
     * Find a model by id
     * @param int $id
     * @return Model
     */
    public function find(int $id) : Model{
        return $this->model->find($id);
    }

    /**
     * Create or Update a model
     * @return bool|null
     */
    public function save() : ?bool{
        return $this->model->save();
    }

    /**
     * Delete a model
     * @return bool|null
     */
    public function delete() : ?bool{
        return $this->model->delete();
    }

}

?>