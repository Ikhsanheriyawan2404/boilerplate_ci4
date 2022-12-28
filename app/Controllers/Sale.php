<?php

namespace App\Controllers;

use App\Models\SalesOrderModel;
use Hermawan\DataTables\DataTable;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class Sale extends BaseController
{
    use ResponseTrait;
    
    public function __construct()
    {
        $this->sales = new SalesOrderModel();
    }

    public function datatables()
    {
        $builder = $this->sales
            ->select('
                sales_orders.id,
                sales_orders.date,
                sales_orders.document,
                sales_orders.status,
                sales_orders.description,
                bp.name as customer
            ')
            ->join('business_partners as bp', 'bp.id = sales_orders.business_partner_id');

        return DataTable::of($builder)
            ->addNumbering('no')
            ->edit('status', function ($row) {
                $paid = '<td class="text-center">
                <div class="mb-2 me-2 badge bg-success">Paid</div>
                </td>';
                $open = '<td class="text-center">
                <div class="mb-2 me-2 badge bg-warning">Open</div>
                </td>';
                return $row->status === 'open' ? $open : $paid;    
            })
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
        return view('sales/index', [
            'title' => 'Penjualan/Sales',
        ]);
    }

    public function salesDetail($id = null)
    {
        $sale = $this->sales->findSaleDetail($id);
        return $this->respond($sale);
    }

    public function journalDetail($id = null)
    {
        $sale = $this->sales->find($id);
        $journal = $this->sales->findJournalDetail($sale->journal_id);
        return $this->respond($journal);
    }
}
