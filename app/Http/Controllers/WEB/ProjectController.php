<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\ProjectCreateRequest;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\ProjectService;

class ProjectController extends Controller
{
    protected $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }
    public function index(Request $request)
    {
        try {
            $projects = $this->projectService->getProjects($request);
            return view('admin.Projects.index', compact('projects'));
        } catch (\Exception $e) {
            // Log the exception and handle it appropriately
            // Log::error('Error in ProjectController@index: ' . $e->getMessage());
            return $e;
        }
    }

    public function create()
    {
        return view('admin.Projects.create');
    }

    public function store(ProjectCreateRequest $request)
    {
        try {
            $data = $request->validated();
            $project = Project::create($data);
            if ($request->hasFile('image')) {
                $project->addMedia($request->file('image'))->toMediaCollection('project_images');
            }

            return redirect()->route('projects.index')->with('success', 'Project created successfully.');

        } catch (\Exception $e) {
            // Log::error('Error in ProjectController@store: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while creating the project.');
        }
    }

    public function edit(Project $project)
    {
        return view('admin.Projects.edit', compact('project'));
    }

    public function update(ProjectRequest $request, Project $project)
    {
        try {
            $data = $request->validated();
            $project->update($data);
            return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
        } catch (\Exception $e) {
            // Log::error('Error in ProjectController@update: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while updating the project.');
        }
    }

    public function destroy(Project $project)
    {
        try {
            $project->delete();
            return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
        } catch (\Exception $e) {
            // Log::error('Error in ProjectController@destroy: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while deleting the project.');
        }
    }

    public function toggleStatus($project, Request $request)
    {
        try {
            $project = Project::find($project);
            $project->is_active = $request->is_active == "1" ? "1" : "0";
            $project->save();
            $status = $request->is_active == "1" ? 'activated' : 'deactivated';
            return response()->json(['status' => true, 'msg' => "Project {$project->title} {$status} successfully", 'data' => $project]);
        } catch (\Exception $e) {
            // Log::error('Error in ProjectController@toggleStatus: ' . $e->getMessage());
            return response()->json(['status' => false, 'msg' => 'An error occurred while toggling project status.']);
        }
    }

    public function getJsonProjects(Request $request)
    {
        try {
            $query = $request->input('query');
            $projects = Project::where('title', 'like', "%$query%")->paginate(config('app.pagination_limit'));
            return response()->json($projects);
        } catch (\Exception $e) {
            // Log::error('Error in ProjectController@getJsonProjects: ' . $e->getMessage());
            return response()->json(['status' => false, 'msg' => 'An error occurred while fetching projects.']);
        }
    }
}
