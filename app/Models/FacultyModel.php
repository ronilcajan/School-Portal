<?php namespace App\Models;

use CodeIgniter\Model;

class FacultyModel extends Model{

    protected $table = 'faculty';
    protected $primaryKey = 'id';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['id','email','firstname','lastname','gender','birthdate','phone','street','city','province','postal','status','img','cover','updated_at'];
    protected $deletedField  = 'deleted_at';

}