<?php

namespace App\Http\Controllers;

use App\Http\Resources\IpResource;
use App\Http\Requests\IpStoreRequest;
use App\Http\Requests\IpUpdateRequest;
use App\Repositories\Ip\IpRepository;
use Illuminate\Http\Request;

class IpController extends Controller
{
    private $repository;

    /**
     * Instantiate repository
     */
    public function __construct(IpRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get list of ip.
     *
     * @return \App\Http\Resources\IpResource
     * @return \Exception
     */
    public function get(Request $request)
    {
        try {
            return new IpResource( $this->repository->orderBy('id', 'desc')->paginate($request->limit) );
        } catch (\Exception $e) {
            return response()->json( [ 'status' => 'error', 'message' => $e->getMessage() ] );
        }
    }

    /**
     * Create new ip.
     *
     * @param \App\Http\Requests\IpStoreRequest $request
     * @return \App\Http\Resources\IpResource
     * @return \Exception
     */
    public function store( IpStoreRequest $request )
    {
        try {
            return new IpResource($this->repository->create(
                array_merge( 
                    $request->only( ['ip', 'label']), 
                    ['user_id' => auth()->user()->id] 
                ) 
            ) );
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([ 'message' => 'Data not found.' ], 404);
        } catch (\Exception $e) {
            return response()->json([ 'status' => 'error', 'message' => $e->getMessage() ]);
        }
    }
    
    /**
     * Get specific ip.
     *
     * @param String $id
     * @return \App\Http\Resources\IpResource
     * @return \Exception
     */
    public function show( $id )
    {
        try {
            return new IpResource( $this->repository->find( $id )->load(['comments', 'comments.user']) );
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([ 'message' => 'Data not found.' ], 404);
        } catch (\Exception $e) {
            return response()->json([ 'status' => 'error', 'message' => $e->getMessage() ]);
        }
    }

    /**
     * Update specific ip.
     *
     * @param String $id
     * @param \App\Http\Requests\IpUpdateRequest $request
     * @return \App\Http\Resources\IpResource
     * @return \Exception
     */
    public function update( IpUpdateRequest $request, $id )
    {
        try {
            return new IpResource( $this->repository->update( $id, $request->only('label') ) );
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([ 'message' => 'Data not found.' ], 404);
        } catch (\Exception $e) {
            return response()->json([ 'status' => 'error', 'message' => $e->getMessage() ]);
        }
    }
}
