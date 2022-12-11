<?php

namespace App\Controllers;

use App\Models\AccountModel;
use CodeIgniter\API\ResponseTrait;
use Hermawan\DataTables\DataTable;
use App\Controllers\BaseController;
use App\Models\TypeAccountModel;

class Account extends BaseController
{
    use ResponseTrait;
    
    public function __construct()
    {
        $this->accounts = new AccountModel();
        $this->type_accounts = new TypeAccountModel();
    }

    public function datatables()
    {
        $builder = $this->accounts->select('id, name, description, code, saldo');
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
        return view('accounts/index', [
            'title' => 'Akun Master',
            'type_accounts' => $this->type_accounts->findAll(),
        ]);
    }

    public function edit($id)
    {
        $accounts = $this->accounts->find($id);
        return $this->respond($accounts);
    }

    public function create()
    {
        $data = $this->request->getPost();
        $data['id'] = $this->request->getPost('item_id'); 
        if ($this->accounts->save($data) === false) {
            return $this->respond([
                'message' => $this->accounts->errors(),
                'status' => false,
            ]);
        }
        return $this->respond([
            'message' => 'Data berhasil disimpan',
            'status' => true,
        ]);
    }
}
