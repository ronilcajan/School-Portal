<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FacultyModel;
use App\Models\FamilyModel;
use App\Models\ActivityModel;
use App\Models\StudentModel;
use App\Models\GradeModel;
use App\Models\SubjectModel;
use App\Models\ClearanceModel;

class Faculty extends BaseController
{
	public function index()
	{
		$data['title'] = "Faculty Portal";
		return view('login',$data);
	}

	public function dashboard()
	{
		$model = new StudentModel();
		$activity = new ActivityModel();
		$id = session()->get('id');
		$db = db_connect();

		$data['count_student'] = $model
								->join('student_section','students.id=student_section.student_id')
								->join('section','section.id=student_section.section_id')
								->join('group_section','group_section.section_id=section.id')
								->join('faculty_section','faculty_section.group_section_id=group_section.id')
								->where('faculty_section.faculty_id',$id)
								->countAll();
		
		$data['students'] = $model
								->select('*, students.id as id')
								->join('student_section','students.id=student_section.student_id')
								->join('section','section.id=student_section.section_id')
								->join('group_section','group_section.section_id=section.id')
								->join('faculty_section','faculty_section.group_section_id=group_section.id')
								->where('faculty_section.faculty_id',$id)
								->findAll();
		$data['inactiveStudents'] = $model
								->select('*, students.id as id')
								->join('student_section','students.id=student_section.student_id')
								->join('section','section.id=student_section.section_id')
								->join('group_section','group_section.section_id=section.id')
								->join('faculty_section','faculty_section.group_section_id=group_section.id')
								->where('faculty_section.faculty_id',$id)
								->whereNotIn('students.status',[1])
								->findAll();						
						
		$act = $db->query("SELECT * FROM activity_group WHERE faculty_id=$id");
		$data['count_act'] = $act->getResultArray();

		$data['students'] = $model
								->select('*, students.id as id')
								->join('student_section','students.id=student_section.student_id')
								->join('section','section.id=student_section.section_id')
								->join('group_section','group_section.section_id=section.id')
								->join('faculty_section','faculty_section.group_section_id=group_section.id')
								->where('faculty_section.faculty_id',$id)
								->findAll();
								

		$data['title'] = "Dashboard";
		return view('faculty/dashboard',$data);
	}

	public function students()
	{
		$model = new StudentModel();
		$id = session()->get('id');

		$data['students'] = $model
								->select('*, students.id as id')
								->join('student_section','students.id=student_section.student_id')
								->join('section','section.id=student_section.section_id')
								->join('group_section','group_section.section_id=section.id')
								->join('faculty_section','faculty_section.group_section_id=group_section.id')
								->where('faculty_section.faculty_id',$id)
								->findAll();

		$data['title'] = "Students";
		return view('faculty/student',$data);
	}

	public function clearance()
	{
		$model = new ClearanceModel();
        $student = new StudentModel();
		$id = session()->get('id');                          

		$data['clearance'] = $model
                                ->select('*, clearance.id as id, clearance.status as status, students.id as studID')
                                ->join('students','clearance.student_id=students.id')
								->where('clearance.faculty_id',$id)
                                ->findAll();

		$data['students'] = $student
								->select('*, students.id as id')
								->join('student_section','students.id=student_section.student_id')
								->join('section','section.id=student_section.section_id')
								->join('group_section','group_section.section_id=section.id')
								->join('faculty_section','faculty_section.group_section_id=group_section.id')
								->where('faculty_section.faculty_id',$id)
								->findAll();

		$data['title'] = "Clearance";
		return view('faculty/clearance',$data);
	}

	public function createClearance(){
        $data = [];
        
        if($this->request->getMethod() == 'post'){

            $rules = [
				'student_id' => 'required',
				'title' => 'required',
				'description' => 'required',
			];
			$errors = [
				'student_id' => [
					'required' => 'Student name is required!',
				],
				'title' => [
					'required' => 'Title is required!',
					
				],
				'description' => [
					'required' => 'Section description is required!',
					
				],
			];

			if (!$this->validate($rules,$errors)) {

                $data['validation'] = $this->validator;

            }else{
                
                $model = new ClearanceModel();
				$id = session()->get('id');

				$dtls = [
					'student_id' => $this->request->getVar('student_id'),
					'faculty_id' => $id,
					'title' => $this->request->getVar('title'),
					'description' => $this->request->getVar('description')
				];
				
				$insert = $model->save($dtls);

				if($insert){

					$this->session->setFlashdata('success', 'Clearance has been created!');
					return redirect()->to(previous_url());
				}
			}
			$this->session->setFlashdata('error',  $data['validation']->listErrors());
			return redirect()->to(previous_url());
		}
    }

