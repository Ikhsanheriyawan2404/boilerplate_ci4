<?php

namespace App\Controllers;

use Config\Database;
use App\Models\ItemModel;
use App\Models\PurchaseOrderModel;
use CodeIgniter\API\ResponseTrait;
use Hermawan\DataTables\DataTable;
use App\Controllers\BaseController;
use App\Models\BusinessPartnerModel;
use App\Models\PurchaseDetailModel;

class Purchase extends BaseController
{
    use ResponseTrait;

    protected $purchases;
    protected $purchaseDetails;
    protected $vendors;
    protected $items;
    protected $db;

    public function __construct()
    {
        $this->purchases = new PurchaseOrderModel();
        $this->purchaseDetails = new PurchaseDetailModel();
        $this->vendors = new BusinessPartnerModel();
        $this->items = new ItemModel();
        $this->db = Database::connect();
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

    public function new()
    {
        return view('purchases/new', [
            'title' => 'Pembelian/Purchase',
            'vendors' => $this->vendors->where('type', 'vendor')->findAll(),
        ]);
    }

    public function item_datatable()
    {
        $builder = $this->items->select('id, name, item_code, stock, purchase_price');
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

    public function getItem($itemId)
    {
        $item = $this->items->find($itemId);
        $row=[];
        $row[] = '<input name="item_code" type="hidden" value="'.$item->item_code.'"><span class="btn btn-success">' . $item->item_code . '</span';
        $row[] = $item->name;
        $row[] = '<input type="number" name="qty" class="form-control form-control-sm" value="0">';
        $row[] = '<input type="number" name="purchase_price" class="form-control form-control-sm" value="'.$item->purchase_price.'">';
        $row[] = '<input type="number" name="discount" class="form-control form-control-sm" value="0">';
        $row[] = '<input type="number" name="total_price" class="form-control form-control-sm" value="0">';
        $row[] = '<button class="btn btn-sm btn-danger removeItem">-</button>';
        
        return $this->respond($row);
    }

    public function create()
    {
        $this->db->transBegin();
		try {
            return $this->respond($this->request->getPost());
			$this->purchases->insert($this->request->getPost());
			$this->purchaseDetails->insert($this->request->getPost());
			
			$this->db->transCommit();
		} catch (\Exception $e) {
			$this->db->transRollback();
		}
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
