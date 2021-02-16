<?php namespace App\Models;

use CodeIgniter\Model;

class FamilyModel extends Model{

    protected $table = 'family';
    protected $primaryKey = 'id';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['id','student_id','f_name','f_phone','f_address','m_name','m_phone','m_address','updated_at'];
    protected $deletedField  = 'deleted_at';

}