<?php namespace App\Models;

use CodeIgniter\Model;

class GradeModel extends Model{

    protected $table = 'grades';
    protected $primaryKey = 'id';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['id','student_id','subject_id','grade_1','grade_2','grade_3','grade_4','average','remarks','updated_at'];
    protected $deletedField  = 'deleted_at';

}