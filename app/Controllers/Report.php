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
            'assets' => $this->accounts->where('type_account_id', 1)
                ->select('sum(debit - credit) as total, name, code, debit, credit, saldo')
                ->findAll(),
            'liabilities' => $this->accounts->where('type_account_id', 2)
                ->select('sum(credit - debit) as total, name, code, debit, credit, saldo')
                ->findAll(),
            'equities' => $this->accounts->where('type_account_id', 3)
                ->select('sum(credit - debit) as total, name, code, debit, credit, saldo')
                ->findAll(),
            'revenues' => $this->accounts->where('type_account_id', 4)
                ->select('sum(credit - debit) as total, name, code, debit, credit, saldo')
                ->findAll(),
            'cost_of_sales' => $this->accounts->where('type_account_id', 5)
                ->select('sum(debit - credit) as total, name, code, debit, credit, saldo')
                ->findAll(),
            'operational_expenses' => $this->accounts->where('type_account_id', 6)
                ->select('sum(credit - debit) as total, name, code, debit, credit, saldo')
                ->findAll(),
            'other_incomes' => $this->accounts->where('type_account_id', 7)
                ->select('sum(credit - debit) as total, name, code, debit, credit, saldo')
                ->findAll(),
            'other_expenses' => $this->accounts->where('type_account_id', 8)
                ->select('sum(credit - debit) as total, name, code, debit, credit, saldo')
                ->findAll(),
            'taxes' => $this->accounts->where('type_account_id', 9)
                ->select('sum(credit - debit) as total, name, code, debit, credit, saldo')
                ->findAll(),
        ]);
    }
}
