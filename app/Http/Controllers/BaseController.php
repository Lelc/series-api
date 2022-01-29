<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class BaseController extends Controller
{
    protected $class;

    /**
     * index resource
     */
    public function index(Request $request)
    {
        return $this->class::paginate($request->per_page);
    }

    /**
     *
     */
    public function store(Request $request)
    {
        return response()->json($this->class::create($request->all()), 201);
    }

    /**
     * show specific resource
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
     * update specific resource
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
     * destroy specific resource
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
