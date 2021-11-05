<?php

namespace App\Repositories\Ip;

use App\Models\Ip;
use App\Repositories\Base\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class IpRepository extends BaseRepository
{

    /**
        * IpRepository constructor.
        *
        * @param Ip $model
        */
    public function __construct(Ip $model)
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