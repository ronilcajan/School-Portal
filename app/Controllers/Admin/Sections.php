<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SectionModel;
use App\Models\SubjectModel;
use App\Models\StudentModel;

class Sections extends BaseController
{
	public function index()
	{
		$section = new SectionModel();
		$subject = new SubjectModel();

		$data['subjects'] = $subject->findAll();
		$data['sections'] = $section->findAll();
		$data['active'] = $section->where('status', 1)->findAll();
		$data['inactive'] = $section->where('status', 0)->findAll();

		$data['title'] = "Year & Sections";
		return view('admin/sections/manage',$data);
    }
    
    public function create_section(){
        $data = [];
        
        if($this->request->getMethod() == 'post'){

            $rules = [
				'name' => 'trim|required|is_unique[section.section_name]',
				'year' => 'required',
				'description' => 'required',
			];
			$errors = [
				'name' => [
					'required' => 'Section name is required!',
					'is_unique' => 'This section is already created, please use a different section name!'
				],
				'year' => [
					'required' => 'Section year is required!',
					
				],
				'description' => [
					'required' => 'Section description is required!',
					
				],
			];

			if (!$this->validate($rules,$errors)) {

                $data['validation'] = $this->validator;

            }else{
                
                $model = new SectionModel();
				$dtls = [
					'section_name' => $this->request->getVar('name'),
					'section_year' => $this->request->getVar('year'),
					'description' => $this->request->getVar('description')
				];
				
				$insert = $model->insert($dtls);
				$section_id = $model->insertID; 

				if($insert){

					$subject_id = $this->request->getVar('subjects');
					$group = array();
					foreach($subject_id as $key=>$val){
						  $group[] = array('section_id'=>$section_id, 'subject_id'=>$val);
					}

					$db = db_connect();
					$table = $db->table('group_section');
					$table->insertBatch($group);

					$this->session->setFlashdata('success', 'Grade & Section has been created!');
					return redirect()->to(previous_url());
				}
			}
			$this->session->setFlashdata('error',  $data['validation']->listErrors());
			return redirect()->to(previous_url());
		}
		
	}

	public function update(){
		$data = [];
		
		$id = $this->request->getVar('id');
		
        if($this->request->getMethod() == 'post'){
            $rules = [
				'name' => 'trim|required|is_unique[section.section_name,id,'.$id.']',
				'year' => 'required',
				'description' => 'required',
			];
			$errors = [
				'name' => [
					'required' => 'Section name is required!',
					'is_unique' => 'This section is already created, please use a different section name!'
				],
				'year' => [
					'required' => 'Section year is required!',
					
				],
				'description' => [
					'required' => 'Section description is required!',
					
				],
			];

			if (!$this->validate($rules,$errors)) {

                $data['validation'] = $this->validator;

            }else{
                
                $model = new SectionModel();
				$dtls = [
					'id' => $id,
					'section_name' => $this->request->getVar('name'),
					'section_year' => $this->request->getVar('year'),
					'description' => $this->request->getVar('description'),
					'status' => $this->request->getVar('status'),
					'updated_at' => date('y-n-j G:i:s')
				];
				$update = $model->save($dtls);

				if($update){

					$subject_id = $this->request->getVar('subjects');
					$group = array();
					foreach($subject_id as $key=>$val){
						  $group[] = array('section_id'=>$id, 'subject_id'=>$val);
					}

					$db = db_connect();
					$table = $db->table('group_section');
					$table->delete(['section_id' => $id]);

					$table->insertBatch($group);

					$this->session->setFlashdata('success', 'Section has been updated!');
					return redirect()->to(previous_url());
				}
            }
            
			$this->session->setFlashdata('error',  $data['validation']->listErrors());
            return redirect()->to(previous_url());
		}
		
	}
	
	public function delete($id)
	{	
		$model = new SectionModel();
		if($id) {
			$delete = $model->delete($id);
			if($delete){
				$this->session->setFlashdata('error', 'The section has been deleted!');
				return redirect()->to(previous_url());
			}
		}
	}

	public function getSection()
	{	
		$validator = array('success' => false, 'msg' => array(), 'subs' => array());

		$id = $this->request->getVar('id');

		$section = new SectionModel();
		$sub = new SubjectModel();
                
		$section = $section->find($id);

		$subs = $sub
				->join('group_section','group_section.subject_id=subjects.id')
				->where('group_section.section_id',$id)->findAll();;

		$validator['success'] = true;
		$validator['msg'] = $section;
		$validator['subs'] = $subs;

		echo json_encode($validator);
	}
	public function specificSection($id,$section){
		$model = new StudentModel();

		$data['students'] = $model
								->select('*, students.id as id')
								->join('student_section','students.id=student_section.student_id')
								->join('section','section.id=student_section.section_id')
								->where('section.id',$id)
								->findAll();

		$data['title'] = "Students of Grade ".$section;
		return view('admin/sections/student_section',$data);
	}
	//--------------------------------------------------------------------

}
