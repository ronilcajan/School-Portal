<?php namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model{

    protected $table = 'login_portal';
    protected $primaryKey = 'id';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['id','email','id_number','password','user_type','updated_at'];
    protected $deletedField  = 'deleted_at';

}