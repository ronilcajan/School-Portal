<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProfileModel;
use \Myth\Auth\Models\UserModel;

class Profile extends BaseController
{
	public function index()
	{	

		$user = new ProfileModel();
		$data['user'] = $user->select('user_profile.id as id, username, user_id,name,users.email,phone,address,bio,img,cover')
							->join('users','user_profile.user_id = users.id')
							->where('user_id', user_id())
							->first();

		$data['title'] = \ucfirst('My Profile');
		return view('admin/user_profile', $data);
	}

	public function update()
	{	
		$data = [];

		if ($this->request->getMethod() == 'post') {
			$rules = [
				'name' => 'required|max_length[255]',
				'phone' => 'required|max_length[255]',
				'email' => 'required|max_length[255]',
				'address' => 'required|max_length[255]',
				'avatar' => 'is_image[avatar]',
				'cover' => 'is_image[cover]'
			];
			$errors = [
				'name' => [
					'required' => 'Your name is required!'
				],
				'phone' => [
					'required' => 'Your phone is required!'
				],
				'email' => [
					'required' => 'Your email is required!'
				],
				'address' => [
					'required' => 'Your address is required!'
				]
			];

			if (!$this->validate($rules,$errors)) {

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
								'id' => $this->request->getVar('id'),
								'name' => $this->request->getVar('name'),
								'phone' => $this->request->getVar('phone'),
								'address' => $this->request->getVar('address'),
								'bio' => $this->request->getVar('bio'),
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
								'id' => $this->request->getVar('id'),
								'name' => $this->request->getVar('name'),
								'phone' => $this->request->getVar('phone'),
								'address' => $this->request->getVar('address'),
								'bio' => $this->request->getVar('bio'),
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
							'id' => $this->request->getVar('id'),
							'name' => $this->request->getVar('name'),
							'phone' => $this->request->getVar('phone'),
							'address' => $this->request->getVar('address'),
							'bio' => $this->request->getVar('bio'),
							'img' => $newAvatarName,
							'cover' => $newCoverName,
							'updated_at' => date('y-n-j G:i:s')
						];
					}
				}else{
					$dtls = [
						'id' => $this->request->getVar('id'),
						'name' => $this->request->getVar('name'),
						'phone' => $this->request->getVar('phone'),
						'address' => $this->request->getVar('address'),
						'bio' => $this->request->getVar('bio'),
						'updated_at' => date('y-n-j G:i:s')
					];
				}
				$data = [
					'id' => user_id(),
					'username' => $this->request->getVar('username'),
					'email' => $this->request->getVar('email'),
				];

				$profile = new ProfileModel();
                $user 	= new UserModel();
                
				$update = $profile->save($dtls);
				$update1 = $user->save($data);

				if($update && $data){
					$this->session->setFlashdata('success', 'Profile has been saved!');
					return redirect()->to(previous_url());
				}
			}
			$this->session->setFlashdata('error',  $data['validation']->listErrors());
			return redirect()->to(base_url('admin/my-profile'));
		}
	}

	//--------------------------------------------------------------------
}
