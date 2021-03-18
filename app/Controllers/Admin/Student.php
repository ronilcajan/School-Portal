<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SubjectModel;
use App\Models\SectionModel;
use App\Models\StudentModel;
use App\Models\FamilyModel;
use App\Models\ActivityModel;

class Student extends BaseController
{
	public function index()
	{
		$model = new StudentModel();

		$data['students'] = $model
								->select('*, students.id as id,students.status as status,students.updated_at as updated_at')
								->join('student_section','students.id=student_section.student_id')
								->join('section','section.id=student_section.section_id')
								->findAll();
		$data['active'] = $model->where('status', 1)->findAll();
		$data['inactive'] = $model->where('status', 0)->findAll();

		$data['title'] = "Students";
		return view('admin/student/manage',$data);
	}

	public function create()
	{
		$section = new SectionModel();

		$data['section'] = $section->where('status',1)->findAll();
		$data['random_pass'] = $this->randomPassword();

 		$data['title'] = "Create Student";
		return view('admin/student/create_student',$data);
	}

	public function edit($id)
	{
		$student = new StudentModel();
		$section = new SectionModel();
		$fam = new FamilyModel();

		$data['section'] = $section->where('status',1)->findAll();

		$data['student'] = $student->select('*,students.status as status, students.id as id,student_section.section_id as section_id')
							->join('student_section','students.id=student_section.student_id')
							->join('section','section.id=student_section.section_id')
							->where('students.id', $id)->first();

		$data['family'] = $fam->where('student_id',$id)->first();

 		$data['title'] = "Edit Student";
		return view('admin/student/edit_student',$data);
	}

	public function submitStudent(){
		$data = [];
        
        if($this->request->getMethod() == 'post'){

            $rules = [
				'student_id' => 'required|is_unique[students.student_ID]',
				'firstname' => 'required',
				'lastname' => 'required',
				'email' => 'required|is_unique[students.email]|valid_email',
				'gender' => 'required',
				'birthdate' => 'required',
				'phone' => 'required',
				'street' => 'required',
				'city' => 'required',
				'province' => 'required',
				'postal' => 'required',
				'section_id' => 'required',
				'pass' => 'required',
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
				'student_id' => [
					'required' => 'The student id field is required.',
					'is_unique' => 'Student ID is already used, please enter a different student ID.'
				],
				'section_id' => [
					'required' => 'The section field is required.',
				],
				'email' => [
					'is_unique' => 'Email is already used, please enter a different email address!'
				],
				'f_name' => [
                    'required' => "Father's name is required!",
                ],
                'f_phone' => [
                    'required' => "Phone is required!",
                ],
                'f_address' => [
                    'required' => "Address is required!",
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
                    'required' => "Father's Email Address is required!",
                ],
				'f_email' => [
                    'required' => "Mothers's Email Address is required!",
                ],
			];

			if (!$this->validate($rules,$errors)) {

                $data['validation'] = $this->validator;

            }else{
                
				$model = new StudentModel();
				$fam = new FamilyModel();

				$dtls = [
					'student_ID' => $this->request->getVar('student_id'),
					'firstname' => $this->request->getVar('firstname'),
					'lastname' => $this->request->getVar('lastname'),
					'email' => $this->request->getVar('email', FILTER_SANITIZE_EMAIL),
					'gender' => $this->request->getVar('gender'),
					'birthday' => $this->request->getVar('birthdate'),
					'phone' => $this->request->getVar('phone'),
					'street' => $this->request->getVar('street'),
					'city' => $this->request->getVar('city'),
					'province' => $this->request->getVar('province'),
					'postal' => $this->request->getVar('postal'),
				];
				
				$insert = $model->insert($dtls);
				$student_id = $model->insertID; 

				if($insert){
					$family = [
						'student_id' =>  $student_id,
						'f_name' => $this->request->getVar('f_name'),
						'f_phone' => $this->request->getVar('f_phone'),
						'f_email' => $this->request->getVar('f_email'),
						'f_address' => $this->request->getVar('f_address'),
						'm_name' => $this->request->getVar('m_name'),
						'm_phone' => $this->request->getVar('m_phone'),
						'm_email' => $this->request->getVar('m_email'),
						'm_address' => $this->request->getVar('m_address'),
					];

					$fam->insert($family);

					$section = [
						'student_id' => $student_id,
						'section_id' => $this->request->getVar('section_id'),
					];

					$login_dtls = [
						'id_number' => $this->request->getVar('student_id'),
						'password' => password_hash($this->request->getVar('pass'), PASSWORD_BCRYPT),
						'user_type' => 'student'
					];

					$db = db_connect();
					$studentsection = $db->table('student_section');
					$studentsection->insert($section);

					$login = $db->table('login_portal');
					$login->insert($login_dtls);

					$this->session->setFlashdata('success', 'Student has been created!');
					return redirect()->to(previous_url());
				}
			}
			$this->session->setFlashdata('error',  $data['validation']->listErrors());
			return redirect()->to(previous_url());
		}
	}

