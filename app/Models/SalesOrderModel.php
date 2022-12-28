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
        'business_partner_id',
        'date',
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
    protected $validationRules      = [];
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
            so.date, so.description')
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
            journals.transaction_number,
            journals.date,
            journals.description')
            ->where('journal_id', $id)
            ->where('jt.journal_id', $id)
            ->join('journals', 'jt.journal_id = journals.id')
            ->get()->getResultObject();
    }
}
