<?php

namespace App\Controllers;

use App\Models\JournalModel;
use CodeIgniter\API\ResponseTrait;
use Hermawan\DataTables\DataTable;
use App\Controllers\BaseController;

class Journal extends BaseController
{
    use ResponseTrait;
    
    public function __construct()
    {
        $this->journals = new JournalModel();
    }

    public function datatables()
    {
        $builder = $this->journals
            ->select('id, date, transaction_number, file, description');
            
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
        return view('journals/index', [
            'title' => 'Jurnal',
        ]);
    }

    public function show($id = null)
    {
        $journal = $this->journals->findById($id);
        return $this->respond($journal);
    }
}
