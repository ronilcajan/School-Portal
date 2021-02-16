<?php namespace App\Models;

use CodeIgniter\Model;

class ProfileModel extends Model{

    protected $table = 'user_profile';
    protected $primaryKey = 'id';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['id','user_id','name','email','phone','address','bio','img','cover','updated_at'];
    protected $deletedField  = 'deleted_at';

}