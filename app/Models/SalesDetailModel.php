<?php

namespace App\Models;

use CodeIgniter\Model;

class SalesDetailModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'sales_details';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['sales_order_id', 'qty', 'item_id'];

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;
}
