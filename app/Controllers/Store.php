<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use Hermawan\DataTables\DataTable;
use App\Controllers\BaseController;
use App\Models\{CompanyModel, StoreModel};

class Store extends BaseController
{
    use ResponseTrait;
    
    public function __construct()
    {
        $this->stores = new StoreModel();
        $this->companies = new CompanyModel();
    }

    public function datatables()
    {
        $builder = $this->stores->select('stores.id, stores.name as store_name, companies.name as company_name')
            ->join('companies', 'companies.id = stores.company_id');
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
        return view('stores/index', [
            'title' => 'Toko/Agen/Store',
            'companies' => $this->companies->findAll()
        ]);
    }

    public function edit($id)
    {
        $store = $this->stores->find($id);
        return $this->respond($store);
    }

    public function create()
    {
        $data = [
            'id'    => $this->request->getPost('store_id'),
            'name'  => $this->request->getPost('name'),
            'company_id'  => $this->request->getPost('company_id'),
        ];
        if ($this->stores->save($data) === false) {
            return $this->respond([
                'message' => $this->stores->errors(),
                'status' => false,
            ]);
        }
        return $this->respond([
            'message' => 'Data berhasil disimpan',
            'status' => true,
        ]);
    }
}
