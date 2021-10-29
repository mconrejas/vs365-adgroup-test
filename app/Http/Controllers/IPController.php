<?php

namespace App\Http\Controllers;

use App\Http\Resources\IPResource;
use App\Http\Requests\IPStoreRequest;
use App\Http\Requests\IPUpdateRequest;
use App\Models\IP;
use Illuminate\Http\Request;

class IPController extends Controller
{
    /**
     * Get list of ip.
     *
     * @return \App\Http\Resources\IPResource
     * @return \Exception
     */
    public function get()
    {
        try {
            return new IPResource(IP::all());
        } catch (\Exception $e) {
            return response()->json([ 'status' => 'error', 'message' => $e->getMessage() ]);
        }
    }

    /**
     * Create new ip.
     *
     * @param \App\Http\Requests\IPStoreRequest $request
     * @return \App\Http\Resources\IPResource
     * @return \Exception
     */
    public function store(IPStoreRequest $request)
    {
        try {
            $ip = auth()->user()->load(['ips'])->ips()->updateOrCreate($request->only(['ip', 'label']));

            return new IPResource($ip);
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
    public function show($id)
    {
        try {
            return new IPResource(IP::findOrFail($id));
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
    public function update(IPUpdateRequest $request, $id)
    {
        try {
            $ip = IP::findOrFail($id);

            if( $request->label ) {
                $ip->update($request->only('label'));
            }

            return new IPResource($ip);
        } catch (\Exception $e) {
            return response()->json([ 'status' => 'error', 'message' => $e->getMessage() ]);
        }
    }
}
