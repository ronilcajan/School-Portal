<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FacultyModel;
use App\Models\StudentModel;
use App\Models\LoginModel;

class Login extends BaseController
{
	public function loginAttempt(){

		$data = [];

		if ($this->request->getMethod() == 'post') {

			if($this->request->getVar('user_type') == 'student'){

				$rules = [
					'login' => 'required|trim',
					'password' => 'required|validateUser[login,password,user_type]',
				];
				$errors = [
					'login' => [
						'required' => 'Student ID is required!'
					],
					'password' => [
						'validateUser' => 'ID number or Password don\'t match'
					]
				];
			}else{
				$rules = [
					'login' => 'required|trim',
					'password' => 'required|validateUser[login,password,user_type]',
				];
				$errors = [
					'login' => [
						'required' => 'Email Address is required!'
					],
					'password' => [
						'validateUser' => 'Email or Password don\'t match'
					]
				];
			}

			if (! $this->validate($rules, $errors)) {
				$data['validation'] = $this->validator;
			}else{
				$model = new LoginModel();
				$user_type = $this->request->getVar('user_type');
				if($user_type == 'student'){

					$user = $model->join('students', 'students.student_ID = login_portal.id_number')->where('id_number', $this->request->getVar('login'))
											->first();

					$this->setUserSession($user,$user_type);
					$this->session->setFlashdata("success", "Welcome aboard, ".$user['firstname'].' '.$user['lastname']);
					return redirect()->to('student/dashboard');
				}else{

					$user = $model->join('faculty', 'faculty.email = login_portal.email')->where('login_portal.email', $this->request->getVar('login'))
											->first();

					$this->setUserSession($user,$user_type);
					$this->session->setFlashdata("success", "Welcome aboard, ".$user['firstname'].' '.$user['lastname']);
					return redirect()->to('faculty/dashboard');
					
				}

			}
			$this->session->setFlashdata('error',  $data['validation']->listErrors());
			return redirect()->to(previous_url());

		}
	}
	private function setUserSession($user,$user_type){
		if($user_type=='student'){
			$data = [
				'id' => $user['id'],
				'firstname' => $user['firstname'],
				'lastname' => $user['lastname'],
				'id_number' => $user['student_ID'],
				'user_type' => $user['user_type'],
				'isLoggedIn' => true,
			];
		}else{
			$data = [
				'id' => $user['id'],
				'firstname' => $user['firstname'],
				'lastname' => $user['lastname'],
				'email' => $user['email'],
				'user_type' => $user['user_type'],
				'isLoggedIn' => true,
			];
		}
		

		session()->set($data);
		return true;
	}

	public function logout(){
		session()->destroy();
		return redirect()->to('/');
	}
	//--------------------------------------------------------------------

}
