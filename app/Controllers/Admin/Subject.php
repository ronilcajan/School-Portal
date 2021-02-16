<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SubjectModel;

class Subject extends BaseController
{
	public function index()
	{
		$subject = new SubjectModel();

		$data['subjects'] = $subject->findAll();
		$data['active'] = $subject->where('status', 1)->findAll();
		$data['inactive'] = $subject->where('status', 0)->findAll();
		
		$data['title'] = "Subjects";
		return view('admin/subjects/manage',$data);
    }
    
    public function create()
	{
		$data = [];

		if ($this->request->getMethod() == 'post') {
			$rules = [
				'subject_code' => 'is_unique[subjects.subject_code]|required|max_length[255]',
				'subject' => 'required|max_length[255]',
				'description' => 'required|max_length[255]',
			];
			$errors = [
				'subject_code' => [
                    'required' => 'Subject code is required!',
                    'is_unique' => 'Subject code is already in used!'
				],
				'subject' => [
					'required' => 'Subject name is required!'
				],
				'description' => [
					'required' => 'Subject description is required!'
				]
			];
            
			if (!$this->validate($rules,$errors)) {

				$data['validation'] = $this->validator;
				
			}else{

				$dtls = [
					'subject_code' => $this->request->getVar('subject_code'),
                    'subject' => $this->request->getVar('subject'),
                    'description' => $this->request->getVar('description'),
				];

				$subject = new SubjectModel();
                
				$save = $subject->save($dtls);

				if($save){
					$this->session->setFlashdata('success', 'Subject has been created!');
					return redirect()->to(previous_url());
				}
			}
			$this->session->setFlashdata('error',  $data['validation']->listErrors());
			return redirect()->to(previous_url());
		}
	}

	public function updateSubject()
	{
		$data = [];

		if ($this->request->getMethod() == 'post') {

			$id = $this->request->getVar('id');

			$rules = [
				'subject_code' => 'is_unique[subjects.subject_code,id,'.$id.']|required|max_length[255]',
				'subject' => 'required|max_length[255]',
				'description' => 'required|max_length[255]',
			];
			$errors = [
				'subject_code' => [
                    'required' => 'Subject code is required!',
                    'is_unique' => 'Subject code is already in used!'
				],
				'subject' => [
					'required' => 'Subject name is required!'
				],
				'description' => [
					'required' => 'Subject description is required!'
				]
			];
            
			if (!$this->validate($rules,$errors)) {

				$data['validation'] = $this->validator;
				
			}else{

				$dtls = [
					'id' => $id = $this->request->getVar('id'),
					'subject_code' => $this->request->getVar('subject_code'),
                    'subject' => $this->request->getVar('subject'),
					'description' => $this->request->getVar('description'),
					'status' => $this->request->getVar('status'),
					'updated_at' => date('y-n-j G:i:s')
				];

				$subject = new SubjectModel();
                
				$save = $subject->save($dtls);

				if($save){
					$this->session->setFlashdata('success', 'Subject has been updated!');
					return redirect()->to(previous_url());
				}
			}
			$this->session->setFlashdata('error',  $data['validation']->listErrors());
			return redirect()->to(previous_url());
		}
	}

	public function getSubject()
	{	
		$validator = array('success' => false, 'msg' => array());

		$id = $this->request->getVar('id');

		$subject = new SubjectModel();
                
		$subject = $subject->find($id);

		$validator['success'] = true;
		$validator['msg'] = $subject;

		echo json_encode($validator);
	}

    public function delete($id)
	{	
		$model = new SubjectModel();
		if($id) {
			$delete = $model->delete($id);
			if($delete){
				$this->session->setFlashdata('error', 'Subject has been deleted!');
				return redirect()->to(previous_url());
			}
		}
	}

	
	//--------------------------------------------------------------------

}
