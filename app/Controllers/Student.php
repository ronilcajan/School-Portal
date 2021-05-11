<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StudentModel;
use App\Models\ActivityModel;
use App\Models\FacultyModel;
use App\Models\SectionModel;

class Student extends BaseController
{
	public function index()
	{

		$data['title'] = "Student Portal";
		return view('login',$data);
	}

	public function dashboard()
	{
		$model = new StudentModel();
		$activity = new ActivityModel();
		$id = session()->get('id');
		$db = db_connect();
		
		$class = $model->join('student_section','students.id=student_section.student_id')
							->where('students.id',$id)->find();
		$subject_id = $class[0]['section_id'];

		$numClass = $db->query("SELECT * FROM student_section WHERE section_id=$subject_id");
		
		$data['class'] = $numClass->getResultArray();
		
		$data['activity'] = $activity->select('*, activity.description as desc,activity_group.id as actID')
								->join('activity_group', 'activity.id=activity_group.activity_id')
								->join('student_section', 'activity_group.section_id=student_section.section_id')
								->join('students', 'students.id=student_section.student_id')
								->join('section', 'student_section.section_id=section.id')
								->join('section_subjects', 'section_subjects.section_id=section.id')
								->join('subjects', 'subjects.id=section_subjects.subject_id')
								->where('students.id',$id)
								->findAll();

		$data['subs'] = $model->select('*,section_subjects.id as group_id')
								->join('student_section', 'students.id=student_section.student_id')
								->join('section','student_section.section_id=section.id')
								->join('section_subjects','section.id=section_subjects.section_id')
								->join('subjects','section_subjects.subject_id=subjects.id')
								->where('students.id',$id)
								->findAll();

		$data['title'] = "My Dashboard";
		return view('student/dashboard',$data);
	}

	public function subjects()
	{
		$model = new StudentModel();
		$activity = new ActivityModel();
		$id = session()->get('id');

		$data['subs'] = $model->select('*,faculty.id as faculty')
								->join('student_section', 'students.id=student_section.student_id')
								->join('section','student_section.section_id=section.id')
								->join('section_subjects','section.id=section_subjects.section_id')
								->join('subjects','section_subjects.subject_id=subjects.id')
								->join('faculty_section','faculty_section.subject_id=subjects.id')
								->join('faculty','faculty_section.faculty_id=faculty.id')
								->where('students.id',$id)
								->findAll();
		
		$data['activity'] = $activity->select('*, activity.description as desc,activity_group.id as actID')
								->join('activity_group', 'activity.id=activity_group.activity_id')
								->join('student_section', 'activity_group.section_id=student_section.section_id')
								->join('students', 'students.id=student_section.student_id')
								->join('section', 'student_section.section_id=section.id')
								->join('section_subjects', 'section_subjects.section_id=section.id')
								->join('subjects', 'subjects.id=section_subjects.subject_id')
								->where('students.id',$id)
								->findAll();

		$data['title'] = "My Subjects";
		return view('student/subjects',$data);
	}

	public function grades()
	{
		$model = new StudentModel();
		$section = new SectionModel();
		$id = session()->get('id');

		$data['grades'] = $model
								->join('grades','students.id=grades.student_id')
								->join('subjects','subjects.id=grades.subject_id')
								->join('section_subjects','section_subjects.subject_id=subjects.id')
								->join('section','section_subjects.section_id=section.id')
								->where('grades.student_id',$id)
								->findAll();

		$data['school_year'] = $section->select('school_year')->findAll();

		$data['title'] = "My Grades";
		return view('student/grades',$data);
	}

	public function changeActiStatus(){
		$validator = array('success' => false, 'msg' => array());
		$db = db_connect();
		$id = session()->get('id');
		$actID = $this->request->getVar('actID');
		$status = $this->request->getVar('status');
		
		$check = $db->query("SELECT * FROM activity_status WHERE activity_id=$actID AND student_id=$id");
		$act = $check->getResultArray();

		if(count($act) > 0){
			$query = $db->query("UPDATE activity_status SET `status`='$status' WHERE activity_id=$actID AND student_id=$id");
		}else{
			$query = $db->query("INSERT INTO activity_status (activity_id,student_id,`status`) VALUES ($actID,$id,'$status')");
		}
		
		if($query){
			$validator['success'] = true;
			$validator['msg'] = 'Status has been changed!';
		}
		echo json_encode($validator);
	}

	public function getFaculty(){
		$validator = array('success' => false, 'name' => array(),'phone' => array(),'email' => array(),'img' => array());
		$id = session()->get('id');
		$faculty = $this->request->getVar('id');

		$model = new FacultyModel();
		
		$query = $model->find($faculty);
		
		if($query){
			$validator['success'] = true;
			$validator['name'] = $query['firstname'].' '.$query['lastname'];
			$validator['phone'] = $query['phone'];
			$validator['email'] = $query['email'];
			$validator['img'] = $query['img'];

		}
		echo json_encode($validator);
	}

	//--------------------------------------------------------------------
	
}
