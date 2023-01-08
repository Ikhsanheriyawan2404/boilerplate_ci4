<?php

namespace App\Controllers;

use InvalidArgumentException;
use Hermawan\DataTables\DataTable;
use App\Controllers\BaseController;
use App\Models\BusinessPartnerModel;
use App\Models\GroupBusinessPartnerModel;

class Customer extends BaseController
{
    protected $customers;
    protected $groupBusinessPartner;
    
    public function __construct()
    {
        $this->customers = new BusinessPartnerModel();
        $this->groupBusinessPartner = new GroupBusinessPartnerModel();
    }

    public function datatables()
    {
        $builder = $this->customers
            ->select('
                business_partners.id, business_partners.name, email, phone_number,
                group_business_partners.name as group_name,
            ')
            ->where('type', 'customer')
            ->join('group_business_partners', 'group_business_partners.id = business_partners.group_business_partner_id', 'left')
            ->orderBy('created_at', 'ASC')
            ->groupBy('business_partners.id');
            
        return DataTable::of($builder)
            ->addNumbering('no')
            ->edit('group_name', function ($row) {
                return $row->group_name === null ? '-' : $row->group_name;
            })
            ->add('action', function ($row) {
                $btn = '<div class="dropdown d-inline-block">
                        <a aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="mb-2 mr-2 dropdown-toggle text-white btn-primary btn-sm"></a>
                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
                            <a href="javascript:void(0)" data-id="' . $row->id . '" id="showDetails" class="dropdown-item">Detail</a>
                            <a id="editItem" href="javascript:void(0)" data-id="' .  $row->id . '" class="dropdown-item">Edit</a>
                        </div>
                    </div>';
                return $btn;
            }, 'last')
            ->toJson(true);
    }

    public function index()
    {
        return view('customers/index', [
            'title' => 'Customer/Pelanggan',
            'group_business_partners' => $this->groupBusinessPartner->findAll(),
        ]);
    }

    public function show($id)
    {
        $customer = $this->customers->findById($id);
        return $this->response->setJSON($customer);
    }

    public function edit($id)
    {
        $customer = $this->customers->find($id);
        return $this->response->setJSON($customer);
    }

    public function create()
    {
        $data = $this->request->getPost();
        $data['id'] = $this->request->getPost('item_id'); 
        $data['type'] = 'customer';

        try {
            if ($this->customers->save($data) === false) {
                $errorMessages = [];
                foreach ($this->customers->errors() as $error) {
                    $errorMessages[] = $error;
                }
                throw new InvalidArgumentException(json_encode($errorMessages), 422);
            }
        } catch (InvalidArgumentException $e) {
            $errorMessages = json_decode($e->getMessage());
            return $this->response->setJSON([
                'status' => $e->getCode(),
                'message' => $errorMessages,
            ])->setStatusCode($e->getCode());
        }

        return $this->response->setJSON([
            'status' => 200,
            'message' => 'Data berhasil disimpan',
        ])->setStatusCode(200);
    }
}
