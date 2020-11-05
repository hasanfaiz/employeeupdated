<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Employee extends Model
{
    use HasFactory;

    protected $table = 'employee';

    protected $fillable = [ 'emp_no', 'name', 'age', 'dob', 'position', 'address']; //, 

    public function setDobAttribute($value)
    {
        $this->attributes['dob'] = DateDisplayToDatabase($value);
    }


	public function getDobAttribute($value)
    {
        return DateDatabaseToDisplay($value,false,false);
    }

    public function projects_many()
    {
        return $this->belongsToMany('App\Models\Project', 'projects_many', 'emp_id', 'project_id');
    }

    public function files_many()
    {
        return $this->belongsToMany('App\Models\File_Upload', 'file_upload_many', 'emp_id', 'file_id');
    }


}
