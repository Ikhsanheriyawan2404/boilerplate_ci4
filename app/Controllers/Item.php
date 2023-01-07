<?php

namespace App\Controllers;

use App\Models\ItemModel;
use CodeIgniter\API\ResponseTrait;
use Hermawan\DataTables\DataTable;
use App\Controllers\BaseController;

class Item extends BaseController
{
    use ResponseTrait;
    
    protected $items;

    public function __construct()
    {
        $this->items = new ItemModel();
    }

    public function datatables()
    {
        $builder = $this->items->select('id, name, item_code, stock, purchase_price, selling_price');
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
        return view('items/index', [
            'title' => 'Toko/Agen/Store',
        ]);
    }

    public function edit($id)
    {
        $store = $this->items->find($id);
        return $this->respond($store);
    }

    public function create()
    {
        $data = $this->request->getPost();
        $data['id'] = $this->request->getPost('item_id'); 
        if ($this->items->save($data) === false) {
            return $this->respond([
                'message' => $this->items->errors(),
                'status' => false,
            ]);
        }
        return $this->respond([
            'message' => 'Data berhasil disimpan',
            'status' => true,
        ]);
    }

    public function item_datatable()
    {
        $builder = $this->items->select('id, name, item_code, stock, purchase_price, selling_price');
        return DataTable::of($builder)
            ->addNumbering('no')
            ->add('action', function ($row) {
                $btn = '<button class="btn btn-sm btn-primary chooseItem" data-id="'.$row->id.'">
                Pilih <i class="fa fa-check-circle">
                </button>';
                return $btn;
            }, 'last')
            ->toJson(true);
    }
}
