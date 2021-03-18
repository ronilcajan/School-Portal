<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FacultyModel;
use App\Models\StudentModel;
use App\Models\LoginModel;
use App\Models\FamilyModel;

class Profile extends BaseController
{
	public function profile()
	{
		
        $faculty = new FacultyModel();
        $student = new StudentModel();
        $fam = new FamilyModel();

        $id = session()->get('id');
        if(session()->get('user_type') == 'student'){
            $data['profile'] = $student->find($id);

            $data['section'] = $student->join('student_section', 'students.id=student_section.student_id')
                                        ->join('section', 'section.id=student_section.section_id')
                                        ->find($id);
        }else{
            $data['profile'] = $faculty->find($id);
        }
        $data['family'] = $fam->where('student_id',$id)->first();
		$data['title'] = "My Profile";
		return view('profile',$data);
    }
    
    public function updateProfile(){

        $data = [];
        
        if($this->request->getMethod() == 'post'){
            $id = session()->get('id');

            if(session()->get('user_type') == 'student'){
                $rules = [
                    'firstname' => 'required',
                    'lastname' => 'required',
                    'email' => 'required|is_unique[students.email,id,'.$id.']|valid_email',
                    'gender' => 'required',
                    'birthday' => 'required',
                    'phone' => 'required',
                    'street' => 'required',
                    'city' => 'required',
                    'province' => 'required',
                    'postal' => 'required',
                ];
            }else{
                $rules = [
                    'firstname' => 'required',
                    'lastname' => 'required',
                    'email' => 'required|is_unique[faculty.email,id,'.$id.']|valid_email',
                    'gender' => 'required',
                    'birthday' => 'required|validateFacultyBirthyear[birthday]',
                    'phone' => 'required',
                    'street' => 'required',
                    'city' => 'required',
                    'province' => 'required',
                    'postal' => 'required',
                ];
            }
            
            $errors = [
                'email' => [
                    'is_unique' => 'Email is already used, please enter a different email address!'
                ],
                'birthdate' => [
					'validateFacultyBirthyear' => 'Faculty birthyear must below 2000!'
				]
                ];

            if (!$this->validate($rules,$errors)) {

                $data['validation'] = $this->validator;

            }else{
                
                $student = new StudentModel();
                $faculty = new FacultyModel();
                if(session()->get('user_type') == 'student'){
                    $dtls = [
                        'id' => $id,
                        'firstname' => $this->request->getVar('firstname'),
                        'lastname' => $this->request->getVar('lastname'),
                        'email' => $this->request->getVar('email', FILTER_SANITIZE_EMAIL),
                        'gender' => $this->request->getVar('gender'),
                        'birthday' => $this->request->getVar('birthday'),
                        'phone' => $this->request->getVar('phone'),
                        'street' => $this->request->getVar('street'),
                        'city' => $this->request->getVar('city'),
                        'province' => $this->request->getVar('province'),
                        'postal' => $this->request->getVar('postal'),
                        'updated_at' => date('y-n-j G:i:s')
                    ];
                    $student->save($dtls);

                }else{
                    $dtls = [
                        'id' => $id,
                        'firstname' => $this->request->getVar('firstname'),
                        'lastname' => $this->request->getVar('lastname'),
                        'email' => $this->request->getVar('email', FILTER_SANITIZE_EMAIL),
                        'gender' => $this->request->getVar('gender'),
                        'birthdate' => $this->request->getVar('birthday'),
                        'phone' => $this->request->getVar('phone'),
                        'street' => $this->request->getVar('street'),
                        'city' => $this->request->getVar('city'),
                        'province' => $this->request->getVar('province'),
                        'postal' => $this->request->getVar('postal'),
                        'updated_at' => date('y-n-j G:i:s')
                    ];

                    $faculty->save($dtls);
                }

                
                $this->session->setFlashdata('success', 'Profile has been updated!');
                return redirect()->to(previous_url());
            }
            $this->session->setFlashdata('error',  $data['validation']->listErrors());
            return redirect()->to(previous_url());
        }
    }


