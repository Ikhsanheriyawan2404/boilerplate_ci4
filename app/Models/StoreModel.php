<?php

namespace App\Models;

use CodeIgniter\Model;

class StoreModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'stores';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'company_id'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'name' => 'required',
        'company_id' => 'required',
    ];
    protected $validationMessages   = [
        'name' => [
            'required' => 'Nama toko tidak boleh kosong'
        ],
        'company_id' => [
            'required' => 'Nama perusahaan tidak boleh kosong'
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;
}
