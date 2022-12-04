<?php

namespace App\Controllers;

use App\Models\CompanyModel;
use CodeIgniter\API\ResponseTrait;
use Hermawan\DataTables\DataTable;
use App\Controllers\BaseController;

class Company extends BaseController
{
    use ResponseTrait;
    
    public function __construct()
    {
        $this->companies = new CompanyModel();
        $this->db = \Config\Database::connect();
    }

    public function datatables()
    {
        $builder = $this->companies->select('id,name');
        return DataTable::of($builder)
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
        return view('companies/index', [
            'title' => 'Perusahaan',
            'companies' => $this->companies->findAll()
        ]);
    }

    public function edit($id)
    {
        $company = $this->companies->find($id);
        return $this->respond($company);
    }

    public function create()
    {
        $data = [
            'id'       => $this->request->getPost('company_id'),
            'name'    => $this->request->getPost('name'),
        ];
        $this->companies->save($data);
    }
}
