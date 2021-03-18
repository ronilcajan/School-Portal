<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SubjectModel;
use App\Models\SectionModel;
use App\Models\FacultyModel;
use App\Models\Faculty_sectionModel;
use App\Models\ActivityModel;
use App\Models\StudentModel;
use App\Models\FamilyModel;

class Faculty extends BaseController
{
	public function index()
	{
		$model = new FacultyModel();

		$data['faculty'] = $model->findAll();
		$data['active'] = $model->where('status', 1)->findAll();
		$data['inactive'] = $model->where('status', 0)->findAll();

		$data['title'] = "Faculty";
		return view('admin/faculty/manage',$data);
	}

	public function create()
	{
		$subject = new SubjectModel();

		$data['subjects'] = $subject->where('status',1)->findAll();
		$data['random_pass'] = $this->randomPassword();
 		$data['title'] = "Create Faculty";
		return view('admin/faculty/create_faculty',$data);
	}

	public function edit($id)
	{
		$model = new FacultyModel();
		$subject = new SubjectModel();

		$db = db_connect();
		$data['sections'] = $db->query("SELECT group_section.subject_id as id, group_section.id as group_id, section_name, section_year FROM faculty_section 
												JOIN group_section ON faculty_section.group_section_id=group_section.id JOIN section ON group_section.section_id=section.id
												JOIN subjects ON group_section.subject_id=subjects.id
												WHERE faculty_section.faculty_id=$id");
		$data['faculty'] = $model->find($id);
		$data['subjects'] = $subject->where('status',1)->findAll();

 		$data['title'] = "Create Faculty";
		return view('admin/faculty/update',$data);
	}

	public function submitCreate(){
        $data = [];
        
        if($this->request->getMethod() == 'post'){

            $rules = [
				'email' => 'required|is_unique[faculty.email]|valid_email',
				'firstname' => 'required',
				'lastname' => 'required',
				'gender' => 'required',
				'birthdate' => 'required|validateFacultyBirthyear[birthdate]',
				'phone' => 'required',
				'street' => 'required',
				'city' => 'required',
				'province' => 'required',
				'postal' => 'required'
			];
			$errors = [
				'email' => [
					'is_unique' => 'Email is already used, please enter a different email address!'
				],
				'birthdate' => [
					'validateFacultyBirthyear' => 'Birth year is below 2000. Please select above that year!'
				]
				];

			if (!$this->validate($rules,$errors)) {

                $data['validation'] = $this->validator;

            }else{
                
                $model = new FacultyModel();
				$dtls = [
					'email' => $this->request->getVar('email', FILTER_SANITIZE_EMAIL),
					'firstname' => $this->request->getVar('firstname'),
					'lastname' => $this->request->getVar('lastname'),
					'gender' => $this->request->getVar('gender'),
					'birthdate' => $this->request->getVar('birthdate'),
					'phone' => $this->request->getVar('phone'),
					'street' => $this->request->getVar('street'),
					'city' => $this->request->getVar('city'),
					'province' => $this->request->getVar('province'),
					'postal' => $this->request->getVar('postal'),
				];
				
				$insert = $model->insert($dtls);
				$faculty_id = $model->insertID; 

				if($insert){

					$section = $this->request->getVar('group_section_id');
					$group = array();
					foreach($section as $key=>$val){
						  $group[] = array('faculty_id'=>$faculty_id, 'group_section_id'=>$val);
					}
					$login_dtls = [
						'email' => $this->request->getVar('email'),
						'password' => password_hash($this->request->getVar('pass'), PASSWORD_BCRYPT),
						'user_type' => 'faculty'
					];

					$db = db_connect();
					$faculty_section = $db->table('faculty_section');
					$faculty_section->insertBatch($group);

					$faculty_section = $db->table('login_portal');
					$faculty_section->insert($login_dtls);

					$this->session->setFlashdata('success', 'Faculty has been created!');
					return redirect()->to(previous_url());
				}
			}
			$this->session->setFlashdata('error',  $data['validation']->listErrors());
			return redirect()->to(previous_url());
		}
		
	}

	public function updateCreate(){
        $data = [];
        
        if($this->request->getMethod() == 'post'){
			$id = $this->request->getVar('id');
            $rules = [
				'email' => 'required|is_unique[faculty.email,id,'.$id.']|valid_email',
				'firstname' => 'required',
				'lastname' => 'required',
				'gender' => 'required',
				'birthdate' => 'required|validateFacultyBirthyear[birthdate]',
				'phone' => 'required',
				'street' => 'required',
				'city' => 'required',
				'province' => 'required',
				'postal' => 'required',
				'status' => 'required',
			];
			$errors = [
				'email' => [
					'is_unique' => 'Email is already used, please enter a different email address!'
				],
				'status' => [
                    'required' => "Please select faculty status.",
                ],
				'birthdate' => [
					'validateFacultyBirthyear' => 'Faculty birthyear must below 2000!'
				]
			];

			if (!$this->validate($rules,$errors)) {

                $data['validation'] = $this->validator;

            }else{
                
                $model = new FacultyModel();
				$dtls = [
					'id' => $id,
					'email' => $this->request->getVar('email', FILTER_SANITIZE_EMAIL),
					'firstname' => $this->request->getVar('firstname'),
					'lastname' => $this->request->getVar('lastname'),
					'gender' => $this->request->getVar('gender'),
					'birthdate' => $this->request->getVar('birthdate'),
					'phone' => $this->request->getVar('phone'),
					'street' => $this->request->getVar('street'),
					'city' => $this->request->getVar('city'),
					'province' => $this->request->getVar('province'),
					'postal' => $this->request->getVar('postal'),
					'status' => $this->request->getVar('status'),
					'updated_at' => date('y-n-j G:i:s')
				];
				
				$update = $model->save($dtls);

				if($update){

					$db = db_connect();

					$section = $this->request->getVar('group_section_id');
					$group = array();
					foreach($section as $key=>$val){
						$group[] = array('faculty_id'=>$id, 'group_section_id'=>$val);
					}

					$table = $db->table('faculty_section');
					$table->delete(['faculty_id' => $id]);

					$table->insertBatch($group);

					$login = $db->table('login_portal');

					$login->where('email', $this->request->getVar('oldEmail'))
							->set(['email' => $this->request->getVar('email')])
							->update();

					if($this->request->getVar('pass') != ''){
						
						$login->where('email', $this->request->getVar('oldEmail'))
						->set(['password' => password_hash($this->request->getVar('pass'), PASSWORD_BCRYPT)])
						->update();
					}

					$this->session->setFlashdata('success', 'Faculty has been updated!');
					return redirect()->to(previous_url());
				}
			}

			$this->session->setFlashdata('error',  $data['validation']->listErrors());
			return redirect()->to(previous_url());
		}
		
	}

	public function selectSection()
	{	
		$validator = array('success' => false, 'msg' => array());

		$id = $this->request->getVar('id');

		$section = new SectionModel();

		$secs = $section
				->select('group_section.id as id, section_name, section_year')
				->join('group_section','group_section.section_id=section.id')
				->where('group_section.subject_id',$id)->findAll();

		$validator['success'] = true;
		$validator['msg'] = $secs;

		echo json_encode($validator);
	}

	public function delete($id)
	{	
		$model = new FacultyModel();
		if($id) {
			$delete = $model->delete($id);
			if($delete){
				$this->session->setFlashdata('error', 'The faculty has been deleted!');
				return redirect()->to(previous_url());
			}
		}
	}

	public function facultyInfo($id)
	{	
		$model = new FacultyModel();
		$student = new StudentModel();
		$db = db_connect();

		$section = $db->query("SELECT section_name, section_year, subject_code,`subject` FROM faculty_section 
												JOIN group_section ON faculty_section.group_section_id=group_section.id JOIN section ON group_section.section_id=section.id
												JOIN subjects ON group_section.subject_id=subjects.id
												WHERE faculty_section.faculty_id=$id");
		$data['section'] = $section->getResultArray();										
		$data['faculty'] = $model->find($id);

		$data['students'] = $student
								->select('*, students.id as id')
								->join('student_section','students.id=student_section.student_id')
								->join('section','section.id=student_section.section_id')
								->join('group_section','group_section.section_id=section.id')
								->join('faculty_section','faculty_section.group_section_id=group_section.id')
								->where('faculty_section.faculty_id',$id)
								->findAll();

		$data['title'] = "Faculty";
		return view('admin/faculty/faculty_profile',$data);
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
