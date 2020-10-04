<?php

namespace App\Http\Requests\Admin;

use App\Models\SchoolYear;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClassroomRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'school_year_id' => ['required', Rule::in(SchoolYear::where('school_id', $this->user()->profile->profileable->school_id)->pluck('id'))],
            'name' => 'required',
        ];
    }
}
