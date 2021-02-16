<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ClearanceModel;
use App\Models\StudentModel;

class Clearance extends BaseController
{
	public function index()
	{
		$model = new ClearanceModel();
        $student = new StudentModel();

		$data['clearance'] = $model
                                ->select('*, clearance.id as id, clearance.status as status, students.id as studID')
                                ->join('students','clearance.student_id=students.id')
                                ->findAll();

		$data['students'] = $student
								->select('*, students.id as id')
								->join('student_section','students.id=student_section.student_id')
								->join('section','section.id=student_section.section_id')
								->findAll();

		$data['title'] = "Clearance";
		return view('admin/clearance/manage',$data);
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
				$dtls = [
					'student_id' => $this->request->getVar('student_id'),
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

    public function delete($id)
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

}