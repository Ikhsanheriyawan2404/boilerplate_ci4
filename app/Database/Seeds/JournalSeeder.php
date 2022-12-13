<?php

namespace App\Database\Seeds;

use App\Models\AccountModel;
use CodeIgniter\I18n\Time;
use App\Models\JournalModel;
use App\Models\JournalTransactionModel;
use CodeIgniter\Database\Seeder;

class JournalSeeder extends Seeder
{
    public function run()
    {
        $journalId = $this->saveJournal([
            'store_id' => 1,
            'transaction_number' => 'Journal#1002',
            'date' => Time::now(),
            'description' => 'Penambahan Modal AKhir'
        ]);

        $this->saveDetailJournal([
            'store_id' => 1,
            'account_code' => '11201',
            'journal_id' => $journalId,
            'debit' => 200000000,
            'credit' => 0,
        ]);

        $this->saveDetailJournal([
            'store_id' => 1,
            'account_code' => '11000',
            'journal_id' => $journalId,
            'debit' => 1000000,
            'credit' => 0,
        ]);

        $this->saveDetailJournal([
            'store_id' => 1,
            'account_code' => '31000',
            'journal_id' => $journalId,
            'debit' => 0,
            'credit' => 201000000,
        ]);
    }

    public function saveJournal(array $data) : int
    {
        $journals = new JournalModel();
        $journals->insert([
            'store_id' => 1,
            'transaction_number' => $data['transaction_number'],
            'date' => $data['date'],
            'description' => $data['description']
        ]);

        return $journals->getInsertID();
    }

    public function saveDetailJournal(array $array)
    {
        $transactions = new JournalTransactionModel();
        $accounts = new AccountModel();
        $data = [
            'store_id' => $array['store_id'],
            'account_code' => $array['account_code'],
            'journal_id' => $array['journal_id'],
            'debit' => $array['debit'],
            'credit' => $array['credit'],
        ];
        $transactions->insert($data);
        $account = $accounts->where('code', $data['account_code'])->first();
        $accounts->update($account->id, [
            'debit' => $data['debit'],
            'credit' => $data['credit'],
        ]);
    }
}
