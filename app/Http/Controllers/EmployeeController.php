<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\File_Upload;

use DataTables;
use Illuminate\Support\Facades\Validator;
use App\Models\Project;
use Illuminate\Support\Facades\Log;
use DB;
use Illuminate\Support\Facades\Storage;
use Imagick;
use App\Http\Requests\EmployeeRequest;
use App\Traits\EmployeeTrait;
use Exception;
use App\DataTables\EmployeeDataTable;
use File;


class EmployeeController extends Controller
{
    use EmployeeTrait;

    public function index(Request $request, EmployeeDataTable $dataTable)

    {
        $project = Project::pluck('project_name', 'id');
        return $dataTable->render('employee.index', compact('project'));


    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        try {
            
            $response = $this->createOrUpdateEmployee($request->all(), $request->project, $request->employee_id, $request->file('filenames'));
            if ($response['status'] == 'success') {

                notify()->success($response['message'], $response['title']);
            }
            //return response()->json(['success' => 'Project Saved Successfully.']);
            //return redirect()->route('/employee');
            return redirect('/employee');

        } catch (Exception $e) {
            return response()->json($e);
        }
    
    }

    public function imagedelete(Request $request)
    {
        
        $filename = $request->filename;
        $employee_id = $request->employee_id;
        try {
            $response = $this->imagedeleteFile($filename, $employee_id);
            if ($response['status'] == 'success') {
                notify()->success($response['message'], $response['title']);
            }
        } catch (Exception $e) {
            return response()->json($e);
        }
       return redirect('/employee');

    }



/**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $editdata = Employee::findorfail($id);

        $data['selected_projects'] = $editdata->projects_many->pluck('id')->toArray();
        $projectselected = $editdata->projects_many->pluck('id')->toArray();
        $fileselected =$editdata->files_many->pluck('id')->toArray();
        $fileuploaded = File_Upload::whereIn('id', $fileselected)->get();
        $project = Project::pluck('project_name', 'id');
        return view('employee._edit', compact('editdata', 'project', 'projectselected', 'fileuploaded' ));
    }



/**
     * Unique validation for the name field.
     * @param  Request $request
     * @return [boolean]
     */
    public function uniqueValidation(Request $request)
    {   
        try {
            return $this->performUniqueValidationOfEmployee($request);
        } catch (Exception $e) {
            /*$response = handleExceptionAndLog($e, 'Customer', $this->account, $request, 'uniqueValidation() ');
            return response()->json($response);*/
            return response()->json($e);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Employee::find($id)->delete();
        return response()->json(['success'=>'Employee deleted successfully.']);
    }


}
