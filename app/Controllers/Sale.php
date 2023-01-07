<?php

namespace App\Controllers;

use Config\Database;
use App\Models\ItemModel;
use InvalidArgumentException;
use App\Models\SalesOrderModel;
use CodeIgniter\API\ResponseTrait;
use Hermawan\DataTables\DataTable;
use App\Controllers\BaseController;
use App\Models\BusinessPartnerModel;
use App\Models\SalesDetailModel;

class Sale extends BaseController
{
    use ResponseTrait;

    protected $sales;
    protected $customers;
    protected $items;
    protected $db;
    protected $salesDetails;
    
    public function __construct()
    {
        $this->sales = new SalesOrderModel();
        $this->salesDetails = new SalesDetailModel();
        $this->customers = new BusinessPartnerModel();
        $this->items = new ItemModel();
        $this->db = Database::connect();
    }

    public function datatables()
    {
        $builder = $this->sales
            ->select('
                sales_orders.id,
                sales_orders.transaction_date as date,
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

    public function new()
    {
        return view('sales/new', [
            'title' => 'Penjualan/Sales',
            'customers' => $this->customers->where('type', 'customer')->findAll(),
        ]);
    }

    public function getItem($itemId)
    {
        $item = $this->items->find($itemId);
        $row = [];
        $row[] = '<input name="item_code[]" type="hidden" value="'.$item->id.'"><span class="btn btn-success">' . $item->item_code . '</span';
        $row[] = $item->name;
        $row[] = '<input type="number" name="qty[]" class="form-control form-control-sm" value="0">';
        $row[] = '<input type="number" name="selling_price[]" class="form-control form-control-sm" value="'.$item->selling_price.'">';
        $row[] = '<input type="number" name="discount[]" class="form-control form-control-sm" value="0">';
        $row[] = '<input type="number" name="total_price[]" class="form-control form-control-sm" value="0" readonly>';
        $row[] = '<button class="btn btn-sm btn-danger removeItem">-</button>';
        
        return $this->response->setJSON($row);
    }
    

    public function create()
    {   
        $this->db->transBegin();
		try {
            $data = [
                'business_partner_id' => $this->request->getPost('customer'),
                'transaction_date' => $this->request->getPost('transaction_date'),
                'overdue_date' => $this->request->getPost('overdue_date'),
                'description' => $this->request->getPost('description'),
                'store_id' => 1,
                'status' => 'open',
            ];
            if ($this->sales->save($data) === false) {
                $errorMessages = [];
                foreach ($this->sales->errors() as $error) {
                    $errorMessages[] = $error;
                }
                throw new InvalidArgumentException(json_encode($errorMessages), 422);
            }

            $totalRequestItem = $this->request->getPost('item_code');
            if ($totalRequestItem == null) {
                throw new InvalidArgumentException('Item tidak boleh kosong', 400);
            } else {
                for ($i = 0; $i < count($totalRequestItem); $i++) {
                    $data = [
                        'sales_order_id' => $this->sales->getInsertID(),
                        'item_id' => $this->request->getPost('item_code')[$i],
                        'qty' => $this->request->getPost('qty')[$i],
                        'price' => $this->request->getPost('selling_price')[$i],
                        'discount' => $this->request->getPost('discount')[$i],
                        'total_price' => $this->request->getPost('total_price')[$i],
                    ];
    
                    if ($this->salesDetails->save($data) === false) {
                        $errorMessages = [];
                        foreach ($this->salesDetails->errors() as $error) {
                            $errorMessages[] = $error;
                        }
                        throw new InvalidArgumentException(json_encode($errorMessages), 422);
                    }
                }
            }

			$this->db->transCommit();

		} catch (InvalidArgumentException $e) {

			$this->db->transRollback();

            $errorMessages = json_decode($e->getMessage());
            if ($errorMessages == null) {
                $validationFailed = $e->getMessage();
            } else {
                $validationFailed = 'Validasi Gagal';
            }

            return $this->response->setJSON([
                'message' => $validationFailed,
                'errors' => $errorMessages ?? null,
            ])->setStatusCode($e->getCode());
		}

        return $this->response->setJSON([
            'message' => 'Berhasil Menambahkan Order Penjualan',
            'data' => $this->request->getPost(),
        ])->setStatusCode(200);
    }

    public function salesDetail($id = null)
    {
        $sale = $this->sales->findSaleDetail($id);
        return $this->respond($sale);
    }

    public function journalDetail($id = null)
    {
        $journal = $this->sales->findJournalDetail($id);
        return $this->respond($journal);
    }
}
