<?php

namespace App\Controllers;

use App\Models\AccountModel;
use App\Models\SubGroupAccountModel;
use CodeIgniter\API\ResponseTrait;
use Hermawan\DataTables\DataTable;
use App\Controllers\BaseController;

class Account extends BaseController
{
    use ResponseTrait;
    
    public function __construct()
    {
        $this->accounts = new AccountModel();
        $this->subgroup_account = new SubGroupAccountModel();
    }

    public function datatables()
    {
        $builder = $this->accounts
            ->select('accounts.id, accounts.name, subgroup_account.name as subgroup_name, accounts.code, saldo')
            ->join('subgroup_account', 'subgroup_account.id = accounts.subgroup_account_id')
            ->orderBy('code', 'ASC');
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
            'subgroup_accounts' => $this->subgroup_account->findAll(),
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
        $data['store_id'] = 1; 
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
