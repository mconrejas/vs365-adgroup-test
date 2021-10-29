<?php

namespace App\Repositories\IP;

use App\Models\IP;
use App\Repositories\Base\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class IPRepository extends BaseRepository
{

    /**
        * IPRepository constructor.
        *
        * @param IP $model
        */
    public function __construct(IP $model)
    {
        parent::__construct($model);
    }

    /**
        * @return Model
        */
    public function update($id, array $attributes): Model
    {
        $model = $this->model->findOrFail($id);
        $model->update($attributes);

        return $model;
    }

    /**
    * @param $id
    * @return Model
    */
    public function find($id): ?Model
    {
        return $this->model->findOrFail($id);
    }
}