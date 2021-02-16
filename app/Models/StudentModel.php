<?php namespace App\Models;

use CodeIgniter\Model;

class StudentModel extends Model{

    protected $table = 'students';
    protected $primaryKey = 'id';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['id','student_ID','firstname','lastname','email','gender','birthday','phone','street','city','province','postal','img','cover','updated_at'];
    protected $deletedField  = 'deleted_at';

}