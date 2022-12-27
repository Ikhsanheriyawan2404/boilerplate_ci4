<?php

namespace App\Models;

use CodeIgniter\Model;

class SubGroupAccountModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'subgroup_account';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'code', 'group_account_id'];
}
