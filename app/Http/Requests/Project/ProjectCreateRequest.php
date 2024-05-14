<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;

class ProjectCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => 'required|array',
            'title' => 'required|string',
            'badges' => 'required|array',
            'project_link' => 'required|url',
            'github_link' => 'required|url',
            'desc' => 'required',
            'image' => 'image|mimes:jpeg,png,svg,gif|max:10240', // Max 10MB file size
        ];
    }

    
}
