<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SchoolYearRequest;
use App\Http\Resources\SchoolYear as SchoolYearResource;
use App\Models\SchoolYear;

class SchoolYearController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->authorizeResource(SchoolYear::class);
    }

    /**
     * Fetch all school years.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $schoolYears = SchoolYear::where('school_id', auth()->user()->profile->profileable->school_id)->get();

        return SchoolYearResource::collection($schoolYears);
    }

    /**
     * Store a newly created school year.
     *
     * @param  \App\Http\Requests\Admin\SchoolYearRequest  $request
     * @return \App\Http\Resources\SchoolYear
     */
    public function store(SchoolYearRequest $request)
    {
        $schoolYear = SchoolYear::create(array_merge($request->only('started_at', 'ended_at'), [
            'school_id' => auth()->user()->profile->profileable->school_id,
        ]));

        return new SchoolYearResource($schoolYear);
    }

    /**
     * Display the specified school year.
     *
     * @param  \App\Models\SchoolYear  $schoolYear
     * @return \App\Http\Resources\SchoolYear
     */
    public function show(SchoolYear $schoolYear)
    {
        return new SchoolYearResource($schoolYear);
    }

    /**
     * Update the specified school year.
     *
     * @param  \App\Http\Requests\Admin\SchoolYearRequest  $request
     * @param  \App\Models\SchoolYear  $schoolYear
     * @return \App\Http\Resources\SchoolYear
     */
    public function update(SchoolYearRequest $request, SchoolYear $schoolYear)
    {
        $schoolYear->update($request->only('started_at', 'ended_at'));

        return new SchoolYearResource($schoolYear);
    }

    /**
     * Remove the specified school year.
     *
     * @param  \App\Models\SchoolYear  $schoolYear
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Exception
     */
    public function destroy(SchoolYear $schoolYear)
    {
        $schoolYear->delete();

        return response()->json([], 204);
    }
}
