<?php   

namespace App\Repositories\Base;   

use App\Repositories\Interfaces\RepositoryInterface; 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class BaseRepository implements RepositoryInterface 
{     
    /**      
     * @var Model      
     */     
     protected $model;

    /**      
     * BaseRepository constructor.      
     *      
     * @param Model $model      
     */     
    public function __construct(Model $model)     
    {         
        $this->model = $model;
    }

    /**
    * @return Collection
    */
    public function all(): Collection
    {
        return $this->model->all();
    }
 
    /**
    * @param array $attributes
    *
    * @return Model
    */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }
 
    /**
    * @param $id
    * @return Model
    */
    public function find($id): ?Model
    {
        return $this->model->find($id);
    }
}