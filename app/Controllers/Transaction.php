<?php

namespace App\Controllers;

use App\Models\TransactionModel;
use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;
use App\Models\StoreModel;
use App\Models\UserModel;
use Myth\Auth\Models\GroupModel;
use Myth\Auth\Models\PermissionModel;

class Transaction extends BaseController
{
    use ResponseTrait;
    
    public function __construct()
    {
        $this->transactions = new TransactionModel();
        $this->users = new UserModel();
        $this->groups = new GroupModel();
        $this->permissions = new PermissionModel();
        $this->stores = new StoreModel();
    }

    public function index()
    {
        // return $this->respond($this->groups->getPermissionsForGroup(1));
        // return $this->respond($this->users->getStoresForUser(1));
        // return $this->respond(user()->getStores());
        return $this->respond($this->transactions->whereIn('store_id', user()->getStores())->findAll(), 200);
    }
}
