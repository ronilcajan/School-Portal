<?php namespace App\Models;

use CodeIgniter\Model;

class SectionModel extends Model{

    protected $table = 'section';
    protected $primaryKey = 'id';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['id','section_name','section_year','description','status','updated_at'];
    protected $deletedField  = 'deleted_at';

}