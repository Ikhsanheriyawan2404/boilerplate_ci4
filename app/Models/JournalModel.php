<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class JournalModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'journals';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'store_id',
        'purchase_order_id',
        'sales_order_id',
        'journal_type_id',
        'transaction_number',
        'date',
        'description',
        'file',
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

    public function findById($id)
    {
        $db = Database::connect();
        $builder = $db->table('journal_transactions as jt');
        return $builder->select('
            jt.id, jt.credit, jt.debit, jt.account_code,
            accounts.name,
            journals.transaction_number,
            journals.date,
            journals.description')
            ->where('journal_id', $id)
            ->where('jt.journal_id', $id)
            ->join('journals', 'jt.journal_id = journals.id')
            ->join('accounts', 'jt.account_code = accounts.code')
            ->get()->getResultObject();
    }
}
