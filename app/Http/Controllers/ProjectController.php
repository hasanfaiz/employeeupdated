<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use DataTables;
use Illuminate\Support\Facades\Validator;
use App\DataTables\ProjectDataTable;
use App\Http\Requests\ProjectRequest;
use App\Traits\ProjectTrait;
use Exception;

class ProjectController extends Controller
{
    use ProjectTrait;
    //
    public function index(Request $request, ProjectDataTable $dataTable)

    {
             return $dataTable->render('project.index');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        try {
            $response = $this->createOrUpdateProject($request->all(), $request->project_id);
            if ($response['status'] == 'success') {

                notify()->success($response['message'], $response['title']);
            }
            //return response()->json(['success' => 'Project Saved Successfully.']);
            return redirect()->route('/project');


        } catch (Exception $e) {
            return response()->json($e);
        }

    }

    /**
     * Unique validation for the name field.
     * @param  Request $request
     * @return [boolean]
     */
    public function uniqueValidation(Request $request)
    {
        try {
            return $this->performUniqueValidationOfProject($request);
        } catch (Exception $e) {
            /*$response = handleExceptionAndLog($e, 'Customer', $this->account, $request, 'uniqueValidation() ');
            return response()->json($response);*/
            return response()->json($e);
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::find($id);
        return response()->json($project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Project::find($id)->delete();

        return response()->json(['success' => 'Project deleted successfully.']);
    }
}
