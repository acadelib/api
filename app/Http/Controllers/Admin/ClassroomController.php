<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClassroomRequest;
use App\Http\Resources\Classroom as ClassroomResource;
use App\Models\Classroom;
use Illuminate\Database\Eloquent\Builder;

class ClassroomController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->authorizeResource(Classroom::class);
    }

    /**
     * Fetch all classrooms.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $classrooms = Classroom::whereHas('schoolYear', function (Builder $query) {
            $query->where('school_id', auth()->user()->profile->profileable->school_id);
        })->get();

        return ClassroomResource::collection($classrooms);
    }

    /**
     * Store a newly created classroom.
     *
     * @param  \App\Http\Requests\Admin\ClassroomRequest  $request
     * @return \App\Http\Resources\Classroom
     */
    public function store(ClassroomRequest $request)
    {
        $classroom = Classroom::create($request->only('school_year_id', 'name'));

        return new ClassroomResource($classroom);
    }

    /**
     * Display the specified classroom.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \App\Http\Resources\Classroom
     */
    public function show(Classroom $classroom)
    {
        return new ClassroomResource($classroom);
    }

    /**
     * Update the specified classroom.
     *
     * @param  \App\Http\Requests\Admin\ClassroomRequest  $request
     * @param  \App\Models\Classroom  $classroom
     * @return \App\Http\Resources\Classroom
     */
    public function update(ClassroomRequest $request, Classroom $classroom)
    {
        $classroom->update($request->only('school_year_id', 'name'));

        return new ClassroomResource($classroom);
    }

    /**
     * Remove the specified classroom.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Exception
     */
    public function destroy(Classroom $classroom)
    {
        $classroom->delete();

        return response()->json([], 204);
    }
}
