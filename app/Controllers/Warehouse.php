<?php

namespace App\Controllers;

use App\Models\WarehouseModel;
use Hermawan\DataTables\DataTable;
use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;

class Warehouse extends BaseController
{
    use ResponseTrait;
    
    public function __construct()
    {
        $this->warehouses = new WarehouseModel();
    }

    public function datatables()
    {
        $builder = $this->warehouses->select('id, name, description');
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
        return view('warehouses/index', [
            'title' => 'Gudang',
        ]);
    }

    public function edit($id)
    {
        $warehouses = $this->warehouses->find($id);
        return $this->respond($warehouses);
    }

    public function create()
    {
        $data = $this->request->getPost();
        $data['id'] = $this->request->getPost('item_id'); 
        if ($this->warehouses->save($data) === false) {
            return $this->respond([
                'message' => $this->warehouses->errors(),
                'status' => false,
            ]);
        }
        return $this->respond([
            'message' => 'Data berhasil disimpan',
            'status' => true,
        ]);
    }
}
