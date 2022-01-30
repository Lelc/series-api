<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * BaseController
 */
abstract class BaseController extends Controller
{
    protected $class;

    /**
     * Index resources
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response()->json($this->class::paginate($request->per_page));
    }

    /**
     * Store resource
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return response()->json($this->class::create($request->all()), 201);
    }

    /**
     * Show resource
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $resource = $this->class::find($id);
        if (!$resource) {
            return response()->json('', 204);
        }

        return response()->json($resource);
    }

    /**
     * Update resource
     *
     * @param int $id
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(int $id, Request $request)
    {
        $resource = $this->class::find($id);
        if (!$resource) {
            return response()->json(['error' => 'Resource not found'], 404);
        }
        $resource->fill($request->all());
        $resource->save();

        return response()->json($resource);
    }

    /**
     * Destroy resource
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $deletedResource = $this->class::destroy($id);
        if ($deletedResource === 0) {
            return response()->json(['error' => 'Resource not found'], 404);
        }

        return response()->json('', 204);
    }
}
