<?php

namespace App\Controllers;

use Config\Database;
use App\Models\ItemModel;
use App\Models\JournalModel;
use App\Models\AccountModel;
use InvalidArgumentException;
use App\Models\PurchaseOrderModel;
use CodeIgniter\API\ResponseTrait;
use Hermawan\DataTables\DataTable;
use App\Controllers\BaseController;
use App\Models\PurchaseDetailModel;
use App\Models\BusinessPartnerModel;
use App\Models\JournalTransactionModel;

class Purchase extends BaseController
{
    use ResponseTrait;

    protected $db;
    protected $items;
    protected $vendors;
    protected $accounts;
    protected $journals;
    protected $purchases;
    protected $journalDetails;
    protected $purchaseDetails;

    public function __construct()
    {
        $this->items = new ItemModel();
        $this->db = Database::connect();
        $this->accounts = new AccountModel();
        $this->journals = new JournalModel();
        $this->purchases = new PurchaseOrderModel();
        $this->vendors = new BusinessPartnerModel();
        $this->purchaseDetails = new PurchaseDetailModel();
        $this->journalDetails = new JournalTransactionModel();
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

    public function show($itemId)
    {
        return view('purchases/show', [
            'title' => 'Detail Pembelian',
        ]);
    }

    public function new()
    {
        return view('purchases/new', [
            'title' => 'Pembelian/Purchase',
            'vendors' => $this->vendors->where('type', 'vendor')->findAll(),
        ]);
    }

    public function edit($purchaseId)
    {
        // return $this->response->setJSON($this->purchases->find($itemId));
        // $journal = $this->purchases->findPurchaseDetail($itemId);
        // return $this->response->setJSON($journal);
        return view('purchases/edit', [
            'title' => 'Detail Pembelian',
            'vendors' => $this->vendors->where('type', 'vendor')->findAll(),
            'purchase' => $this->purchases->find($purchaseId),
        ]);
    }

    public function getItem($itemId)
    {
        $item = $this->items->find($itemId);
        $row=[];
        $row[] = '<input name="item_code[]" type="hidden" value="'.$item->id.'"><span class="btn btn-success">' . $item->item_code . '</span';
        $row[] = $item->name;
        $row[] = '<input type="number" name="qty[]" data-id="'.$item->id.'" class="form-control form-control-sm qty" value="0">';
        $row[] = '<input type="number" name="purchase_price[]" data-id="'.$item->id.'" class="form-control form-control-sm purchase_price" value="'.$item->purchase_price.'">';
        $row[] = '<input type="number" name="discount[]" data-id="'.$item->id.'" class="form-control form-control-sm discount" value="0">';
        $row[] = '<input type="number" name="subtotal[]" class="form-control form-control-sm subtotal" data-id="'.$item->id.'" value="0" readonly>';
        $row[] = '<button class="btn btn-sm btn-danger removeItem">-</button>';
        
        return $this->response->setJSON($row);
    }

    public function create()
    {   
        $this->db->transBegin();
		try {
            $data = [
                'business_partner_id' => $this->request->getPost('vendor'),
                'transaction_date' => $this->request->getPost('transaction_date'),
                'overdue_date' => $this->request->getPost('overdue_date'),
                'description' => $this->request->getPost('description'),
                'store_id' => 1,
                'status' => $this->request->getPost('payment') == 'paid' ? 'paid' : 'open',
                'discount' => $this->request->getPost('discount_price'),
                'pay' => $this->request->getPost('payment') == 'paid' ? $this->request->getPost('pay') : 0,
                'subtotal' => $this->request->getPost('subtotal_price'),
                'total_price' => $this->request->getPost('total_price'),
                'user_id' => user()->id,
            ];

            // Add new purchase order
            if ($this->purchases->save($data) === false) {
                $errorMessages = [];
                foreach ($this->purchases->errors() as $error) {
                    $errorMessages[] = $error;
                }
                throw new InvalidArgumentException(json_encode($errorMessages), 422);
            }

            // Add new purchase order details
            $totalRequestItem = $this->request->getPost('item_code');
            if ($totalRequestItem == null) {
                throw new InvalidArgumentException('Item tidak boleh kosong', 400);
            } else {
                for ($i = 0; $i < count($totalRequestItem); $i++) {
                    $data = [
                        'purchase_order_id' => $this->purchases->getInsertID(),
                        'item_id' => $this->request->getPost('item_code')[$i],
                        'qty' => $this->request->getPost('qty')[$i],
                        'price' => $this->request->getPost('purchase_price')[$i],
                        'discount' => $this->request->getPost('discount')[$i],
                        'subtotal' => $this->request->getPost('subtotal')[$i],
                    ];
    
                    if ($this->purchaseDetails->save($data) === false) {
                        $errorMessages = [];
                        foreach ($this->purchaseDetails->errors() as $error) {
                            $errorMessages[] = $error;
                        }
                        throw new InvalidArgumentException(json_encode($errorMessages), 422);
                    }

                    // Update stock item
                    $item = $this->items->find($this->request->getPost('item_code')[$i]);
                    $this->items->update($this->request->getPost('item_code')[$i], [
                        'stock' => $item->stock + $this->request->getPost('qty')[$i],
                    ]);
                }
            }

            // Add new journals
            $purchases = $this->purchases->find($this->purchases->getInsertID());
            $purchaseDetails = $this->purchaseDetails
                ->where('purchase_order_id', $this->purchases->getInsertID())
                ->get()->getResultObject();
            
            $this->journals->insert([
                'store_id' => 1,
                'journal_type_id' => $purchases->status == 'open' ? 1 : 4,
                'purchase_order_id' => $purchases->id,
                'transaction_number' => $purchases->status == 'open' ? 'JurnalPembelian#0001' : 'JurnalKasPengeluaran#0001',
                'date' => $purchases->transaction_date,
                'description' => $purchases->description,
                'user_id' => user()->id,
            ]);

            $kas = $this->accounts->where('code', '10001')->first()->code;
            // $bank = $this->accounts->where('code', '10002')->first()->code;
            $persediaanBarang = $this->accounts->where('code', '10300')->first()->code;
            $akunHutang = $this->accounts->where('code', '21000')->first()->code;

            // Add new journal details
            if ($purchases->status == 'paid') {
                $this->journalDetails->insert([
                    'journal_id' => $this->journals->getInsertID(),
                    'account_code' => $kas,
                    'debit' => 0,
                    'credit' => $purchases->total_price,
                ]);

                if ($purchases->discount > 0) {
                    $this->journalDetails->insert([
                        'journal_id' => $this->journals->getInsertID(),
                        'account_code' => $kas,
                        'debit' => 0,
                        'credit' => $purchases->discount,
                    ]);
                }

                foreach ($purchaseDetails as $purchaseDetail) {
                    $this->journalDetails->insert([
                        'journal_id' => $this->journals->getInsertID(),
                        'account_code' => $persediaanBarang,
                        'debit' => $purchaseDetail->subtotal,
                        'credit' => 0,
                    ]);
                }

            } else {
                $this->journalDetails->insert([
                    'journal_id' => $this->journals->getInsertID(),
                    'account_code' => $akunHutang,
                    'debit' => 0,
                    'credit' => $purchases->total_price,
                ]);

                if ($purchases->discount > 0) {
                    $this->journalDetails->insert([
                        'journal_id' => $this->journals->getInsertID(),
                        'account_code' => $kas,
                        'debit' => 0,
                        'credit' => $purchases->discount,
                    ]);
                }

                foreach ($purchaseDetails as $purchaseDetail) {
                    $this->journalDetails->insert([
                        'journal_id' => $this->journals->getInsertID(),
                        'account_code' => $persediaanBarang,
                        'debit' => 0,
                        'credit' => $purchaseDetail->subtotal,
                    ]);
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
            'message' => 'Berhasil Menambahkan Order Pembelian',
            'data' => $this->purchases->find($this->purchases->getInsertID()),
        ])->setStatusCode(200);
    }

    public function update($purchaseId)
    {
       return $purchaseId; 
    }

    public function purchaseDetail($id = null)
    {
        $purchase = $this->purchases->findPurchaseDetail($id);
        return $this->respond($purchase);
    }

    public function getPurchaseDetail($purchaseDetailId)
    {
        $items = $this->purchases->findPurchaseDetail($purchaseDetailId);
        $data=[];
        foreach($items as $item) {
            $row = [];
            $row[] = '<input name="item_code[]" type="hidden" value="'.$item->id.'"><span class="btn btn-success">' . $item->item_code . '</span';
            $row[] = $item->item_name;
            $row[] = '<input type="number" name="qty[]" data-id="'.$item->id.'" class="form-control form-control-sm qty" value="'.$item->qty.'">';
            $row[] = '<input type="number" name="purchase_price[]" data-id="'.$item->id.'" class="form-control form-control-sm purchase_price" value="'.$item->price.'">';
            $row[] = '<input type="number" name="discount[]" data-id="'.$item->id.'" class="form-control form-control-sm discount" value="'.$item->discount.'">';
            $row[] = '<input type="number" name="subtotal[]" class="form-control form-control-sm subtotal" data-id="'.$item->id.'" value="'.$item->subtotal.'" readonly>';
            $row[] = '<button class="btn btn-sm btn-danger removeItem">-</button>';

            $data[] = $row;
        }
        // return $this->response->setJSON($items);
        return $this->response->setJSON($data);
    }

    public function journalDetail($id = null)
    {
        $journal = $this->purchases->findJournalDetail($id);
        return $this->respond($journal);
    }

    public function checkStock($itemId)
    {
        $item = $this->items->find($itemId);

        if ($item->stock <= $this->request->getPost('qty')) {
            return $this->response->setJSON([
                'message' => 'Stock Tidak Tersedia',
                'data' => $item->stock,
            ])->setStatusCode(400);
        }
        
        return $this->response->setJSON([
            'message' => 'Stock Tersedia',
            'data' => $item->stock,
        ]);
        
    }
}
