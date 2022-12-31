<?php

namespace App\Database\Seeds;

use CodeIgniter\I18n\Time;
use CodeIgniter\Database\Seeder;
use App\Models\JournalTransactionModel;
use App\Models\{JournalModel};

class JournalSeeder extends Seeder
{
    public function run()
    {
        $bankBRI = '10002';
        $kas = '10001';
        $modal = '31000';
        $biayaKaryawan = '61000';
        $biayaListrik = '61700';

        $journalId = $this->saveJournal([
            'store_id' => 1,
            'transaction_number' => 'JournalUmum#1001',
            'journal_type_id' => 5,
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
            'transaction_number' => 'JournalUmum#1002',
            'journal_type_id' => 5,
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
        // ====================================================
        $journalId = $this->saveJournal([
            'store_id' => 1,
            'transaction_number' => 'JournalUmum#1003',
            'journal_type_id' => 5,
            'date' => Time::now(),
            'description' => 'Beban Gaji Karyawan'
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
            'account_code' => $biayaKaryawan,
            'journal_id' => $journalId,
            'debit' => 15000000,
            'credit' => 0,
        ]);
        // ===============================
        $journalId = $this->saveJournal([
            'store_id' => 1,
            'transaction_number' => 'JournalUmum#1004',
            'journal_type_id' => 5,
            'date' => Time::now(),
            'description' => 'Biaya Listrik'
        ]);

        $this->saveDetailJournal([
            'store_id' => 1,
            'account_code' => $bankBRI,
            'journal_id' => $journalId,
            'debit' => 0,
            'credit' => 500000,
        ]);

        $this->saveDetailJournal([
            'store_id' => 1,
            'account_code' => $biayaListrik,
            'journal_id' => $journalId,
            'debit' => 500000,
            'credit' => 0,
        ]);
    }

    public function saveJournal(array $data) : int
    {
        $journals = new JournalModel();
        $journals->insert([
            'store_id' => 1,
            'journal_type_id' => $data['journal_type_id'] ?? random_int(1, 6),
            'transaction_number' => $data['transaction_number'],
            'date' => $data['date'],
            'description' => $data['description']
        ]);

        return $journals->getInsertID();
    }

    public function saveDetailJournal(array $array)
    {
        $transactions = new JournalTransactionModel();
        $data = [
            'store_id' => $array['store_id'],
            'account_code' => $array['account_code'],
            'journal_id' => $array['journal_id'],
            'debit' => $array['debit'],
            'credit' => $array['credit'],
        ];
        $transactions->insert($data);
    }
}
