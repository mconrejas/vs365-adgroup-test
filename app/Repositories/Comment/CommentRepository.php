<?php

namespace App\Repositories\Comment;

use App\Models\Comment;
use App\Models\Ip;
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
}