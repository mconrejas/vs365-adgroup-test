<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Http\Requests\CommentRequest;
use App\Repositories\Comment\CommentRepository;

class CommentController extends Controller
{
    private $repository;

    /**
     * Instantiate repository
     */
    public function __construct(CommentRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Create or update comment.
     *
     * @param \App\Http\Requests\CommentRequest $request
     * @return mixed
     */
    public function save(CommentRequest $request, $ip_id)
    {
        try {
            return new CommentResource($this->repository->updateOrCreate($ip_id, $request->only('comment')));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([ 'message' => 'Data not found.' ], 404);
        } catch (\Exception $e) {
            return response()->json([ 'status' => 'error', 'message' => $e->getMessage() ]);
        }
    }
}
