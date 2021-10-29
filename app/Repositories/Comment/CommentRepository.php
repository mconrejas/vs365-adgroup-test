<?php

namespace App\Repositories\Comment;

use App\Models\Comment;
use App\Models\IP;
use App\Repositories\Base\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class CommentRepository extends BaseRepository
{

    /**
    * CommentRepository constructor.
    *
    * @param Comment $model
    */
    public function __construct(Comment $model)
    {
        parent::__construct($model);
    }

    /**
    * @return Model
    */
    public function updateOrCreate($id, array $attributes): Model
    {
        IP::findOrFail($id);
        return $this->model->updateOrCreate(
            [ 'user_id' => auth()->user()->id, 'ip_id' => $id ],
            $attributes
        );
    }
}