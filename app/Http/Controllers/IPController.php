<?php

namespace App\Http\Controllers;

use App\Http\Resources\IPResource;
use App\Http\Requests\IPStoreRequest;
use App\Http\Requests\IPUpdateRequest;
use App\Repositories\IP\IPRepository;

class IPController extends Controller
{
    private $repository;

    /**
     * Instantiate repository
     */
    public function __construct(IPRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get list of ip.
     *
     * @return \App\Http\Resources\IPResource
     * @return \Exception
     */
    public function get()
    {
        try {
            return new IPResource( $this->repository->all() );
        } catch (\Exception $e) {
            return response()->json( [ 'status' => 'error', 'message' => $e->getMessage() ] );
        }
    }

    /**
     * Create new ip.
     *
     * @param \App\Http\Requests\IPStoreRequest $request
     * @return \App\Http\Resources\IPResource
     * @return \Exception
     */
    public function store( IPStoreRequest $request )
    {
        try {
            return new IPResource( $this->repository->create( array_merge( $request->only( ['ip', 'label']), ['user_id' => auth()->user()->id] ) ) );
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
     * @return \App\Http\Resources\IPResource
     * @return \Exception
     */
    public function show( $id )
    {
        try {
            return new IPResource( $this->repository->find( $id ) );
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
     * @param \App\Http\Requests\IPUpdateRequest $request
     * @return \App\Http\Resources\IPResource
     * @return \Exception
     */
    public function update( IPUpdateRequest $request, $id )
    {
        try {
            return new IPResource( $this->repository->update( $id, $request->only('label') ) );
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([ 'message' => 'Data not found.' ], 404);
        } catch (\Exception $e) {
            return response()->json([ 'status' => 'error', 'message' => $e->getMessage() ]);
        }
    }
}
