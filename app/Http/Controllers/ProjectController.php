<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use DataTables;
use Illuminate\Support\Facades\Validator;
use App\DataTables\ProjectDataTable;

class ProjectController extends Controller
{
    //
    public function index(Request $request)

    {

        if ($request->ajax()) {
            $data = Project::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProject">Edit</a>';
   
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProject">Delete</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);	
        }
      
        return view('project.index');

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


         $validator = Validator::make($request->all(), [
            'project_name' => 'required',
        ]);



    	  if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }


        Project::updateOrCreate(
        	['id' => $request->project_id],
                ['project_name' => $request->project_name]
            );        
   
        return response()->json(['success'=>'Project saved successfully.']);
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
     
        return response()->json(['success'=>'Project deleted successfully.']);
    }



}
