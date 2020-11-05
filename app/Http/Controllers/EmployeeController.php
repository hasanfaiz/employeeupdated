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

class EmployeeController extends Controller
{
    public function index(Request $request)

    {

        if ($request->ajax()) {
            $data = Employee::latest()->get();



            return Datatables::of($data)
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editEmployee">Edit</a>';
   
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteEmployee">Delete</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);	
        }
      
      	


		$project = Project::latest()->get();


        return view('employee.index', compact('project'));

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
    	//dd($request->all());

         $validator = Validator::make($request->all(), [
            'name' => 'required'/*,
            'filenames' => 'required',

            'filenames.*' => 'required|mimes:jpeg,gif,png|max:2048'*/

        ]);


	  	if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        $employee = Employee::updateOrCreate(
        	['id' => $request->employee_id],
        	['emp_no' => $request->emp_no,
        	'name' => $request->name,
        	'age' => $request->age,
	       	'dob' => $request->dob,
	       	'address' => $request->address,
	       	'position' => $request->position]
	       );      

        $id = $employee->id;
        $employee1 = Employee::find($id);

        if (@$request->employee_id)
        {
      		$employee1->projects_many()->detach();
         	
      	}

      	if($request->file('filenames')) {
      		$employee1->files_many()->detach();
      	}
        
        $employee1->projects_many()->attach($request->project);
      	

  		/*  if($request->file()) {

        	$fileModel = new File_Upload;

			$fileName = time().'_'.$request->images->getClientOriginalName();
            $filePath = $request->images('file')->storeAs('uploads', $fileName, 'public');

            $fileModel->file_type=$request->images->getClientOriginalExtension();
            $fileModel->file_name = time().'_'.$request->images->getClientOriginalName();
            $fileModel->save();         

		}*/

		 $files = [];

        foreach($request->file('filenames', []) as $file)
        {
            $name = rand(). '.' . $file->getClientOriginalExtension();
            //$path = public_path() . '/uploads';
			$path = Storage::disk('public')->putFileAs('uploads', $file, $name);
            $file->move($path, $name);
			$fileUpload = new File_Upload();

	        $fileUpload->file_type = $file->getClientOriginalExtension();
            $fileUpload->file_name = $name;
            $fileUpload->save();
    		
    		//$fileup = File_Upload::find($id);
    		$employee1->files_many()->attach($fileUpload->id);



        }
 		     	//dd($id);



     	//dd($fileup->id);
         if (@$request->employee_id) {
    		return redirect('/employee');

         }
        return response()->json(['success'=>'Employee Saved Successfully.']); 	

	    
    }




/**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['employee'] = Employee::findorfail($id);
        $data['selected_projects'] = $data['employee']->projects_many->pluck('id')->toArray();
        $projectselected = $data['employee']->projects_many->pluck('id')->toArray();
        $fileselected =$data['employee']->files_many->pluck('id')->toArray();
        $fileuploaded = File_Upload::whereIn('id', $fileselected)->get();
  		$project = Project::latest()->get();
        return view('employee.edit', compact('editdata', 'project', 'projectselected', 'fileuploaded' ));
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
