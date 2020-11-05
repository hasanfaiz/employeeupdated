<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File_Upload extends Model
{
    use HasFactory;
    protected $table = 'file_upload';
    protected $fillable = ['id', 'file_type', 'file_name']; //, 


}
