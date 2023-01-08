<?php

namespace App\Models;

use Config\Database;
use CodeIgniter\Model;

class BusinessPartnerModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'business_partners';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'email', 'phone_number', 'address', 'group_business_partner_id', 'type'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'name' => 'required',
        'email' => 'required|valid_email',
        'phone_number' => 'required',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    public function findById($id)
    {
        $db = Database::connect();
        return $db->table('business_partners as bp')
            ->select('bp.id, bp.name, email, phone_number, address,
                group_business_partners.name as group_name')
            ->where('bp.id', $id)
            ->join('group_business_partners', 'group_business_partners.id = bp.group_business_partner_id', 'left')
            ->get()->getRowObject();
    }
}
