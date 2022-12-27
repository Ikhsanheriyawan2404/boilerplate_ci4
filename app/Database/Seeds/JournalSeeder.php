<?php

namespace App\Database\Seeds;

use CodeIgniter\I18n\Time;
use CodeIgniter\Database\Seeder;
use App\Models\JournalTransactionModel;
use App\Models\{JournalModel, AccountModel};

class JournalSeeder extends Seeder
{
    public function run()
    {
        $bankBRI = '11201';
        $kas = '11000';
        $modal = '31000';
        $persedianBarang = '10300';
        $pendapatan = '41000';

        $journalId = $this->saveJournal([
            'store_id' => 1,
            'transaction_number' => 'Journal#1001',
            'date' => Time::now(),
            'description' => 'Penambahan Modal Awal'
        ]);

        $this->saveDetailJournal([
            'store_id' => 1,
            'account_code' => $bankBRI,
            'journal_id' => $journalId,
            'debit' => 200000000,
            'credit' => 0,
        ]);

        $this->saveDetailJournal([
            'store_id' => 1,
            'account_code' => $kas,
            'journal_id' => $journalId,
            'debit' => 1000000,
            'credit' => 0,
        ]);

        $this->saveDetailJournal([
            'store_id' => 1,
            'account_code' => $modal,
            'journal_id' => $journalId,
            'debit' => 0,
            'credit' => 201000000,
        ]);
        // ============================================
        $journalId = $this->saveJournal([
            'store_id' => 1,
            'transaction_number' => 'Journal#1002',
            'date' => Time::now(),
            'description' => 'Pembelian Perlengkapan Kantor'
        ]);

        $this->saveDetailJournal([
            'store_id' => 1,
            'account_code' => '12003',
            'journal_id' => $journalId,
            'debit' => 15000000,
            'credit' => 0,
        ]);

        $this->saveDetailJournal([
            'store_id' => 1,
            'account_code' => $bankBRI,
            'journal_id' => $journalId,
            'debit' => 0,
            'credit' => 15000000,
        ]);
        // ============================================
        $journalId = $this->saveJournal([
            'store_id' => 1,
            'transaction_number' => 'Journal#1003',
            'date' => Time::now(),
            'description' => 'Pembelian Produk Lpg 100 unit'
        ]);

        $this->saveDetailJournal([
            'store_id' => 1,
            'account_code' => '21000',
            'journal_id' => $journalId,
            'debit' => 0,
            'credit' => 15000000,
        ]);

        $this->saveDetailJournal([
            'store_id' => 1,
            'account_code' => $persedianBarang,
            'journal_id' => $journalId,
            'debit' => 15000000,
            'credit' => 0,
        ]);
        // ============================================
        $journalId = $this->saveJournal([
            'store_id' => 1,
            'transaction_number' => 'Journal#1004',
            'date' => Time::now(),
            'description' => 'Pembayaran Hutang Usaha Gas Lpg 100 Unit'
        ]);

        $this->saveDetailJournal([
            'store_id' => 1,
            'account_code' => $bankBRI,
            'journal_id' => $journalId,
            'debit' => 0,
            'credit' => 15000000,
        ]);

        $this->saveDetailJournal([
            'store_id' => 1,
            'account_code' => '21000',
            'journal_id' => $journalId,
            'debit' => 15000000,
            'credit' => 0,
        ]);
        // ============================================
        $journalId = $this->saveJournal([
            'store_id' => 1,
            'transaction_number' => 'Journal#1005',
            'date' => Time::now(),
            'description' => 'Penjualan Gas Lpg 100 Unit Secara Kredit'
        ]);

        $this->saveDetailJournal([
            'store_id' => 1,
            'account_code' => '11301',
            'journal_id' => $journalId,
            'debit' => 16000000,
            'credit' => 0,
        ]);

        $this->saveDetailJournal([
            'store_id' => 1,
            'account_code' => $pendapatan,
            'journal_id' => $journalId,
            'debit' => 0,
            'credit' => 16000000,
        ]);

        $this->saveDetailJournal([
            'store_id' => 1,
            'account_code' => '51000',
            'journal_id' => $journalId,
            'debit' => 15000000,
            'credit' => 0,
        ]);

        $this->saveDetailJournal([
            'store_id' => 1,
            'account_code' => $persedianBarang,
            'journal_id' => $journalId,
            'debit' => 0,
            'credit' => 15000000,
        ]);
        // ============================================
        $journalId = $this->saveJournal([
            'store_id' => 1,
            'transaction_number' => 'Journal#1006',
            'date' => Time::now(),
            'description' => 'Pembayaran Piutang Pelanggan suka ngutang Gas Lpg 100 Unit'
        ]);

        $this->saveDetailJournal([
            'store_id' => 1,
            'account_code' => $bankBRI,
            'journal_id' => $journalId,
            'debit' => 15000000,
            'credit' => 0,
        ]);

        $this->saveDetailJournal([
            'store_id' => 1,
            'account_code' => '11301',
            'journal_id' => $journalId,
            'debit' => 0,
            'credit' => 15000000,
        ]);
        // ============================================
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
            'debit' => $account->debit + $data['debit'],
            'credit' => $account->credit + $data['credit'],
        ]);
    }
}
