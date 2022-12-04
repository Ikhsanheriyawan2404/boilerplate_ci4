<?php

namespace App\Controllers;

use Myth\Auth\Password;
use App\Models\{UserModel};
use CodeIgniter\RESTful\ResourceController;
use Myth\Auth\Models\GroupModel;

class User extends ResourceController
{
    function __construct()
    {
        $this->users = new UserModel();
        $this->groups = new GroupModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        return view('users/index', [
            'title' => 'Users',
            'users' => $this->users->findAll(),
        ]);
    }

    public function show($id = null)
    {
        // $user = $this->groups->getGroupsForUser($id); 
        $user = $this->users->getUser($id); 
        return $this->response->setJSON($user);
    }

    public function new()
    {
        return view('users/create', [
            'title' => 'Tambah User',
            'groups' => $this->groups->findAll(),
        ]);
    }

    public function create()
    {
        $users = model(UserModel::class);

        $rules = [
            'username' => 'required|alpha_numeric_space|min_length[3]|max_length[30]|is_unique[users.username]',
            'email'    => 'required|valid_email|is_unique[users.email]',
			'password_hash'     => 'required|strong_password',
            'pass_confirm' => 'required|matches[password_hash]',
            'group' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput();
        }
		
		$users->db->transBegin();
		try {
			$users->insert([
				'username' => $this->request->getPost('username'),
				'password_hash' => Password::hash($this->request->getPost('password_hash')),
				'email' => $this->request->getPost('email'),
				'active' => 1,
			]);
			
			$this->groups->addUserToGroup($users->getInsertId(), $this->request->getPost('group'));

			$users->db->transCommit();
		} catch (\Exception $e) {
			$users->db->transRollback();
		}
			
        return redirect()->to(site_url('user'))->with('success', 'Berhasil menambahkan data!');
    }

    public function edit($id = null)
    {
        $user = $this->users->find($id);
        if (is_object($user)) {
            return view('users/edit', [
                'title' => 'Edit User',
                'groups' => $this->groups->findAll(),
                'user' => $user,
                'userGroup' => $this->groups->getGroupsForUser($id)[0]['group_id'],
            ]);
        } else {
            return view('page_error/page_404');
        }
    }

    public function update($id = null)
    {
        $user = $this->users->find($id);

        if (!$this->validate([
			'username' => 'required|alpha_numeric_space|min_length[3]|max_length[30]|is_unique[users.username,id,'.$user->id.']',
            'email'    => 'required|valid_email|is_unique[users.email,id,'.$user->id.']',
            'group' => 'required',
            'password_hash'     => 'string',
            'pass_confirm' => 'matches[password_hash]',
		])) {
            return redirect()->back()->withInput();
        }

		$this->db->transStart();
            $password = $this->request->getPost('password_hash');
            $this->users->save([
                'id' => $id,
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
                'password_hash' => empty($password) ? $user->password_hash : Password::hash($password),
            ]);

            
            $this->groups->removeUserFromAllGroups(intval($user->id));
            
            $this->groups->addUserToGroup($user->id, $this->request->getPost('group'));
        $this->db->transComplete();
        
        if ($this->db->transStatus() === false) {
            return redirect()->to(site_url('user'))->with('error', 'Gagal mengedit data!');
        } else {
            return redirect()->to(site_url('user'))->with('success', 'Berhasil mengedit data!');
        }
        
    }

    public function delete($id = null)
    {
        $this->users->delete($id);
        return redirect()->to(site_url('user'))->with('success', 'Data Berhasil dihapus');
    }
}
