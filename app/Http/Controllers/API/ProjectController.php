<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\ProjectService;
use Illuminate\Http\Response;

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
            return $this->apiResponse(Response::HTTP_OK, 'Projects retrieved successfully', $projects, null);
        } catch (\Exception $e) {
            return $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR, 'Something went wrong', null, $e->getMessage());
        }
    }

    public function show(Request $request, $id)
    {
        try {
            $project = $this->projectService->getProjectById($request, $id);
            if (!$project) {
                return $this->apiResponse(Response::HTTP_NOT_FOUND, 'Project not found', null, 'Project not found');
            }
            return $this->apiResponse(Response::HTTP_OK, 'Project retrieved successfully', $project, null);
        } catch (\Exception $e) {
            return $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR, 'Something went wrong', null, $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            // Validate the request data if needed

            $project = $this->projectService->createProject($request->all());
            return $this->apiResponse(Response::HTTP_CREATED, 'Project created successfully', $project, null);
        } catch (\Exception $e) {
            return $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR, 'Something went wrong', null, $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            // Validate the request data if needed

            $project = $this->projectService->updateProject($request, $id);
            return $this->apiResponse(Response::HTTP_OK, 'Project updated successfully', $project, null);
        } catch (\Exception $e) {
            return $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR, 'Something went wrong', null, $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->projectService->deleteProject($id);
            return $this->apiResponse(Response::HTTP_OK, 'Project deleted successfully', null, null);
        } catch (\Exception $e) {
            return $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR, 'Something went wrong', null, $e->getMessage());
        }
    }
}

