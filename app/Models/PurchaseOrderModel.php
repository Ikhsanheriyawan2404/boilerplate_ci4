<?php

namespace App\Models;

use Config\Database;
use CodeIgniter\Model;

class PurchaseOrderModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'purchase_orders';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'store_id',
        'user_id',
        'business_partner_id',
        'transaction_date',
        'overdue_date',
        'payment_date',
        'document',
        'status',
        'description'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'business_partner_id' => 'required',
        'transaction_date' => 'required',
        'overdue_date' => 'required',
        'status' => 'required',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    public function findPurchaseDetail($id)
    {
        $db = Database::connect();
        $builder = $db->table('purchase_details as pd');
        return $builder->select('
            pd.id, pd.qty, pd.item_id, pd.total_price,
            items.name as item_name,
            po.transaction_date, po.overdue_date, po.payment_date, po.description')
            ->where('purchase_order_id', $id)
            ->where('pd.purchase_order_id', $id)
            ->join('purchase_orders as po', 'pd.purchase_order_id = po.id')
            ->join('items', 'items.id = pd.item_id')
            ->get()->getResultObject();
    }

    public function findJournalDetail($id)
    {
        $db = Database::connect();
        $builder = $db->table('journals');
        return $builder->select('
            accounts.name,
            jt.id, jt.credit, jt.debit, jt.account_code,
            transaction_number,
            date,
            journals.description')
            ->where('purchase_order_id', $id)
            ->join('journal_transactions as jt', 'jt.journal_id = journals.id')
            ->join('accounts', 'jt.account_code = accounts.code')
            ->get()->getResultObject();
        
    }
}
