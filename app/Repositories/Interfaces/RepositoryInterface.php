<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

/**
* Interface RepositoryInterface
* @package App\Repositories
*/
interface RepositoryInterface
{
   /**
    * @param array $attributes
    * @return Model
    */
   public function create(array $attributes): Model;

   /**
    * @param $id
    * @param array $attributes
    * @return Model
    */
    public function update($id, array $attributes): Model;

   /**
    * @param $id
    * @return Model
    */
   public function find($id): ?Model;

   /**
    * @return Collection
    */
   public function all(): Collection;

   /**
    * @param $column
    * @param $direction
    * @return Model
    */
   public function orderBy($column, $direction = 'desc'): Builder;
   
   /**
    * @return LengthAwarePaginator
    */
   public function paginate($length): LengthAwarePaginator;
}