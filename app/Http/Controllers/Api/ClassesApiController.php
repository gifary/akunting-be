<?php

namespace App\Http\Controllers\Api;

use App\Filters\ClassFilters;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ClassesRequest;
use App\Http\Resources\ClassResource;
use App\Loaders\ClassLoaders;
use App\Models\Classes;


class ClassesApiController extends Controller
{

    public function index(ClassFilters $filters)
    {
        $classes = Classes::filter($filters);

        return ClassResource::collection($classes);
    }

    public function store(ClassesRequest $request)
    {
        return new ClassResource($request->persist());
    }

    public function show($id, ClassLoaders $loaders)
    {
        $classes = Classes::findOrFail($id);

        return new ClassResource($classes->filter($loaders));
    }

    public function update(ClassesRequest $request, $id)
    {
        $classes = Classes::findOrFail($id);

        return new ClassResource($request->persist($classes));
    }

    public function destroy($id)
    {
        $classes = Classes::findOrFail($id);

        $classes->delete();

        return response()->json([], 204);
    }

    public function restore($id)
    {
        $class = Classes::withTrashed()->where('id',$id)->restore();

        return response()->json([], 204);
    }
}
