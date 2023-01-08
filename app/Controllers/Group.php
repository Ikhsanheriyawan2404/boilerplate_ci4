<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use Myth\Auth\Models\{GroupModel, PermissionModel};

class Group extends ResourceController
{
    protected $db;
    protected $groups;
    protected $permissions;
    
    public function __construct()
    {
        $this->groups = new GroupModel();
        $this->permissions = new PermissionModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        return view('groups/index', [
            'groups' => $this->groups->findAll(),
            'title' => 'Group',
        ]);
    }

    public function show($id = null)
    {
        $data = $this->groups->getPermissionsForGroup($id);
        return $this->response->setJSON($data);
    }

    public function new()
    {
        return view('groups/create', [
            'permissions' => $this->permissions->findAll(),
            'title' => 'Create Group',
        ]);
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        if (!$this->validate([
            'name' => 'required|is_unique[auth_groups.name,name]',
            'description' => 'required',
            'permission' => 'required',
        ])) {
            return redirect()->back()->withInput();
        }

        // Mulai DB transaksi
        $this->db->transStart();
            // Query input ke table groups
            $this->groups->insert($this->request->getPost());

            // Query input permission id dan group id
            $permissions = $this->request->getPost('permission');
            if (count($permissions) > 0) {
                foreach ($permissions as $value) {
                    $this->groups->addPermissionToGroup($value, $this->groups->getInsertId());
                }
            }
        // Transaksi Selesai
        $this->db->transComplete();
        
        return redirect()->to(site_url('group'))->with('success','Data berhasil ditambahkan!');
    }

    public function edit($id = null)
    {
        // If permissions on group is not empty 
        if ($this->groups->getPermissionsForGroup($id) !== []) {
            foreach ($this->groups->getPermissionsForGroup($id) as $value) {
                $permissionGroup[$value['id']] = $value['id'];
            }
        } else {
            $permissionGroup = [];
        }

        return view('groups/edit', [
            'group' => $this->groups->find($id),
            'permissions' => $this->permissions->findAll(),
            'permissionGroup' => $permissionGroup,
            'title' => 'Edit Group',
        ]);
    }

    public function update($id = null)
    {
        if (!$this->validate([
            'name' => 'required|max_length[255]|is_unique[auth_groups.name,id, ' . $id . ']',
            'description' => 'required|max_length[255]',
            'permission' => 'required',
        ])) {
            return redirect()->back()->withInput();
        }

        // Mulai DB transaksi
        $this->db->transStart();
            // Query input ke table groups
            $this->groups->update($id, $this->request->getPost());

            // Query 2 (Menghapus semua permission di group yang akan diedit)
            $this->db->table('auth_groups_permissions')
                    ->where('group_id', $id)
                    ->delete();

            // Query input permission id dan group id
            $permissions = $this->request->getPost('permission');
            if (count($permissions) > 0) {
                foreach ($permissions as $value) {
                    $this->groups->addPermissionToGroup($value, $id);
                }
            }
        // Transaksi Selesai
        $this->db->transComplete();

        return redirect()->to(site_url('group'))->with('success','Data berhasil diedit!');
    }

    public function delete($id = null)
    {
        $this->groups->delete($id);
        return redirect()->to(site_url('group'))->with('success','Data berhasil dihapus!');
    }
}
