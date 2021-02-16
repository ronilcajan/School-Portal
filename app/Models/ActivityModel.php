<?php namespace App\Models;

use CodeIgniter\Model;

class ActivityModel extends Model{

    protected $table = 'activity';
    protected $primaryKey = 'id';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['id','title','description','file','status','faculty_id','updated_at'];
    protected $deletedField  = 'deleted_at';

}