	public function updateClearance(){
        $data = [];
        
        if($this->request->getMethod() == 'post'){

            $rules = [
				'student_id' => 'required',
				'title' => 'required',
				'description' => 'required',
			];
			$errors = [
				'student_id' => [
					'required' => 'Student name is required!',
				],
				'title' => [
					'required' => 'Title is required!',
					
				],
				'description' => [
					'required' => 'Section description is required!',
					
				],
			];

			if (!$this->validate($rules,$errors)) {

                $data['validation'] = $this->validator;

            }else{
                
                $model = new ClearanceModel();
               
				$dtls = [
                    'id' => $this->request->getVar('id'),
					'student_id' => $this->request->getVar('student_id'),
					'title' => $this->request->getVar('title'),
					'description' => $this->request->getVar('description'),
                    'status' => $this->request->getVar('status'),
                    'updated_at' => date('y-n-j G:i:s')
				];

				$update = $model->save($dtls);

				if($update){

					$this->session->setFlashdata('success', 'Clearance has been updated!');
					return redirect()->to(previous_url());
				}
			}
			$this->session->setFlashdata('error',  $data['validation']->listErrors());
			return redirect()->to(previous_url());
		}
    }

	public function deleteClearance($id)
	{	
		$model = new ClearanceModel();
		if($id) {
			$delete = $model->delete($id);
			if($delete){
				$this->session->setFlashdata('error', 'Clearance has been deleted!');
				return redirect()->to(previous_url());
			}
		}
	}

	public function clearanceDone()
	{	
		$validator = array('success' => false, 'msg' => array());

		$id = $this->request->getVar('id');
        $status = $this->request->getVar('status');

		$model = new ClearanceModel();
        $dtls = [
            'id' => $id,
            'status' => $status
        ];

		$secs = $model->save($dtls);

		$validator['success'] = true;
		$validator['msg'] = $secs;

		echo json_encode($validator);
	}

	public function myStudents($id='')
	{
		$faculty_id = session()->get('id');
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
										->where('activity_group.faculty_id',$faculty_id)
										->findAll();

		$data['title'] = "Student";
		return view('student_profile',$data);
	}


	public function activity()
	{
		$model = new ActivityModel();
		$id = session()->get('id');

		$data['activity'] = $model->select('activity_group.id as id, title,activity.description as description,section_year,section_name,start_date,deadline,activity_group.status')
									->join('activity_group','activity.id=activity_group.activity_id')
									->join('section', 'section.id=activity_group.section_id')
									->where('activity_group.faculty_id',$id)->findAll();
		$data['title'] = "Activities";
		return view('faculty/activity',$data);
	}

