<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Myth\Auth\Models\UserModel;
use App\Models\StudentModel;
use App\Models\FacultyModel;
use App\Models\SubjectModel;
use App\Models\SectionModel;
use App\Models\ActivityModel;

class Dashboard extends BaseController
{
	public function index()
	{
		$user = new UserModel();
		$student = new StudentModel();
		$faculty = new FacultyModel();
		$subject = new SubjectModel();
		$section = new SectionModel();

		$data['student'] = $student->countAll();
		$data['active_student'] = $student->where('status', 1)->countAll();
		$data['faculty'] = $faculty->countAll();
		$data['active_faculty'] = $faculty->where('status', 1)->countAll();
		$data['subject'] = $subject->countAll();
		$data['active_subject'] = $subject->where('status', 1)->countAll();
		$data['section'] = $section->countAll();
		$data['active_section'] = $section->where('status', 1)->countAll();

		$data['users'] = $user->select('users.id as id, user_profile.name as name, username, users.email as email, address, auth_groups.name as role')
								->join('user_profile', 'users.id=user_profile.user_id')
								->join('auth_groups_users', 'auth_groups_users.user_id=users.id')
								->join('auth_groups', 'auth_groups.id=auth_groups_users.group_id')
								->whereNotIn('users.id',[user_id()])
								->findAll();
								
		$data['title'] = "Dashboard";
		return view('admin/dashboard',$data);
	}

	public function register()
	{	
		$data['title'] = \ucfirst('Create User');
		return view('admin/register', $data);

	}

	public function delete_users()
	{	
		$userid 	= explode(',',$this->request->getVar('id'));
		
		$userModel = new UserModel();

		$delete = $userModel->delete($userid);

		if($delete){
			$this->session->setFlashdata('success', 'User/s has been deleted!');
			return redirect()->to(previous_url());
		}
	}
	public function changeRole()
	{	
		$validator = array('success' => false, 'msg' => array());

		$user_id = $this->request->getVar('id');
		$user_role = $this->request->getVar('role');

		$db = db_connect();
		$query = $db->query("UPDATE auth_groups_users SET group_id=$user_role WHERE user_id=$user_id");

		if($query){
			$validator['success'] = true;
			$validator['msg'] = 'User role has been changed!';
		}
		echo json_encode($validator);
	}

	public function activity(){
		$model = new ActivityModel();

		$data['activity'] = $model->select('activity_group.id as id, title,activity.description as description,section_year,section_name,start_date,deadline,activity_group.status')
									->join('activity_group','activity.id=activity_group.activity_id')
									->join('section', 'section.id=activity_group.section_id')
									->findAll();

		$data['title'] = "Activities";
		return view('admin/activity',$data);
	}

	//--------------------------------------------------------------------

}
