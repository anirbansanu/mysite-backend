<?php

namespace App\Services;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProjectService
{
    public function getProjects(Request $request)
    {
        $search_query = $request->input('search_query','');
        $sort_by = $request->input('sort_by', 'updated_at');
        $sort_order = $request->input('sort_order', 'desc');
        $paginationLimit = $request->input('pagination_limit', config('app.pagination_limit'));

        $projects = Project::when($search_query, function ($query) use ($search_query) {
                $query->where('title', 'like', '%' . $search_query . '%')
                    ->orWhere('description', 'like', '%' . $search_query . '%');
            })
            ->orderBy($sort_by, $sort_order)
            ->paginate($paginationLimit);

        $projects->appends(['search_query' => $search_query, 'sort_by' => $sort_by, 'sort_order' => $sort_order]);
        return $projects;
    }


    public function getProjectById(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        return $project;
    }

    public function createProject($data)
    {
        $data['is_active'] = isset($data['is_active']) ? 1 : 0;
        $data['slug'] = Str::slug($data['title']) . '-' . mt_rand(1000, 9999);

        $project = Project::create($data);
        return $project;
    }

    public function updateProject(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $project->update($request->all());
        return $project;
    }

    public function deleteProject($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
    }
}
