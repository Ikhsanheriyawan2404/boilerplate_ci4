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
        $accounts = $this->accounts
            ->select('ABS(jt.debit - jt.credit) as saldo, accounts.name, accounts.code')
            ->join('journal_transactions as jt', 'jt.account_code = accounts.code', 'left')
            ->groupBy('accounts.id')
            ->findAll();
            
        $assets = $this->accounts->where('subgroup_account.group_account_id', 1)
                ->select('SUM(jt.debit - jt.credit) as saldo, accounts.name, accounts.code')
                ->join('journal_transactions as jt', 'jt.account_code = accounts.code')
                ->join('subgroup_account', 'accounts.subgroup_account_id = subgroup_account.id')
                ->groupBy('accounts.id')
                ->findAll();
        
        $liabilities = $this->accounts->where('subgroup_account.group_account_id', 2)
                ->select('SUM(jt.credit - jt.debit) as saldo, accounts.name, accounts.code')
                ->join('journal_transactions as jt', 'jt.account_code = accounts.code')
                ->join('subgroup_account', 'accounts.subgroup_account_id = subgroup_account.id')
                ->groupBy('accounts.id')
                ->findAll();

        $equities = $this->accounts->where('subgroup_account.group_account_id', 3)
                ->select('SUM(jt.credit - jt.debit) as saldo, accounts.name, accounts.code')
                ->join('journal_transactions as jt', 'jt.account_code = accounts.code')
                ->join('subgroup_account', 'accounts.subgroup_account_id = subgroup_account.id')
                ->groupBy('accounts.id')
                ->findAll();

        $revenues = $this->accounts->where('subgroup_account.group_account_id', 4)
            ->select('SUM(jt.credit - jt.debit) as saldo, accounts.name, accounts.code')
            ->join('journal_transactions as jt', 'jt.account_code = accounts.code')
            ->join('subgroup_account', 'accounts.subgroup_account_id = subgroup_account.id')
            ->groupBy('accounts.id')
            ->findAll(); 

        $cost_of_sales = $this->accounts->where('subgroup_account.group_account_id', 5)
            ->select('SUM(jt.credit - jt.debit) as saldo, accounts.name, accounts.code')
            ->join('journal_transactions as jt', 'jt.account_code = accounts.code')
            ->join('subgroup_account', 'accounts.subgroup_account_id = subgroup_account.id')
            ->groupBy('accounts.id')
            ->findAll(); 

        return view('reports/index', [
            'title' => 'Laporan Neraca & Neraca',
            'accounts' => $accounts,
            'assets' => $assets,
            'liabilities' => $liabilities,
            'equities' => $equities,
            'revenues' => $revenues,
            'cost_of_sales' => $cost_of_sales,
            'operational_expenses' => $this->accounts->where('subgroup_account_id', 6)
                ->select('SUM(jt.debit - jt.credit) as total, name, code, jt.debit, jt.credit')
                ->join('journal_transactions as jt', 'jt.account_code = accounts.code')
                ->groupBy('accounts.id')
                ->findAll(),
            'other_incomes' => $this->accounts->where('subgroup_account_id', 7)
                ->select('SUM(jt.debit - jt.credit) as total, name, code, jt.debit, jt.credit')
                ->join('journal_transactions as jt', 'jt.account_code = accounts.code')
                ->groupBy('accounts.id')
                ->findAll(),
            'other_expenses' => $this->accounts->where('subgroup_account_id', 8)
                ->select('SUM(jt.debit - jt.credit) as total, name, code, jt.debit, jt.credit')
                ->join('journal_transactions as jt', 'jt.account_code = accounts.code')
                ->groupBy('accounts.id')
            ->findAll(),
            'taxes' => $this->accounts->where('subgroup_account_id', 9)
                ->select('SUM(jt.debit - jt.credit) as total, name, code, jt.debit, jt.credit')
                ->join('journal_transactions as jt', 'jt.account_code = accounts.code')
                ->groupBy('accounts.id')
                ->findAll(),
        ]);
    }
}
