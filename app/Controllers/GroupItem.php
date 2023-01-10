<?php

namespace App\Controllers;

use App\Models\AccountModel;
use App\Models\GroupItemModel;
use Hermawan\DataTables\DataTable;
use App\Controllers\BaseController;

class GroupItem extends BaseController
{    
    protected $groupItems;
    protected $accounts;

    public function __construct()
    {
        $this->groupItems = new GroupItemModel();
        $this->accounts = new AccountModel();
    }

    public function datatables()
    {
        $builder = $this->groupItems
            ->select('id, name, account_code, description')
            ->orderBy('created_at', 'DESC');
            
        return DataTable::of($builder)
            ->addNumbering('no')
            ->add('action', function ($row) {
                $btn = '<td class="text-center">
                    <div class="dropdown d-inline-block">
                        <a aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="mb-2 mr-2 dropdown-toggle text-white btn-primary btn-sm"></a>
                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
                            <a href="javascript:void(0)" data-id="' . $row->id . '" id="showDetails" class="dropdown-item">Detail</a>
                            <a id="editItem" href="javascript:void(0)" data-id="' .  $row->id . '" class="dropdown-item">Edit</a>
                        </div>
                    </div>
                </td>';
                return $btn;
            }, 'last')
            ->toJson(true);
    }

    public function index()
    {
        return view('group_item/index', [
            'title' => 'Group/Kategori Item/Barang',
            'accounts' => $this->accounts->where('subgroup_account_id', 3)->findAll()
        ]);
    }

    public function edit($id)
    {
        $groupItem = $this->groupItems->find($id);
        return $this->response->setJSON($groupItem);
    }

    public function create()
    {
        $data = $this->request->getPost();
        $data['id'] = $this->request->getPost('item_id'); 
        if ($this->groupItems->save($data) === false) {
            return $this->response->setJSON([
                'message' => $this->groupItems->errors(),
                'status' => false,
            ]);
        }
        return $this->response->setJSON([
            'message' => 'Data berhasil disimpan',
            'status' => true,
        ]);
    }
}
