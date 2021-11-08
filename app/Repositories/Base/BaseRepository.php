<?php   

namespace App\Repositories\Base;   

use App\Repositories\Interfaces\RepositoryInterface; 
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
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
    * @param $column
    * @param $direction
    * @return Model
    */
   public function orderBy($column, $direction = 'desc'): Builder
    {
        return $this->model->orderBy($column, $direction);
    }
    
    /**
     * @param $length
     * @return LengthAwarePaginator
     */
    public function paginate($length): LengthAwarePaginator
    {
        return $this->model->paginate($length);
    }
 
    /**
    * @param array $attributes
    * @return Model
    */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    /**
    * @param $id
    * @param array $attributes
    * @return Model
    */
    public function update($id, array $attributes): Model
    {
        $model = $this->model->find($id);
        $model->update($attributes);

        return $model;
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