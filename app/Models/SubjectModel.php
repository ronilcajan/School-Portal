<?php namespace App\Models;

use CodeIgniter\Model;

class SubjectModel extends Model{

    protected $table = 'subjects';
    protected $primaryKey = 'id';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['id','subject_code','subject','description','status','updated_at'];
    protected $deletedField  = 'deleted_at';

}