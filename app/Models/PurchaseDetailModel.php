<?php

namespace App\Models;

use CodeIgniter\Model;

class PurchaseDetailModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'purchase_details';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['purchase_order_id', 'qty', 'item_id', 'total_price'];

    // Validation
    protected $validationRules      = [
        'purchase_order_id' => 'required',
        'qty' => 'required',
        'item_id' => 'required',
        'total_price' => 'required',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
