<?php

namespace App\Models;

use Config\Database;
use CodeIgniter\Model;

class SalesOrderModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'sales_orders';
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
        // 'status' => 'required',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    public function findSaleDetail($id)
    {
        $db = Database::connect();
        $builder = $db->table('sales_details as pd');
        return $builder->select('
            pd.id, pd.qty, pd.item_id, pd.total_price,
            items.name as item_name,
            so.transaction_date, so.overdue_date, so.payment_date, so.description')
            ->where('sales_order_id', $id)
            ->where('pd.sales_order_id', $id)
            ->join('sales_orders as so', 'pd.sales_order_id = so.id')
            ->join('items', 'items.id = pd.item_id')
            ->get()->getResultObject();
    }

    public function findJournalDetail($id)
    {
        $db = Database::connect();
        $builder = $db->table('journal_transactions as jt');
        return $builder->select('
            jt.id, jt.credit, jt.debit, jt.account_code,
            accounts.name,
            journals.transaction_number,
            journals.date,
            journals.description')
            ->where('sales_order_id', $id)
            ->join('journals', 'jt.journal_id = journals.id')
            ->join('accounts', 'jt.account_code = accounts.code')
            ->get()->getResultObject();
    }
}