    public function updateImg()
	{	
		$data = [];

		if ($this->request->getMethod() == 'post') {
            $id = session()->get('id');
			$rules = [
				'avatar' => 'is_image[avatar]',
				'cover' => 'is_image[cover]'
			];

			if (!$this->validate($rules)) {

				$data['validation'] = $this->validator;
				
			}else{

				$avatar = $this->request->getFile('avatar');
				$cover = $this->request->getFile('cover');
				
				if($avatar->isValid() || $cover->isValid()){

					if($avatar->isValid()){
						$newAvatarName = $avatar->getRandomName();
						$avatar->move('uploads', $newAvatarName);
						
						if($avatar->hasMoved()){
							$dtls = [
                                'id' => $id,
								'img' => $newAvatarName,
								'updated_at' => date('y-n-j G:i:s')
							];
						}
                    }
                    
					if($cover->isValid()){
						$newCoverName = $cover->getRandomName();
						$cover->move('uploads', $newCoverName);
					
						if($cover->hasMoved()){
							$dtls = [
                                'id' => $id,
								'cover' => $newCoverName,
								'updated_at' => date('y-n-j G:i:s')
							];
						}
					}
				}elseif($avatar->isValid() && $cover->isValid()){

					$newAvatarName = $avatar->getRandomName();
					$avatar->move('uploads', $newAvatarName);
					$newCoverName = $cover->getRandomName();
					$cover->move('uploads', $newCoverName);

					if($cover->hasMoved() && $avatar->hasMoved()){
						$dtls = [
                            'id' => $id,
							'img' => $newAvatarName,
							'cover' => $newCoverName,
							'updated_at' => date('y-n-j G:i:s')
						];
					}
				}

                $student = new StudentModel();
                $faculty = new FacultyModel();

                if(session()->get('user_type') == 'student'){
                    $update = $student->save($dtls);
                }else{
                    $update = $faculty->save($dtls);
                }

				if($update){
					$this->session->setFlashdata('success', 'Profile has been updated!');
					return redirect()->to(previous_url());
				}
			}
			$this->session->setFlashdata('error',  $data['validation']->listErrors());
			return redirect()->to(previous_url());
		}
    }
    
    public function changePass(){
        $data = [];

		if ($this->request->getMethod() == 'post') {
            $id = $this->request->getVar('login_id');

            $rules = [
                'login' => 'required',
                'password' => 'required|validateUser[login,password,user_type]',
                'new_pass' => 'required|min_length[8]',
                'conf_pass' => 'required|min_length[8]|matches[new_pass]',
			];

            $errors = [
                'conf_pass' => [
                    'matches' => 'Password did not match!',
                    'min_length' => 'Confirm password field must be at least 8 characters in length.'
                ],
                'new_pass' => [
                    'matches' => 'Password did not match!',
                    'min_length' => 'New password field must be at least 8 characters in length.'
                ],
                'password' => [
                    'validateUser' => "Current password is wrong!",
                ]
            ];

            if (!$this->validate($rules,$errors)) {

				$data['validation'] = $this->validator;
				
			}else{

                $model = new LoginModel();

                $dtls = [
                    'password' => password_hash($this->request->getVar('conf_pass'), PASSWORD_BCRYPT),
                    'updated_at' => date('y-n-j G:i:s')
                ];
                
                if(session()->get('user_type') == 'student'){
                    $update = $model->set($dtls)->where('id_number', $id)->update();
                }else{
                    $update = $model->set($dtls)->where('email', $id)->update();
                }

                if($update){
                    $this->session->setFlashdata('success', 'Password updated!');
					return redirect()->to(previous_url());
                }

            }
            $this->session->setFlashdata('error',  $data['validation']->listErrors());
			return redirect()->to(previous_url());
        }
    }

    public function updateFam(){
        $data = [];

		if ($this->request->getMethod() == 'post') {
            $id = $this->request->getVar('id');

            $rules = [
                'f_name' => 'required',
                'f_phone' => 'required',
                'f_email' => 'required',
                'f_address' => 'required',
                'm_name' => 'required',
                'm_phone' => 'required',
                'm_email' => 'required',
                'm_address' => 'required',

			];

            $errors = [
                'f_name' => [
                    'required' => "Father's name is required!",
                ],
                'f_phone' => [
                    'required' => "Phone is required!",
                ],
                'f_address' => [
                    'required' => "Address is required!",
                ],
                'f_email' => [
                    'required' => "Email addresss is required!",
                ],
                'm_name' => [
                    'required' => "Mothers's name is required!",
                ],
                'm_phone' => [
                    'required' => "Phone is required!",
                ],
                'm_address' => [
                    'required' => "Address is required!",
                ],
                'm_email' => [
                    'required' => "Email addresss is required!",
                ],
            ];

            if (!$this->validate($rules,$errors)) {

				$data['validation'] = $this->validator;
				
			}else{

                $model = new FamilyModel();

                $dtls = [
                    'id' => $this->request->getVar('fa_id'),
                    'student_id' => $this->request->getVar('studID'),
                    'f_name' => $this->request->getVar('f_name'),
                    'f_phone' => $this->request->getVar('f_phone'),
                    'f_email' => $this->request->getVar('f_email'),
                    'f_address' => $this->request->getVar('f_address'),
                    'm_name' => $this->request->getVar('m_name'),
                    'm_phone' => $this->request->getVar('m_phone'),
                    'm_email' => $this->request->getVar('m_email'),
                    'm_address' => $this->request->getVar('m_address'),
                    'updated_at' => date('y-n-j G:i:s')
                ];
                
                $update = $model->save($dtls);

                if($update){
                    $this->session->setFlashdata('success', 'Family Info has been updated!');
					return redirect()->to(previous_url());
                }

            }
            $this->session->setFlashdata('error',  $data['validation']->listErrors());
			return redirect()->to(previous_url());
        }
    }

	//--------------------------------------------------------------------

}
