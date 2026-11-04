<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ResourceItem extends Model {
    protected $fillable = ['department_id','title','description','category','subject','subject_code','semester','academic_year','uploader_name','file_path','original_filename','file_size','status','downloads','is_featured'];
    public function department() { return $this->belongsTo(Department::class); }
}
