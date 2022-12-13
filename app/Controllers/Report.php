<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AccountModel;

class Report extends BaseController
{
    public function __construct()
    {
        $this->accounts = new AccountModel();
    }

    public function index()
    {
        return view('reports/index', [
            'title' => 'Laporan Neraca & Neraca',
            'accounts' => $this->accounts->findAll(),
            'assets' => $this->accounts->where('type_account_id', 1)->findAll(),
            'liabilities' => $this->accounts->where('type_account_id', 2)->findAll(),
            'equities' => $this->accounts->where('type_account_id', 3)->findAll(),
            'revenues' => $this->accounts->where('type_account_id', 4)->findAll(),
            'cost_of_sales' => $this->accounts->where('type_account_id', 5)->findAll(),
            'operational_expenses' => $this->accounts->where('type_account_id', 6)->findAll(),
            'other_income' => $this->accounts->where('type_account_id', 7)->findAll(),
            'other_expense' => $this->accounts->where('type_account_id', 8)->findAll(),
            'taxes' => $this->accounts->where('type_account_id', 9)->findAll(),
        ]);
    }
}
