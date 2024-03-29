<?php
namespace App\Validation;
use App\Models\LoginModel;

class UserRules
{

  public function validateUser(string $str, string $fields, array $data){

    $model = new LoginModel();
    if($data['user_type'] == 'student'){
        $user = $model->where('id_number', $data['login'])
                  ->first();
    }else{
        $user = $model->where('email', $data['login'])
                  ->first();
    }
    
    if(!$user)
      return false;
    return password_verify($data['password'], $user['password']);
  }

  public function validateFacultyBirthyear(string $str, string $fields, array $data){

      $year = date('Y', strtotime($data['birthdate']));

      if($year > 2000){
        return false;
      }else{
        return true;
      }
  }

}