	public function editStudent(){
		$data = [];
        
        if($this->request->getMethod() == 'post'){
			$id = $this->request->getVar('id');

            $rules = [
				'student_id' => 'required|is_unique[students.student_ID,id,'.$id.']',
				'firstname' => 'required',
				'lastname' => 'required',
				'email' => 'required|is_unique[students.email,id,'.$id.']|valid_email',
				'gender' => 'required',
				'birthdate' => 'required',
				'phone' => 'required',
				'street' => 'required',
				'city' => 'required',
				'province' => 'required',
				'postal' => 'required',
				'section_id' => 'required',
				'f_name' => 'required',
				'f_phone' => 'required',
				'f_email' => 'required',
				'f_address' => 'required',
				'm_name' => 'required',
				'm_phone' => 'required',
				'm_email' => 'required',
				'm_address' => 'required',
				'status' => 'required',
			];
			$errors = [
				'student_id' => [
					'required' => 'The student id field is required.',
					'is_unique' => 'Student ID is already used, please enter a different student ID.'
				],
				'section_id' => [
					'required' => 'The section field is required.',
				],
				'email' => [
					'is_unique' => 'Email is already used, please enter a different email address!'
				],
				'f_name' => [
                    'required' => "Father's name is required!",
                ],
                'f_phone' => [
                    'required' => "Phone is required!",
                ],
                'f_address' => [
                    'required' => "Address is required!",
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
				'status' => [
                    'required' => "Please select student status.",
                ],
				'm_email' => [
                    'required' => "Father's Email Address is required!",
                ],
				'f_email' => [
                    'required' => "Mothers's Email Address is required!",
                ],
			];

			if (!$this->validate($rules,$errors)) {

                $data['validation'] = $this->validator;

            }else{
                
				$model = new StudentModel();
				$fam = new FamilyModel();

				$dtls = [
					'id' => $id,
					'student_ID' => $this->request->getVar('student_id'),
					'firstname' => $this->request->getVar('firstname'),
					'lastname' => $this->request->getVar('lastname'),
					'email' => $this->request->getVar('email', FILTER_SANITIZE_EMAIL),
					'gender' => $this->request->getVar('gender'),
					'birthday' => $this->request->getVar('birthdate'),
					'phone' => $this->request->getVar('phone'),
					'street' => $this->request->getVar('street'),
					'city' => $this->request->getVar('city'),
					'province' => $this->request->getVar('province'),
					'postal' => $this->request->getVar('postal'),
					'status' => $this->request->getVar('status'),
					'updated_at' => date('y-n-j G:i:s')
				];
				
				$insert = $model->save($dtls);

				if($insert){

					$family = [
						'id' => $this->request->getVar('family_id'),
						'student_id' => $id,
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

					$fam->save($family);

					$db = db_connect();
					$section = $db->table('student_section')->where('student_id',$id)
																			->set(['section_id' => $this->request->getVar('section_id')])
																			->update();
					
						$login = $db->table('login_portal');
						
						$login->where('id_number', $this->request->getVar('studID'))
							->set(['id_number' => $this->request->getVar('student_id')])
							->update();

						if($this->request->getVar('pass') != ''){
						
							$login->where('id_number', $this->request->getVar('studID'))
							->set(['password' => password_hash($this->request->getVar('pass'), PASSWORD_BCRYPT)])
							->update();
						}
					

					$this->session->setFlashdata('success', 'Student has been updated!');
					return redirect()->to(previous_url());
				}
			}
			$this->session->setFlashdata('error',  $data['validation']->listErrors());
			return redirect()->to(previous_url());
		}
	}

	public function delete($id)
	{	
		$model = new StudentModel();
		if($id) {
			$delete = $model->delete($id);
			if($delete){
				$this->session->setFlashdata('error', 'Student has been deleted!');
				return redirect()->to(previous_url());
			}
		}
	}

	public function studentProfile($id='')
	{
		$model = new StudentModel();
		$fam = new FamilyModel();
		$activity = new ActivityModel();

		$data['students'] = $model
								->select('*, students.id as id')
								->join('student_section','students.id=student_section.student_id')
								->join('section','section.id=student_section.section_id')
								->join('group_section','group_section.section_id=section.id')
								->join('faculty_section','faculty_section.group_section_id=group_section.id')
								->where('students.id',$id)
								->find();

		$data['family'] = $fam->where('student_id', $id)->find();

		$data['subs'] = $model->join('student_section', 'students.id=student_section.student_id')
								->join('section','student_section.section_id=section.id')
								->join('group_section','section.id=group_section.section_id')
								->join('subjects','group_section.subject_id=subjects.id')
								->where('students.id',$id)
								->findAll();

		$data['activity'] = $activity->select('*, activity.description as desc')
										->join('activity_group', 'activity.id=activity_group.activity_id')
										->join('section','activity_group.section_id=section.id')
										->join('student_section', 'section.id=student_section.section_id')
										->join('students', 'students.id=student_section.student_id')
										->where('students.id',$id)
										->findAll();

		$data['title'] = "Student";
		return view('admin/student/student_profile',$data);
	}

	public function randomPassword() {
		$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < 8; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass); //turn the array into a string
	}

	//--------------------------------------------------------------------

}