	public function newActivity()
	{
		$model = new ActivityModel();
		$id = session()->get('id');
		$db = db_connect();

		$data['activity'] = $model->where('faculty_id', $id)->findAll();
		$data['section'] = $db->query("SELECT group_section.section_id as id, section_name, section_year 
										FROM faculty_section 
										JOIN group_section ON faculty_section.group_section_id=group_section.id 
										JOIN section ON group_section.section_id=section.id
										JOIN subjects ON group_section.subject_id=subjects.id
										WHERE faculty_section.faculty_id=$id");

		$data['title'] = "Create Activities";
		return view('faculty/new_activity',$data);
	}

	public function grades()
	{
		$model = new FacultyModel();
		$id = session()->get('id');

		$data['students'] = $model
								->select('*, students.id as id, subjects.id as subject_id,grades.status as status, grades.id as grade_id')
								// ->join('student_section','students.id=student_section.student_id')
								// ->join('section','section.id=student_section.section_id')
								// ->join('group_section','group_section.section_id=section.id')
								// ->join('grades','group_section.subject_id=grades.subject_id','right')
								// ->join('subjects','subjects.id=group_section.subject_id')
								// ->join('faculty_section','faculty_section.group_section_id=group_section.id')
								// ->where('faculty_section.faculty_id',$id)
								->join('faculty_section','faculty_section.faculty_id=faculty.id')
								->join('group_section','group_section.id=faculty_section.group_section_id')
								->join('section','section.id=group_section.section_id')
								->join('subjects','subjects.id=group_section.subject_id')
								->join('student_section','student_section.section_id=group_section.section_id')
								->join('students','students.id=student_section.student_id')
								->join('grades','group_section.subject_id=grades.subject_id')
								->where('faculty.id',$id)
								->groupBy('grades.id')
								->findAll();
								
		$data['title'] = "Grades";
		return view('faculty/grades',$data);
	}

	public function saveGrade(){

		$validator = array('success' => false, 'msg' => array());
		$model = new GradeModel();

		$id = $this->request->getVar('grade_id');

		$dtls = [
			'id' => $id,
			'grade_1' => $this->request->getVar('grade1'),
			'grade_2' => $this->request->getVar('grade2'),
			'grade_3' => $this->request->getVar('grade3'),
			'grade_4' => $this->request->getVar('grade4'),
			'remarks' => $this->request->getVar('remarks'),
		];
	
		$insert = $model->save($dtls);
		
		if($insert){
			$validator['success'] = true;
			$validator['msg'] = $this->request->getVar('grade1');
		}
		echo json_encode($validator);
	}

	public function notifyGrade(){
		$validator = array('success' => false, 'msg' => array());
		$grade = new GradeModel();
		$faculty = new FacultyModel();
		$student = new StudentModel();
		$subject = new SubjectModel();

		$id = session()->get('id');
		$student_id =  $this->request->getVar('student_id');
		$subject_id =  $this->request->getVar('subject_id');
		$grade_id =  $this->request->getVar('grade_id');

		$facultyData = $faculty->find($id);
		$studentData = $student->find($student_id);
		$subjectData = $subject->find($subject_id);
		$gradeData = $grade->find($grade_id);

		$facultyEmail = $facultyData['email'];
		$facultyName = ucwords($facultyData['firstname'].' '.$facultyData['lastname']);
		$studentEmail = $studentData['email'];
		$subject = "Grade Notification for ".$subjectData['subject_code'].' '.$subjectData['subject'];
		
		$grade1 = $gradeData['grade_1'];
		$grade2 = $gradeData['grade_2'];
		$grade3 = $gradeData['grade_3'];
		$grade4 = $gradeData['grade_4'];
		$remarks = $gradeData['remarks'];

		if(!empty($grade1)){
			$grade1 = "1st Grading: ". $gradeData['grade_1'];
		}
		if(!empty($grade2)){
			$grade2 = ", 2nd Grading: ". $gradeData['grade_2'];
		}
		if(!empty($grade3)){
			$grade3 = ", 3rd Grading: ". $gradeData['grade_3'];
		}
		if(!empty($grade4)){
			$grade4 = ", 4th Grading: ". $gradeData['grade_4'];
		}
		if(!empty($grade4)){
			$remarks = ", Remarks: ". $gradeData['remarks'];
		}

		$message = "Hi ". ucwords($studentData['firstname'].' '.$studentData['lastname']).", this is a notification of your grade for ". $grade1.$grade2.$grade3.$grade4.$remarks.".";
		// $messagetext = $subjectData['subject'].' Grade for '.$grade1.$grade2.$grade3.$grade4.$remarks.".";
		
		$sendMail = $this->sendEmail($facultyEmail,$facultyName,$studentEmail,$subject,$message);

		// $sendText = $this->itexmo($studentData[0]['phone'],$messagetext);

		if($sendMail){
			$validator['success'] = true;
			$validator['msg'] = 'Grade notification has been sent!';
		}

		echo json_encode($validator);

	}

	public function notifyParents(){
		$validator = array('success' => false, 'msg' => array());
		$grade = new GradeModel();
		$family = new FamilyModel();
		$student = new StudentModel();
		$subject = new SubjectModel();
		$faculty = new FacultyModel();

		$id = session()->get('id');
		$student_id =  $this->request->getVar('student_id');
		$subject_id =  $this->request->getVar('subject_id');
		$grade_id =  $this->request->getVar('grade_id');

		$familyData = $family->where('student_id',$student_id)->find();
		$subjectData = $subject->find($subject_id);
		$gradeData = $grade->find($grade_id);
		$studentData = $student->find($student_id);
		$facultyData = $faculty->find($id);

		$facultyEmail = $facultyData['email'];
		$facultyName = ucwords($facultyData['firstname'].' '.$facultyData['lastname']);

		$grade1 = $gradeData['grade_1'];
		$grade2 = $gradeData['grade_2'];
		$grade3 = $gradeData['grade_3'];
		$grade4 = $gradeData['grade_4'];
		$remarks = $gradeData['remarks'];

		if(!empty($grade1)){
			$grade1 = "1st Grading: ". $gradeData['grade_1'];
		}
		if(!empty($grade2)){
			$grade2 = ", 2nd Grading: ". $gradeData['grade_2'];
		}
		if(!empty($grade3)){
			$grade3 = ", 3rd Grading: ". $gradeData['grade_3'];
		}
		if(!empty($grade4)){
			$grade4 = ", 4th Grading: ". $gradeData['grade_4'];
		}
		if(!empty($grade4)){
			$remarks = ", Remarks: ". $gradeData['remarks'];
		}

		// $messagetext = $subjectData['subject'].' Grades are '.$grade1.$grade2.$grade3.$grade4.".";

		$message = "Hi ". ucwords($familyData[0]['f_name']).", this is a grade notification for this subject : ".$grade1.$grade2.$grade3.$grade4.$remarks.".";
		
		$sendMail = $this->sendEmail($facultyEmail,$facultyName,$familyData[0]['f_email'],$subject,$message);

		// $sendText = $this->itexmo($familyData[0]['m_phone'],$messagetext);
		// $sendText1 = $this->itexmo($familyData[0]['f_phone'],$messagetext);

		if($sendMail){
			$validator['success'] = true;
			$validator['msg'] = 'Grade notification has been sent!';
		}
		echo json_encode($validator);

	}

	function sendEmail($from,$fromName,$to,$subject,$message){
		$email = \Config\Services::email();
		$email->setFrom($from, $fromName);
		$email->setTo($to);
		$email->setSubject($subject);
		$email->setMessage($message);
		$send = $email->send();
		if ($send) 
		{
            return true;
        } 
		else 
		{
            $data = $email->printDebugger(['headers']);
            return print_r($data);
        }
	}

	function itexmo($number,$message){
		$apicode = "TR-JAMES388231_ICE6W";
		$passwd = '2t&it61&gw';
		$ch = curl_init();
		$itexmo = array('1' => $number, '2' => $message, '3' => $apicode, 'passwd' => $passwd);
		curl_setopt($ch, CURLOPT_URL,"https://www.itexmo.com/php_api/api.php");
		curl_setopt($ch, CURLOPT_POST, 1);
		 curl_setopt($ch, CURLOPT_POSTFIELDS, 
				  http_build_query($itexmo));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		return curl_exec ($ch);
		curl_close ($ch);
	}

	public function submitActivty()
	{
		$data = [];

		if ($this->request->getMethod() == 'post') {

            $rules = [
                'activity' => 'required',
				'description' => 'required',
			];

            $errors = [
                'activity' => [
                    'required' => "Activity title is required!",
                ],
                'description' => [
                    'required' => "Activity description is required!",
                ],
            ];

            if (!$this->validate($rules,$errors)) {

				$data['validation'] = $this->validator;
				
			}else{

                $model = new ActivityModel();
				$file = $this->request->getFile('file');
				$id = session()->get('id');

				$dtls = [
					'title' => $this->request->getVar('activity'),
					'description' => $this->request->getVar('description'),
					'faculty_id' => $id
				];
				
				if(!empty($file)){
					if($file->isValid()){
						$newfileName = $file->getRandomName();
						$file->move('uploads', $newfileName);
						
						if($file->hasMoved()){
							$dtls = [
								'title' => $this->request->getVar('activity'),
								'description' => $this->request->getVar('description'),
								'file' => $newfileName,
								'faculty_id' => $id
							];
						}
					}

				}

                $insert = $model->save($dtls);

                if($insert){
                    $this->session->setFlashdata('success', 'New activity created!');
					return redirect()->to(previous_url());
                }

            }
            $this->session->setFlashdata('error',  $data['validation']->listErrors());
			return redirect()->to(previous_url());
        }
	}

	public function editActivty()
	{
		$data = [];

		if ($this->request->getMethod() == 'post') {

            $rules = [
                'activity' => 'required',
				'description' => 'required',
				'status' => 'required',
			];

            $errors = [
                'activity' => [
                    'required' => "Activity title is required!",
                ],
                'description' => [
                    'required' => "Activity description is required!",
				],
				'status' => [
                    'required' => "Activity status is required!",
                ],
            ];

            if (!$this->validate($rules,$errors)) {

				$data['validation'] = $this->validator;
				
			}else{

                $model = new ActivityModel();
				$file = $this->request->getFile('file');
				$id = $this->request->getVar('id');

				if($file!=''){
					if($file->isValid()){
						$newfileName = $file->getRandomName();
						$file->move('uploads', $newfileName);
						
						if($file->hasMoved()){

							$dtls = [
								'id' => $id,
								'title' => $this->request->getVar('activity'),
								'description' => $this->request->getVar('description'),
								'file' => $newfileName,
								'status' => $this->request->getVar('status'),
								'updated_at' => date('y-n-j G:i:s')
							];
							
						}
					}
				}else{

					$dtls = [
						'id' => $id,
						'title' => $this->request->getVar('activity'),
						'description' => $this->request->getVar('description'),
						'status' => $this->request->getVar('status'),
						'updated_at' => date('y-n-j G:i:s')
					];
				}
				
				$model->save($dtls);
				$this->session->setFlashdata('success', 'Activity has been updated!');
				return redirect()->to(previous_url());

            }
            $this->session->setFlashdata('error',  $data['validation']->listErrors());
			return redirect()->to(previous_url());
        }
	}

	public function deleteActivity($id){
		$model = new ActivityModel();
		if($id) {
			$delete = $model->delete($id);
			if($delete){
				$this->session->setFlashdata('error', 'Activity has been deleted!');
				return redirect()->to(previous_url());
			}
		}
	}

	public function getActivity(){
		$validator = array('success' => false, 'msg' => array());

		$model = new ActivityModel();

		$id = $this->request->getVar('id');

		$activity = $model->find($id);

		$validator['success'] = true;
		$validator['msg'] = $activity;

		echo json_encode($validator);
	}

	public function assignActivity(){
		$data = [];

		if ($this->request->getMethod() == 'post') {

            $rules = [
                'activity_id' => 'required',
				'sections_id' => 'required',
				'date_assgin' => 'required',
				'deadline' => 'required',
			];

            $errors = [
                'activity' => [
                    'required' => "Activity title is required!",
				],
				'sections_id' => [
                    'required' => "Select a section!",
				],
				'date_assgin' => [
                    'required' => "Activity date assgin is required!",
                ],
                'deadline' => [
                    'required' => "Activity deadline is required!",
                ],
            ];

            if (!$this->validate($rules,$errors)) {

				$data['validation'] = $this->validator;
				
			}else{

                $db = db_connect();
				$id = session()->get('id');

				$section = $this->request->getVar('sections_id');
				$group = array();
				foreach($section as $key=>$val){
						$group[] = array(
							'activity_id'=>$this->request->getVar('activity_id'), 
							'section_id'=> $val,
							'faculty_id'=> $id,
							'start_date'=> $this->request->getVar('date_assgin'),
							'deadline'=> $this->request->getVar('deadline'),
						);
				}

				$activity = $db->table('activity_group');
				$activity->insertBatch($group);

				$this->session->setFlashdata('success', 'Activity has been assigned!');
				return redirect()->to(previous_url());

			}
            $this->session->setFlashdata('error',  $data['validation']->listErrors());
			return redirect()->to(previous_url());
        }
	}

	public function changeActiStatus(){
		$validator = array('success' => false, 'msg' => array());
		$db = db_connect();
		$id = $this->request->getVar('id');
		$status = $this->request->getVar('status');

		if($status=='Delete'){
			$query = $db->query("DELETE FROM activity_group WHERE id=$id");
		}else{
			$query = $db->query("UPDATE activity_group SET `status`='$status' WHERE id=$id");
		}

		if($query){
			$validator['success'] = true;
			$validator['msg'] = 'Status has been changed!';
		}
		echo json_encode($validator);
	}
	public function getStudenttotal(){
		$validator = array('success' => false, 'total' => '','male' => '','female' => '');
		$db = db_connect();
		$id = $this->request->getVar('id');
		$status = $this->request->getVar('status');

		$total = $db->query("SELECT students.id as total
							FROM students 
							JOIN student_section ON students.id=student_section.student_id
							JOIN section ON section.id=student_section.section_id
							JOIN group_section ON group_section.section_id=section.id
							JOIN faculty_section ON faculty_section.group_section_id=group_section.id
							WHERE faculty_section.faculty_id=$id");
		$male = $db->query("SELECT students.id as male
							FROM students 
							JOIN student_section ON students.id=student_section.student_id
							JOIN section ON section.id=student_section.section_id
							JOIN group_section ON group_section.section_id=section.id
							JOIN faculty_section ON faculty_section.group_section_id=group_section.id
							WHERE students.gender='M' AND faculty_section.faculty_id=$id");
		$female = $db->query("SELECT students.id as female
							FROM students 
							JOIN student_section ON students.id=student_section.student_id
							JOIN section ON section.id=student_section.section_id
							JOIN group_section ON group_section.section_id=section.id
							JOIN faculty_section ON faculty_section.group_section_id=group_section.id
							WHERE students.gender='F' AND faculty_section.faculty_id=$id");

		if($male || $female || $total){
			$validator['success'] = true;
			$validator['total'] = count($total->getResultArray());
			$validator['male'] = count($male->getResultArray());
			$validator['female'] = count($female->getResultArray());
		}
		echo json_encode($validator);
	}
	//--------------------------------------------------------------------

}

