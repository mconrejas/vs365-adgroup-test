<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    /**
     * Create or update comment.
     *
     * @param \App\Http\Requests\CommentRequest $request
     * @return \App\Http\Resources\IPResource
     * @return \Exception
     */
    public function save(CommentRequest $request, $ip_id)
    {
        try {
            $comment = auth()->user()->load('comments')->comments()->updateOrCreate(
                [ 'ip_id' => $ip_id ],
                [ 'comment' => $request->comment ]
            );

            return new CommentResource($comment);
        } catch (\Exception $e) {
            return response()->json([ 'status' => 'error', 'message' => $e->getMessage() ]);
        }
    }
}
