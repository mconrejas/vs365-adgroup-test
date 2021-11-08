<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Http\Requests\CommentRequest;
use App\Models\Ip;
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
     * Create comment.
     *
     * @param $ip_id
     * @param \App\Http\Requests\CommentRequest $request
     * @return mixed
     */
    public function store(CommentRequest $request)
    {
        try {
            Ip::findOrFail($request->ip_id);
            return new CommentResource($this->repository->create(
                array_merge(
                    ['user_id' => auth()->user()->id], 
                    $request->all()
                )
            )->load('user'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([ 'message' => 'Data not found.' ], 404);
        } catch (\Exception $e) {
            return response()->json([ 'status' => 'error', 'message' => $e->getMessage() ]);
        }
    }
    
    /**
     * Update comment.
     *
     * @param $id
     * @param \App\Http\Requests\CommentRequest $request
     * @return mixed
     */
    public function update(CommentRequest $request, $id)
    {
        try {
            return new CommentResource($this->repository->update($id, $request->only('comment'))->load('user'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([ 'message' => 'Data not found.' ], 404);
        } catch (\Exception $e) {
            return response()->json([ 'status' => 'error', 'message' => $e->getMessage() ]);
        }
    }
}
