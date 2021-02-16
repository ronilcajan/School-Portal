<?php namespace App\Models;

use CodeIgniter\Model;

class ClearanceModel extends Model{

    protected $table = 'clearance';
    protected $primaryKey = 'id';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['id','student_id','faculty_id','title','description','status','updated_at'];
    protected $deletedField  = 'deleted_at';

}