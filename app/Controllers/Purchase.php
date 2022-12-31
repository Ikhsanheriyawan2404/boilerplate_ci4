<?php

namespace App\Controllers;

use App\Models\PurchaseOrderModel;
use CodeIgniter\API\ResponseTrait;
use Hermawan\DataTables\DataTable;
use App\Controllers\BaseController;
use Config\Database;

class Purchase extends BaseController
{
    use ResponseTrait;
    
    public function __construct()
    {
        $this->purchases = new PurchaseOrderModel();
    }

    public function datatables()
    {
        $builder = $this->purchases
            ->select('
                purchase_orders.id,
                purchase_orders.transaction_date as date,
                purchase_orders.document,
                purchase_orders.status,
                purchase_orders.description,
                bp.name as vendor
            ')
            ->join('business_partners as bp', 'bp.id = purchase_orders.business_partner_id');

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
        return view('purchases/index', [
            'title' => 'Pembelian/Purchase',
        ]);
    }

    public function purchaseDetail($id = null)
    {
        $purchase = $this->purchases->findPurchaseDetail($id);
        return $this->respond($purchase);
    }

    public function journalDetail($id = null)
    {
        $journal = $this->purchases->findJournalDetail($id);
        return $this->respond($journal);
    }
}
